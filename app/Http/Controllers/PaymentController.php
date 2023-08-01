<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
            $user = Auth::user();
            $userPayment = User::find($user->id);
            $registrationPrice = $userPayment->registration_price;
            return view('/payment', compact('registrationPrice'));
    }

    public function processPayment(Request $request)
    {
        $user = User::find(auth()->id());
        $registrationPrice = $user->registration_price;
    
        $paidAmount = $request->payment_amount;
        if ($paidAmount < $registrationPrice) {
            $amountUnderpaid = $registrationPrice - $paidAmount;
            return redirect()->route('payment.show')
                ->withErrors(["payment_amount" => "You are still underpaid $amountUnderpaid."]);
        } elseif ($paidAmount > $registrationPrice) {
            $overpaidAmount = $paidAmount - $registrationPrice;
            // Display a confirmation message and store the overpaid amount in session data
            return redirect()->route('payment.show')->with([
                'overpaidAmount' => $overpaidAmount,
                'registrationPrice' => $registrationPrice,
            ]);
        }
    
        // If the payment amount is equal to the registration price
        return redirect('/')->with('paymentSuccess', 'Payment successful!');
    }
    
    public function enterBalance(Request $request)
{
    if ($request->action === 'yes') {
        // User confirmed to enter the balance
        $overpaidAmount = $request->overpaid_amount;
        $registrationPrice = $request->registration_price;

        // Update the user's wallet balance
        $user = User::find(auth()->id());
        $user->wallet += $overpaidAmount;
        $user->save();

        return redirect('/')->with('paymentSuccess', 'Payment successful with balance added to your wallet!');
    } else {
        // User declined to enter the balance, redirect them back to the payment page
        return redirect()->route('payment.show');
    }
}

}

