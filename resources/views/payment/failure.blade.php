@extends('layout', ['title' => 'Payment Failed'])

@section('page-content')
    <div class="container text-center py-5">
        <h2 class="text-danger">❌ Payment Failed</h2>
        <p>Something went wrong. Please try again or use a different payment method.</p>
        <a href="{{ url()->previous() }}" class="btn btn-warning mt-3">Try Again</a>
    </div>
@endsection