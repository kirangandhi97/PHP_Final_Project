@extends('layout', ['title' => 'Shipping Address'])

@section('page-content')
    <div class="container py-5">
        <h2 class="mb-4">Shipping Address</h2>

        <form method="POST" action="{{ route('checkout.address.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="address2" class="form-label">Address 2 (Optional)</label>
                <input type="text" name="address2" class="form-control">
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" required>
                </div>
                <div class="col">
                    <label for="state" class="form-label">State</label>
                    <input type="text" name="state" class="form-control" required>
                </div>
                <div class="col">
                    <label for="zip" class="form-label">Zip</label>
                    <input type="text" name="zip" class="form-control" required>
                </div>
            </div>

            <h4>Your Total: ${{ $total }}</h4>

            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div>
@endsection