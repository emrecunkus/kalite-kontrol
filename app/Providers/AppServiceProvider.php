<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\QualityForm; // QualityForm modelini ekle
use App\Observers\QualityFormObserver; // QualityFormObserver observer'ını ekle

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
        // QualityForm modeline observer'ı bağla
        QualityForm::observe(QualityFormObserver::class);
    }
}
