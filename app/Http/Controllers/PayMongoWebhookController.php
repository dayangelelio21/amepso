<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Services\TopUpService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RuntimeException;

class PayMongoWebhookController extends Controller
{
    /**
     * Handle PayMongo webhook events.
     */
    public function handle(
        Request $request,
        TopUpService $topUpService
    ): Response {
        /*
        |--------------------------------------------------------------------------
        | Get the raw request body.
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | PayMongo signature verification must use the exact raw body.
        |
        */

        $payload = $request->getContent();

        /*
        |--------------------------------------------------------------------------
        | Get PayMongo signature.
        |--------------------------------------------------------------------------
        */

        $signature = $request->header('Paymongo-Signature');

        if (!$signature) {
            return response(
                'Missing PayMongo signature.',
                400
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Verify the webhook signature.
        |--------------------------------------------------------------------------
        */

        if (!$this->verifySignature($payload, $signature)) {
            return response(
                'Invalid PayMongo signature.',
                401
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Decode JSON payload.
        |--------------------------------------------------------------------------
        */

        $data = json_decode($payload, true);

        if (!is_array($data)) {
            return response(
                'Invalid JSON payload.',
                400
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Get event information.
        |--------------------------------------------------------------------------
        */

        $eventType = data_get(
            $data,
            'data.attributes.type'
        );

        /*
        |--------------------------------------------------------------------------
        | We only care about successful Checkout payments.
        |--------------------------------------------------------------------------
        */

        if ($eventType !== 'checkout_session.payment.paid') {
            return response(
                'Event ignored.',
                200
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Get Checkout Session information.
        |--------------------------------------------------------------------------
        */

        $checkoutSession = data_get(
            $data,
            'data.attributes.data'
        );

        if (!is_array($checkoutSession)) {
            return response(
                'Checkout session data missing.',
                400
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Get PayMongo Checkout Session ID.
        |--------------------------------------------------------------------------
        */

        $checkoutSessionId = data_get(
            $checkoutSession,
            'id'
        );

        /*
        |--------------------------------------------------------------------------
        | Get AMEPSO reference number.
        |--------------------------------------------------------------------------
        */

        $reference = data_get(
            $checkoutSession,
            'attributes.reference_number'
        );

        if (!$checkoutSessionId || !$reference) {
            return response(
                'Checkout session information incomplete.',
                400
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Find the AMEPSO Top Up.
        |--------------------------------------------------------------------------
        */

        $topUp = TopUp::where(
            'reference',
            $reference
        )->first();

        if (!$topUp) {
            return response(
                'Top-up not found.',
                404
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Verify the Checkout Session belongs to this Top Up.
        |--------------------------------------------------------------------------
        */

        if (
            $topUp->provider_reference !==
            $checkoutSessionId
        ) {
            return response(
                'Checkout session does not match top-up.',
                400
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Complete the top-up.
        |--------------------------------------------------------------------------
        |
        | TopUpService handles:
        |
        | - wallet locking
        | - transaction creation
        | - credited_at
        | - duplicate protection
        |
        */

        try {

            $topUpService->complete($topUp);

        } catch (RuntimeException $e) {

            return response(
                $e->getMessage(),
                400
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Tell PayMongo the webhook was successfully processed.
        |--------------------------------------------------------------------------
        */

        return response(
            'Webhook processed successfully.',
            200
        );
    }

    /**
     * Verify PayMongo webhook signature.
     */
    private function verifySignature(
        string $payload,
        string $signatureHeader
    ): bool {
        $webhookSecret = config(
            'services.paymongo.webhook_secret'
        );

        if (!$webhookSecret) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Parse:
        |
        | t=timestamp,
        | te=test signature,
        | li=live signature
        |--------------------------------------------------------------------------
        */

        $parts = [];

        foreach (
            explode(',', $signatureHeader)
            as $part
        ) {
            $pair = explode(
                '=',
                $part,
                2
            );

            if (count($pair) === 2) {
                $parts[trim($pair[0])] =
                    trim($pair[1]);
            }
        }

        $timestamp = $parts['t'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Test mode uses "te".
        |--------------------------------------------------------------------------
        */

        $providedSignature =
            $parts['te'] ?? null;

        if (!$timestamp || !$providedSignature) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Reject stale webhook requests.
        |--------------------------------------------------------------------------
        |
        | 5 minutes is a reasonable development window.
        |
        */

        if (
            abs(
                time() - (int) $timestamp
            ) > 300
        ) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | PayMongo signs:
        |
        | timestamp + "." + raw payload
        |--------------------------------------------------------------------------
        */

        $signedPayload =
            $timestamp . '.' . $payload;

        $expectedSignature =
            hash_hmac(
                'sha256',
                $signedPayload,
                $webhookSecret
            );

        return hash_equals(
            $expectedSignature,
            $providedSignature
        );
    }
}