<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {




        
        /// callback to change email verification notification content
            // use Illuminate\Auth\Notifications\VerifyEmail;
            // use Illuminate\Notifications\Messages\MailMessage;

            // VerifyEmail::toMailUsing(function ($notifiable, $url) {
            //     return (new MailMessage)
            //         ->subject('Verificá tu correo')
            //         ->line('Gracias por registrarte. Por favor verificá tu correo haciendo clic en el botón.')
            //         ->action('Verificar', $url)
            //         ->line('Si no fuiste vos, ignorá este mensaje.');
            // });
            



    }
}
