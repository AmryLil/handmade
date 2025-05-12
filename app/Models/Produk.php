<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    use HasFactory;

    protected $table      = 'produk_2222336';
    protected $primaryKey = 'id_2222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_2222336',
        'nama_2222336',
        'deskripsi_2222336',
        'harga_2222336',
        'kategori_id_2222336',
        'path_img_2222336',
        'jumlah_2222336',
    ];

    /**
     * Get the fully qualified URL for the product image
     */
    public function getImageUrlAttribute()
    {
        if ($this->path_img_2222336 && Storage::disk('public')->exists($this->path_img_2222336)) {
            return Storage::url($this->path_img_2222336);
        }

        return null;  // Or a default image placeholder
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_2222336 = IdGenerator::generateId(new Produk, 'PRD', 8);
        });
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id_2222336', 'id_2222336');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id_2222336', 'id_2222336');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_produk_2222336', 'id_2222336');
    }

    public function gambar()
    {
        return $this->hasMany(Gambar::class, 'produk_id_2222336', 'id_2222336');
    }

    public function gambarUtama()
    {
        return $this->gambar()->where('is_main_2222336', true)->first();
    }

    public function preview()
    {
        return $this->hasMany(Preview::class, 'produk_id_2222336', 'id_2222336');
    }
}
