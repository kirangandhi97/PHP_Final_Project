<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Webhook;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('Invalid signature', 400);
        }

        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;
            $receipt_url = $session->payment_intent ? \Stripe\PaymentIntent::retrieve($session->payment_intent)->charges->data[0]->receipt_url : null;
            $email = $session->customer_email;

            if ($receipt_url && $email) {
                Mail::raw("Thank you for your payment. Here is your receipt:\n$receipt_url", function ($message) use ($email) {
                    $message->to($email)
                        ->subject('Your Payment Receipt');
                });
                Log::info("Receipt email sent to: $email");
            }
        }

        return response('Webhook received', 200);
    }
}
