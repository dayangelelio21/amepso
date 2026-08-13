<?php

namespace Database\Seeders;

use App\Models\OrmecoAccount;
use App\Models\OrmecoBill;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrmecoTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first registered AMEPSO user.
        $user = User::first();

        if (!$user) {
            $this->command->error('No AMEPSO user found. Please register a user first.');
            return;
        }

        // Create or retrieve the test ORMECO account.
        $account = OrmecoAccount::firstOrCreate(
            [
                'account_number' => '123456789',
            ],
            [
                'user_id' => $user->id,
                'account_name' => $user->name,
                'meter_number' => 'MTR-000123',
                'service_address' => 'Bansud, Oriental Mindoro',
            ]
        );

        // Create or retrieve the test bill.
        OrmecoBill::firstOrCreate(
            [
                'bill_number' => 'ORMECO-2026-0001',
            ],
            [
                'ormeco_account_id' => $account->id,
                'amount' => 350.00,
                'billing_date' => '2026-08-01',
                'due_date' => '2026-08-20',
                'status' => 'unpaid',
            ]
        );

        $this->command->info('Test ORMECO account and bill created successfully.');
    }
}