@extends('layout', ['title' => 'Payment Success'])

@section('page-content')
    <div class="container text-center py-5">
        <h2 class="text-success">🎉 Payment Successful!</h2>
        <p>Thank you for your purchase. Your order has been received.</p>
        <a href="/" class="btn btn-primary mt-3">Back to Home</a>
    </div>
@endsection