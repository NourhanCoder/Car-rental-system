<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\Facades\View;
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
        View::composer('admin.layouts.app', function($view){
            $unreadCount = Contact::where('is_read', false)->count();
            $unreadMessages = Contact::where('is_read', false)->latest()->take(5)->get();

            $view->with(compact('unreadCount', 'unreadMessages'));
        });
    }
}
