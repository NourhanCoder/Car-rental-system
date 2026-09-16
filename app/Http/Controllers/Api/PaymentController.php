<?php

namespace App\Http\Controllers\Api;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\PaymobService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use ApiResponse;

    protected PaymobService $paymobService;

    public function __construct(PaymobService $paymobService)
    {
        $this->paymobService = $paymobService;
    }

    /**
     * Initiate payment for a booking
     */
    public function pay(Request $request, Booking $booking): JsonResponse
{
    // 1. Authorization check
    if ($booking->user_id !== $request->user()->id) {
        return $this->errorResponse('Unauthorized access to this booking.', 403);
    }

    // 2. Prevent payment if already confirmed
    if ($booking->status === BookingStatus::CONFIRMED->value) {
        return $this->errorResponse('This booking is already paid and confirmed.', 400);
    }

    // 3. Ensure User Billing Profile is Complete
    $user = $request->user();
    if (empty($user->phone) || empty($user->full_name)) {
        return $this->errorResponse('Please complete your neccessary profile data before proceeding to payment.', 422);
    }

    try {
        $paymentData = $this->paymobService->getCheckoutDetails($booking);

        return $this->successResponse(
            $paymentData,
            'Payment link generated successfully.'
        );
    } catch (Exception $e) {
        // Return a 500 error if any issue occurs while connecting to Paymob
        return $this->errorResponse($e->getMessage(), 500);
    }
}

    /**
     * Handle Paymob Callback / Webhook
     */
    public function callback(Request $request): JsonResponse
    {
        $hmacKeys = [
            'amount_cents', 'created_at', 'currency', 'error_occured',
            'has_parent_transaction', 'id', 'integration_id', 'is_3d_secure',
            'is_auth', 'is_capture', 'is_refunded', 'is_standalone_payment',
            'is_voided', 'order', 'owner', 'pending', 'source_data_pan',
            'source_data_sub_type', 'source_data_type', 'success',
        ];

        // 2. Concatenate the values of these keys in the exact order into a single string
        $connectedString = '';
        foreach ($hmacKeys as $key) {
            $connectedString .= $request->query($key);
        }

        // 3. Hash the concatenated string using SHA512 with the Paymob HMAC Secret
        $hashedSecret = hash_hmac('sha512', $connectedString, config('services.paymob.hmac_secret'));

        // Compare calculated hash with query HMAC to verify request origin
        if ($hashedSecret !== $request->query('hmac')) {
            return $this->errorResponse('Untrusted operation (HMAC Mismatch).', 400);
        }

        // Extract key request data
        $success          = $request->query('success');
        $merchantOrderId  = $request->query('merchant_order_id');
        $transactionId    = $request->query('id');
        $amountCents      = $request->query('amount_cents');

        // Find booking by order ID
        $booking = Booking::find($merchantOrderId);

        if (!$booking) {
            return $this->errorResponse('Booking not found.', 404);
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
                'payload'         => json_encode($request->all()),
            ]);

            return $this->successResponse(null, 'Payment completed and booking confirmed successfully.');
        }

        // Handle payment failure
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

        return $this->errorResponse('Payment failed.', 400);
    }
}
