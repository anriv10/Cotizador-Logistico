<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Support\Facades\Mail::extend("brevo", function () {
            return new \Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoApiTransport(env("BREVO_API_KEY"));
        });

        if (config("app.env") === "production") {
            \URL::forceScheme("https");
        }
    }
}
