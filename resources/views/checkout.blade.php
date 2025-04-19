@extends('layout', ['title' => 'Home'])

@section('page-content')
    <div class="container py-5">
        <br>
        <br>
        <h4 class="text-center text-success mb-4">Choose a Payment Method</h4>

        <form id="payment-form" method="POST" action="{{ route('mails.shipped', $total) }}">
            @csrf
            <input type="hidden" name="payment_method" id="payment_method">
            <input type="hidden" name="amount" value="{{ $total }}">

            <div class="row justify-content-center g-4 mb-4">
                <div class="col-md-3">
                    <div class="card payment-option text-center mx-auto" data-method="cod">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-3"
                            style="height: 150px;">
                            <img src="{{ asset('assets/images/cod.png') }}" class="payment-image mb-2"
                                alt="Cash on Delivery">
                            <h6 class="card-title m-0">Cash on Delivery</h6>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card payment-option text-center mx-auto" data-method="bkash">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center p-3"
                            style="height: 150px;">
                            <img src="{{ asset('assets/images/bkash.png') }}" class="payment-image mb-2" alt="Pay Online">
                            <h6 class="card-title m-0">Pay Online</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg" id="pay-button">Pay Now</button>
            </div>
        </form>
    </div>

    <style>
        .payment-option {
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 2px solid transparent;
            border-radius: 12px;
            max-width: 250px;
            margin: auto;
        }

        .payment-option:hover {
            transform: scale(1.02);
        }

        .payment-option.selected {
            border: 2px solid #198754;
            box-shadow: 0 0 15px rgba(25, 135, 84, 0.4);
        }

        .payment-image {
            max-width: 60px;
            height: auto;
        }

        .card-title {
            font-size: 1rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.payment-option');
            const paymentInput = document.getElementById('payment_method');
            const form = document.getElementById('payment-form');

            cards.forEach(card => {
                card.addEventListener('click', () => {
                    cards.forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                    paymentInput.value = card.getAttribute('data-method');
                });
            });

            form.addEventListener('submit', function (e) {
                if (paymentInput.value === 'bkash') {
                    e.preventDefault(); // prevent normal form submit

                    // Redirect to address form route for Stripe
                    window.location.href = '{{ route('checkout.address') }}';
                }
            });
        });
    </script>
@endsection