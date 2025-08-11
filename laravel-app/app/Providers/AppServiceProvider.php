<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // パスワードポリシー: 8桁以上、英字と数字を必ず含む
        Password::defaults(function () {
            return Password::min(8)
                ->letters()
                ->numbers()
                ->uncompromised();
        });
    }
}
