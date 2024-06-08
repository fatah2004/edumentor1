<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            $isResponsible = false;

            if ($user && $user->usertype == 'user') {
                $isResponsible = TrainingSession::where('responsible_mentor_id', $user->id)->exists();
            }

            $view->with('isResponsible', $isResponsible);
        });
    }
}
