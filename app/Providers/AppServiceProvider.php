<?php

namespace App\Providers;

use App\Filesystem\CloudinaryAdapter;
use App\Models\Gambar;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Storage;
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
        //
        Gambar::updated(function ($gambar) {
            if ($gambar->is_main_222336) {
                // Jika gambar ini ditetapkan sebagai utama, nonaktifkan is_main untuk gambar lain dari produk yang sama
                Gambar::where('produk_id_222336', $gambar->produk_id_222336)
                    ->where('id_222336', '!=', $gambar->id_222336)
                    ->update(['is_main_222336' => false]);
            }
        });
    }
}
