<?php

use App\Http\Controllers\Admin\OrmecoBillController;
use App\Http\Controllers\OrmecoController;
use App\Http\Controllers\PayMongoWebhookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletTransactionController;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| PayMongo Webhook
|--------------------------------------------------------------------------
|
| IMPORTANT:
| This route must NOT use auth or verified middleware.
| PayMongo needs to access this endpoint directly.
|
*/

Route::post('/webhooks/paymongo', [
    PayMongoWebhookController::class,
    'handle',
])->name('webhooks.paymongo');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
|
| All admin routes are protected by:
| - auth
| - verified
| - admin
|
*/

Route::middleware([
    'auth',
    'verified',
    'admin',
])->prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/', [
        \App\Http\Controllers\Admin\AdminDashboardController::class,
        'index',
    ])->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::get('/users', [
        \App\Http\Controllers\Admin\AdminUserController::class,
        'index',
    ])->name('users.index');


    Route::get('/users/{user}', [
        \App\Http\Controllers\Admin\AdminUserController::class,
        'show',
    ])->name('users.show');


    /*
    |--------------------------------------------------------------------------
    | Assign / Remove Admin Role
    |--------------------------------------------------------------------------
    */

    Route::patch('/users/{user}/role', [
        \App\Http\Controllers\Admin\AdminUserController::class,
        'updateRole',
    ])->name('users.role');


    /*
    |--------------------------------------------------------------------------
    | Top Ups
    |--------------------------------------------------------------------------
    */

    Route::get('/top-ups', [
        \App\Http\Controllers\Admin\AdminTopUpController::class,
        'index',
    ])->name('topups.index');


    /*
    |--------------------------------------------------------------------------
    | Transactions
    |--------------------------------------------------------------------------
    */

    Route::get('/transactions', [
        \App\Http\Controllers\Admin\AdminTransactionController::class,
        'index',
    ])->name('transactions.index');


    /*
    |--------------------------------------------------------------------------
    | ORMECO Management
    |--------------------------------------------------------------------------
    */

    Route::get('/ormeco', [
        \App\Http\Controllers\Admin\AdminOrmecoController::class,
        'index',
    ])->name('ormeco.index');


    /*
    |--------------------------------------------------------------------------
    | ORMECO Bill Management
    |--------------------------------------------------------------------------
    */

    Route::get('/ormeco-bills', [
        OrmecoBillController::class,
        'index',
    ])->name('ormeco-bills.index');


    Route::get('/ormeco-bills/create', [
        OrmecoBillController::class,
        'create',
    ])->name('ormeco-bills.create');


    Route::post('/ormeco-bills', [
        OrmecoBillController::class,
        'store',
    ])->name('ormeco-bills.store');

});


/*
|--------------------------------------------------------------------------
| Homepage
|--------------------------------------------------------------------------
|
| Redirect the root URL to the AMEPSO login page.
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = Auth::user();


    /*
    |--------------------------------------------------------------------------
    | Find the user's wallet
    |--------------------------------------------------------------------------
    */

    $wallet = Wallet::where(
        'user_id',
        $user->id
    )->first();


    /*
    |--------------------------------------------------------------------------
    | Create wallet if it does not exist
    |--------------------------------------------------------------------------
    */

    if (!$wallet) {

        $wallet = new Wallet();

        $wallet->user_id = $user->id;
        $wallet->balance = 0.00;

        $wallet->save();
    }


    /*
    |--------------------------------------------------------------------------
    | Load recent transactions
    |--------------------------------------------------------------------------
    */

    $wallet->load([
        'transactions' => function ($query) {

            $query
                ->latest()
                ->take(5);

        },
    ]);


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    return view(
        'dashboard',
        compact('wallet')
    );

})->middleware([
    'auth',
    'verified',
])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Authenticated Application Routes
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | TOP UP
    |--------------------------------------------------------------------------
    */

    Route::get('/topup', [
        TopUpController::class,
        'index',
    ])->name('topup.index');


    Route::post('/topup', [
        TopUpController::class,
        'store',
    ])->name('topup.store');


    Route::get('/top-up/history', [
        TopUpController::class,
        'history',
    ])->name('topup.history');


    Route::get('/topup/success', [
        TopUpController::class,
        'success',
    ])->name('topup.success');


    Route::get('/topup/{topUp}', [
        TopUpController::class,
        'show',
    ])->name('topup.show');


    /*
    |--------------------------------------------------------------------------
    | TRANSACTIONS
    |--------------------------------------------------------------------------
    */

    Route::get('/transactions', [
        TransactionController::class,
        'index',
    ])->name('transactions.index');


    Route::get('/transactions/{transaction}', [
        WalletTransactionController::class,
        'show',
    ])->name('transactions.show');


    /*
    |--------------------------------------------------------------------------
    | ORMECO
    |--------------------------------------------------------------------------
    */

    Route::get('/ormeco', [
        OrmecoController::class,
        'index',
    ])->name('ormeco.index');


    Route::post('/ormeco/lookup', [
        OrmecoController::class,
        'lookup',
    ])->name('ormeco.lookup');


    Route::post('/ormeco/{bill}/pay', [
        OrmecoController::class,
        'pay',
    ])->name('ormeco.pay');


    Route::get('/ormeco/{bill}/receipt', [
        OrmecoController::class,
        'receipt',
    ])->name('ormeco.receipt');

});


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        ProfileController::class,
        'edit',
    ])->name('profile.edit');


    Route::patch('/profile', [
        ProfileController::class,
        'update',
    ])->name('profile.update');


    Route::delete('/profile', [
        ProfileController::class,
        'destroy',
    ])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';