<?php
namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // MSSQL bağlantısından stok verilerini doğrudan çekiyoruz
        $stoklar = DB::connection('external')
                     ->table('TBLSTSABIT')
                     ->select('stok_kodu', 'stok_adi')
                     ->get();

        // Tüm view'lere stok bilgilerini paylaş
        View::share('stoklar', $stoklar);
    }

    public function register()
    {
        //
    }
}
