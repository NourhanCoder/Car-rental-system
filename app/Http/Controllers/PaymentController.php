<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\PaymobService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected PaymobService $paymobService;

    public function __construct(PaymobService $paymobService)
    {
        $this->paymobService = $paymobService;
    }


    //Execute the three steps (Auth -> Order -> Payment Key).
    public function checkout(Request $request, Booking $booking)
    {
        // Prevent payment access if reservation is fully booked or already paid
    if ($booking->status === 'paid') {
        return redirect()->route('listingcars')->with('error', 'This booking is already paid.');
    }
        $iframeUrl = $this->paymobService->checkout($booking);

        return view('payment.iframe', compact('iframeUrl', 'booking'));
    }


    public function callback(Request $request)
    {
        // 1. Required fields to calculate HMAC in Paymob's defined order
        $hmacKeys = [
            'amount_cents',
            'created_at',
            'currency',
            'error_occured',
            'has_parent_transaction',
            'id',
            'integration_id',
            'is_3d_secure',
            'is_auth',
            'is_capture',
            'is_refunded',
            'is_standalone_payment',
            'is_voided',
            'order',
            'owner',
            'pending',
            'source_data_pan',
            'source_data_sub_type',
            'source_data_type',
            'success',
        ];

        // 2. Concatenate values in the required order
        $connectedString = '';
        foreach ($hmacKeys as $key) {
            $connectedString .= $request->query($key);
        }

        // 3. Calculate the hash using HMAC Secret with the SHA512 algorithm
        $hashedSecret = hash_hmac('sha512', $connectedString, config('services.paymob.hmac_secret'));

        // 4. Verify signature
        if ($hashedSecret !== $request->query('hmac')) {
            return redirect()->route('home')->with('error', 'Untrusted operation (HMAC Mismatch).');
        }

        // 5. Handle payment result (success or failure)
        $success = $request->query('success');
        $merchantOrderId = $request->query('merchant_order_id');
        $transactionId = $request->query('id');
        $amountCents = $request->query('amount_cents');

        $booking = Booking::find($merchantOrderId);

        if (!$booking) {
            return redirect()->route('home')->with('error', 'الحجز غير موجود.');
        }

        if ($success === 'true') {
            
            $booking->update([
                'status' => BookingStatus::CONFIRMED->value,
            ]);

            
            Payment::create([
                'booking_id'      => $booking->id,
                'user_id'         => $booking->user_id,
                'transaction_id'  => $transactionId,
                'payment_gateway' => 'paymob',
                'amount'          => $amountCents / 100,
                'payment_type'    => 'card',
                'status'          => 'success',
                'payload'         => json_encode($request->all()), // Save the full response in the payload column to simplify auditing or troubleshooting issues later
            ]);

            return redirect()->route('listingcars')->with('success', 'Payment completed and reservation confirmed successfully!');
        }

        // failed payment
        $booking->update([
            'status' => BookingStatus::CANCELLED->value,
        ]);

        Payment::create([
            'booking_id'      => $booking->id,
            'user_id'         => $booking->user_id,
            'transaction_id'  => $transactionId,
            'payment_gateway' => 'paymob',
            'amount'          => $amountCents / 100,
            'payment_type'    => 'card',
            'status'          => 'failed',
            'payload'         => json_encode($request->all()),
        ]);

        return redirect()->route('listingcars')->with('error', 'Payment failed, please try again.');
    }
}
