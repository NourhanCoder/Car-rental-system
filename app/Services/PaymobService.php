<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Http;
use Exception;

class PaymobService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $integrationId;
    protected string $iframeId;
    protected float $exchangeRate;

    public function __construct()
    {
        $this->baseUrl       = config('services.paymob.base_url', 'https://accept.paymob.com/api');
        $this->apiKey        = config('services.paymob.api_key');
        $this->integrationId = config('services.paymob.integration_id');
        $this->iframeId      = config('services.paymob.iframe_id');
        $this->exchangeRate  = (float) config('services.paymob.exchange_rate', 50);
    }


      /**
     * Convert booking total price to amount in cents (EGP)
     */
    private function calculateAmountInCents(Booking $booking): int
    {
        $totalPriceInEgp = $booking->total_price * $this->exchangeRate;

        return (int) round($totalPriceInEgp * 100);
    }

    /**
     * Step 1: Get the Authentication Token
     */
    public function getAuthToken(): string
    {
        // Cache the token for one hour instead of requesting it on every request
        return cache()->remember('paymob_auth_token', 3600, function () {
        $response = Http::post("{$this->baseUrl}/auth/tokens", [
            'api_key' => $this->apiKey,
        ]);

        if ($response->failed()) {
            throw new Exception('Failed to connect to the Paymob gateway to obtain the authentication token.');
        }

        return $response->json('token');
        });
    }

  

    // Step 2: Register the payment order and convert the amount to Egyptian Pounds (Order Registration)
    public function createOrder(string $authToken, Booking $booking): int
    {
        $amountInCents = $this->calculateAmountInCents($booking);

        $response = Http::post("{$this->baseUrl}/ecommerce/orders", [
            'auth_token'        => $authToken,
            'delivery_needed'   => 'false',
            'amount_cents'      => $amountInCents,
            'currency'          => 'EGP',
            'merchant_order_id' => $booking->id,
        ]);

        if ($response->failed()) {
            throw new Exception('Failed to register the payment order with Paymob.');
        }

        return $response->json('id');
    }

    /**
     * Step 3: Generate the Payment Key using the user's actual data
     */
    public function getPaymentToken(string $authToken, int $orderId, Booking $booking): string
    {
        $amountInCents = $this->calculateAmountInCents($booking);

        // Split full_name into first and last names to send them to Paymob
        $fullName  = trim($booking->user->full_name);
        $nameParts = explode(' ', $fullName);
        $firstName = $nameParts[0] ?? 'Customer';
        $lastName  = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : 'User';

        $response = Http::post("{$this->baseUrl}/acceptance/payment_keys", [
            'auth_token'     => $authToken,
            'amount_cents'   => $amountInCents,
            'expiration'     => 3600,
            'order_id'       => $orderId,
            'billing_data'   => [
                'first_name'      => $firstName,
                'last_name'       => $lastName,
                'email'           => $booking->user->email,
                'phone_number'    => $booking->user->phone,
                'street'          => $booking->user->address ?? 'NA',
                'floor'           => 'NA',
                'apartment'       => 'NA',
                'building'        => 'NA',
                'shipping_method' => 'NA',
                'postal_code'     => 'NA',
                'city'            => 'Cairo',
                'country'         => 'EG',
                'state'           => 'Cairo',
            ],
            'currency'       => 'EGP',
            'integration_id' => $this->integrationId,
        ]);

        if ($response->failed()) {
            throw new Exception('Failed to generate the payment key from Paymob.');
        }

        return $response->json('token');
    }

    /**
     * Combine the three steps and return the ready-to-use iFrame URL
     */
    public function checkout(Booking $booking): string
    {
        // $authToken     = $this->getAuthToken();
        // $paymobOrderId = $this->createOrder($authToken, $booking);
        // $paymentToken  = $this->getPaymentToken($authToken, $paymobOrderId, $booking);
        $authToken = $this->getAuthToken();

        // check before create a new order
        if (!$booking->paymob_order_id) {
            $paymobOrderId = $this->createOrder($authToken, $booking);
            $booking->update(['paymob_order_id' => $paymobOrderId]);
        } else {
            $paymobOrderId = $booking->paymob_order_id;
        }

        $paymentToken = $this->getPaymentToken($authToken, $paymobOrderId, $booking);

        return "https://accept.paymob.com/api/acceptance/iframes/{$this->iframeId}?payment_token={$paymentToken}";
    }
}
