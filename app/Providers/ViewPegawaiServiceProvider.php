<?php

namespace App\Providers;

use App\Models\Pegawai;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Auth\Guard;

class ViewPegawaiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        View::composer('*', function ($view) use ($auth) {
            if ($auth->check()) {
                $user            = $auth->user();
                $pegawai_data    = Pegawai::where('id_user', $user->id)->first();

                switch ($user->role) {
                    case '1':
                        $pegawai_data->role = "Admin";
                        break;
                    case '2':
                        $pegawai_data->role = "Pimpinan";
                        break;
                    default:
                        $pegawai_data->role = "Pegawai";
                        break;
                }

                $view->with('pegawai_data', $pegawai_data);
            }
        });
    }
}
