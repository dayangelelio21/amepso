<?php

namespace App\Services;

use App\Models\TopUp;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TopUpService
{
    /**
     * Complete a paid top-up and credit the user's wallet.
     *
     * This method is idempotent:
     * the same top-up cannot credit the wallet twice.
     */
    public function complete(TopUp $topUp): void
    {
        DB::transaction(function () use ($topUp) {

            /*
             * Lock the top-up row.
             *
             * This prevents two requests from processing
             * the same top-up at the same time.
             */
            $topUp = TopUp::query()
                ->whereKey($topUp->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
             * If this top-up has already been credited,
             * stop immediately.
             */
            if ($topUp->credited_at !== null) {
                return;
            }

            /*
             * Only pending top-ups can be completed.
             */
            if ($topUp->status !== 'pending') {
                throw new RuntimeException(
                    'This top-up cannot be completed.'
                );
            }

            /*
             * Get the user's wallet.
             */
            $wallet = $topUp->user->wallet;

            if (!$wallet) {
                throw new RuntimeException(
                    'The user wallet could not be found.'
                );
            }

            /*
             * Lock the wallet row.
             *
             * This prevents concurrent requests from
             * modifying the same balance incorrectly.
             */
            $wallet = $wallet->newQuery()
                ->whereKey($wallet->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
             * Calculate the new balance.
             */
            $balanceBefore = (float) $wallet->balance;
            $amount = (float) $topUp->amount;
            $balanceAfter = $balanceBefore + $amount;

            /*
             * Credit the wallet.
             */
            $wallet->update([
                'balance' => $balanceAfter,
            ]);

            /*
             * Record the wallet transaction.
             */
            $wallet->transactions()->create([
                'type' => 'top_up',
                'amount' => $amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'reference' => $topUp->reference,
                'description' => 'Wallet top-up',
                'status' => 'completed',
            ]);

            /*
             * Mark the top-up as completed and credited.
             */
            $topUp->update([
                'status' => 'completed',
                'paid_at' => $topUp->paid_at ?? now(),
                'credited_at' => now(),
            ]);
        });
    }
}