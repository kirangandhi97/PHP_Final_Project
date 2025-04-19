<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Auth;
use DB;

class StripeController extends Controller
{
    // Show the address form before redirecting to Stripe
    public function showAddressForm()
    {
        if (!Auth::check())
            return redirect('/login');

        $total = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->where('product_order', 'no')
            ->sum('subtotal');

        return view('stripe.address-form', compact('total'));
    }

    // Handle the form submission and redirect to Stripe
    public function submitAddressForm(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'country' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);

        session([
            'shipping_address' => [
                'address' => $request->address,
                'address2' => $request->address2,
                'country' => $request->country,
                'state' => $request->state,
                'zip' => $request->zip,
            ]
        ]);

        return $this->checkout($request);
    }

    // Create the Stripe Checkout session
    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $email = Auth::check() ? Auth::user()->email : null;

        $amount = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->where('product_order', 'no')
            ->sum('subtotal');

        $shippingAddress = session('shipping_address');

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $email,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'cad',
                        'product_data' => [
                            'name' => 'Order Payment',
                        ],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => url('/payment-failure'),
            'metadata' => [
                'address' => $shippingAddress['address'] ?? '',
                'address2' => $shippingAddress['address2'] ?? '',
                'country' => $shippingAddress['country'] ?? '',
                'state' => $shippingAddress['state'] ?? '',
                'zip' => $shippingAddress['zip'] ?? '',
            ]
        ]);

        return redirect($checkout_session->url);
    }

    // Payment success callback
    public function paymentSuccess()
    {
        if (!Auth::check())
            return redirect('/login');

        \Log::info('🟢 Entered paymentSuccess');

        $userId = Auth::user()->id;

        // Get address from session (from address form)
        $addressInfo = session('shipping_address');

        // Generate Invoice ID
        $invoice = strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 8));

        // Calculate cart total
        $total = DB::table('carts')
            ->where('user_id', $userId)
            ->where('product_order', 'no')
            ->sum('subtotal');

        try {
            // Insert into orders table
            DB::table('orders')->insert([
                'name' => Auth::user()->name ?? 'N/A',
                'email' => Auth::user()->email ?? 'N/A',
                'phone' => Auth::user()->phone ?? 'N/A',
                'amount' => $total,
                'status' => 'Processing',
                'address' => implode(', ', array_filter([
                    $addressInfo['address'] ?? '',
                    $addressInfo['address2'] ?? '',
                    $addressInfo['state'] ?? '',
                    $addressInfo['country'] ?? '',
                    $addressInfo['zip'] ?? ''
                ])),
                'transaction_id' => $invoice,
                'currency' => 'CAD',
            ]);

            // Update cart
            DB::table('carts')
                ->where('user_id', $userId)
                ->where('product_order', 'no')
                ->update([
                    'product_order' => 'yes',
                    'invoice_no' => $invoice,
                    'pay_method' => 'Online Payment',
                    'purchase_date' => now(),
                    'shipping_address' => implode(', ', array_filter([
                        $addressInfo['address'] ?? '',
                        $addressInfo['address2'] ?? '',
                        $addressInfo['state'] ?? '',
                        $addressInfo['country'] ?? '',
                        $addressInfo['zip'] ?? ''
                    ])),
                ]);

            \Log::info('✅ Order and cart updated successfully for user ID: ' . $userId);

            return redirect('/payment-success')->with('success', 'Payment successful and order placed!');
        } catch (\Exception $e) {
            \Log::error('❌ Stripe order insert failed: ' . $e->getMessage());
            return redirect('/error')->with('error', 'Payment was successful but failed to save order. Please contact support.');
        }
    }

}
