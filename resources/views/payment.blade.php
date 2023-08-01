@extends('layout.master')

@section('content')
    <h2>Registration Price: {{ $registrationPrice }}</h2>
    <p>Thank you for your interest in joining. Please proceed with the payment below.</p>

    <form action="/payment" method="POST">
        @csrf
        <label for="payment_amount">Payment Amount:</label>
        <input type="number" name="payment_amount" value="{{ old('payment_amount') }}">
        @error('payment_amount')
            <br>
            <span class="error">{{ $message }}</span>
        @enderror
        <br>

        <button type="submit">Pay</button>
    </form>

    @if(session('overpaidAmount'))
        <div>
            <p>Sorry, you overpaid {{ session('overpaidAmount') }}.</p>
            <p>Would you like to enter a balance?</p>
            <form action="/enter-balance" method="POST">
                @csrf
                <input type="hidden" name="overpaid_amount" value="{{ session('overpaidAmount') }}">
                <input type="hidden" name="registration_price" value="{{ session('registrationPrice') }}">
                <button type="submit" name="action" value="yes">Yes</button>
                <button type="submit" name="action" value="no">No</button>
            </form>
        </div>
    @endif
@endsection
