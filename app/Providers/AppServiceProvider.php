<?php

namespace App\Providers;

use App\Models\CompanyProfile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Data profil perusahaan tersedia di layout dan semua halaman web.*
        View::composer(['layouts.app', 'web.*'], function ($view) {
            static $company = false;
            if ($company === false) {
                $company = CompanyProfile::first();
            }
            $view->with('company', $company);
        });
    }
}