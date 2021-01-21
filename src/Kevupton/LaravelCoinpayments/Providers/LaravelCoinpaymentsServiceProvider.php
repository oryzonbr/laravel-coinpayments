<?php namespace Oryzonbr\LaravelCoinpayments\Providers;

use Oryzonbr\LaravelCoinpayments\Controllers\CoinpaymentsController;
use Oryzonbr\LaravelCoinpayments\Facades\Coinpayments;
use Oryzonbr\LaravelCoinpayments\LaravelCoinpayments;
use Oryzonbr\LaravelCoinpayments\Models\Deposit;
use Oryzonbr\LaravelCoinpayments\Models\Transaction;
use Oryzonbr\LaravelCoinpayments\Models\Withdrawal;
use Oryzonbr\LaravelCoinpayments\Observables\DepositObservable;
use Oryzonbr\LaravelCoinpayments\Observables\TransactionObservable;
use Oryzonbr\LaravelCoinpayments\Observables\WithdrawalObservable;
use Oryzonbr\LaravelPackageServiceProvider\ServiceProvider;

class LaravelCoinpaymentsServiceProvider extends ServiceProvider
{

    const SINGLETON = 'coinpayments';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot ()
    {
        $this->registerConfig(__DIR__ . '/../../../config/coinpayments.php', 'coinpayments.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations');

        Deposit::observe(new DepositObservable());
        Withdrawal::observe(new WithdrawalObservable());
        Transaction::observe(new TransactionObservable());
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register ()
    {
        $this->app->singleton(self::SINGLETON, function ($app) {
            return new LaravelCoinpayments($app);
        });

        $this->registerAlias(Coinpayments::class, 'Coinpayments');
        $this->registerRoute();

        $this->mergeConfigFrom(
            __DIR__ . '/../../../config/coinpayments.php', 'coinpayments'
        );
    }

    private function registerRoute ()
    {
        $is_enabled = config('coinpayments.route.enabled');
        $path       = config('coinpayments.route.path');

        if (!$is_enabled) {
            return;
        }

        $router = $this->router();
        $router->post($path, ['as' => 'coinpayments.ipn', 'uses' => CoinpaymentsController::class . '@validateIPN']);
    }
}