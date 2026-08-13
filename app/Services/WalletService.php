<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class WalletService
{
    /**
     * Add money to a wallet.
     */
    public function credit(
        Wallet $wallet,
        float $amount,
        string $type = 'top_up',
        ?string $description = null
    ): void {
        if ($amount <= 0) {
            throw new RuntimeException(
                'Amount must be greater than zero.'
            );
        }

        DB::transaction(function () use (
            $wallet,
            $amount,
            $type,
            $description
        ) {

            /*
            |--------------------------------------------------------------------------
            | Lock the wallet row.
            |--------------------------------------------------------------------------
            */

            $wallet = Wallet::query()
                ->whereKey($wallet->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Calculate the new balance.
            |--------------------------------------------------------------------------
            */

            $balanceBefore = (float) $wallet->balance;
            $balanceAfter = $balanceBefore + $amount;

            /*
            |--------------------------------------------------------------------------
            | Update wallet balance.
            |--------------------------------------------------------------------------
            */

            $wallet->update([
                'balance' => $balanceAfter,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create wallet transaction.
            |--------------------------------------------------------------------------
            */

            $wallet->transactions()->create([
                'type' => $type,
                'amount' => $amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'reference' => $this->generateReference(),
                'description' => $description,
                'status' => 'completed',
            ]);
        });
    }

    /**
     * Deduct money from a wallet.
     */
    public function debit(
        Wallet $wallet,
        float $amount,
        string $type = 'bill_payment',
        ?string $description = null
    ): void {
        if ($amount <= 0) {
            throw new RuntimeException(
                'Amount must be greater than zero.'
            );
        }

        DB::transaction(function () use (
            $wallet,
            $amount,
            $type,
            $description
        ) {

            /*
            |--------------------------------------------------------------------------
            | Lock the wallet row.
            |--------------------------------------------------------------------------
            |
            | This prevents two simultaneous payments from
            | modifying the wallet balance incorrectly.
            |
            */

            $wallet = Wallet::query()
                ->whereKey($wallet->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Check wallet balance.
            |--------------------------------------------------------------------------
            */

            $balanceBefore = (float) $wallet->balance;

            if ($balanceBefore < $amount) {
                throw new RuntimeException(
                    'Insufficient wallet balance.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Calculate new balance.
            |--------------------------------------------------------------------------
            */

            $balanceAfter = $balanceBefore - $amount;

            /*
            |--------------------------------------------------------------------------
            | Update wallet balance.
            |--------------------------------------------------------------------------
            */

            $wallet->update([
                'balance' => $balanceAfter,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Record wallet transaction.
            |--------------------------------------------------------------------------
            */

            $wallet->transactions()->create([
                'type' => $type,
                'amount' => $amount,
                'balance_before' => $balanceBefore,
                'balance_after' => $balanceAfter,
                'reference' => $this->generateReference(),
                'description' => $description,
                'status' => 'completed',
            ]);
        });
    }

    /**
     * Generate a unique AMEPSO transaction reference.
     */
    private function generateReference(): string
    {
        do {

            $reference =
                'AMP-' .
                now()->format('YmdHis') .
                '-' .
                Str::upper(Str::random(6));

        } while (
            WalletTransaction::where(
                'reference',
                $reference
            )->exists()
        );

        return $reference;
    }
}