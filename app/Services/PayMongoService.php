<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayMongoService
{
    private string $baseUrl;
    private string $secretKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(
            config('services.paymongo.base_url'),
            '/'
        );

        $this->secretKey = config('services.paymongo.secret_key');

        if (empty($this->secretKey)) {
            throw new RuntimeException(
                'PayMongo secret key is not configured.'
            );
        }
    }

    /**
     * Create a PayMongo Hosted Checkout Session.
     *
     * Amount is supplied in pesos and converted to centavos.
     */
    public function createCheckoutSession(
        float $amount,
        string $description,
        string $reference
    ): array {
        if ($amount <= 0) {
            throw new RuntimeException(
                'Payment amount must be greater than zero.'
            );
        }

        // PayMongo uses the smallest currency unit.
        // ₱500.00 = 50000 centavos.
        $amountInCentavos = (int) round($amount * 100);

        $response = Http::withBasicAuth(
            $this->secretKey,
            ''
        )
            ->acceptJson()
            ->post(
                $this->baseUrl . '/v2/checkout_sessions',
                [
                    'data' => [
                        'attributes' => [

                            'line_items' => [
                                [
                                    'name' => $description,
                                    'amount' => $amountInCentavos,
                                    'currency' => 'PHP',
                                    'quantity' => 1,
                                ],
                            ],

                            /*
                             * Keep this list limited to payment methods
                             * available in your PayMongo test account.
                             */
                            'payment_method_types' => [
                                'gcash',
                                'qrph',
                                'card',
                            ],

                            'success_url' => route(
                                'topup.success'
                            ),

                            'cancel_url' => route(
                                'topup.index'
                            ),

                            'reference_number' => $reference,

                            'send_email_receipt' => false,

                            /*
                             * Store our AMEPSO reference in PayMongo
                             * metadata as well.
                             */
                            'metadata' => [
                                'amepso_reference' => $reference,
                            ],
                        ],
                    ],
                ]
            );

        if ($response->failed()) {
            throw new RuntimeException(
                'PayMongo API error: ' . $response->body()
            );
        }

        return $response->json();
    }
}