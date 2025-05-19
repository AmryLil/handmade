<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    use HasFactory;

    protected $table      = 'kategori_produk_222336';
    protected $primaryKey = 'id_222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_222336',
        'nama_222336',
        'deskripsi_222336',
        'path_img_222336',
        'tags_222336',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_222336 = IdGenerator::generateId(new KategoriProduk, 'KTG', 8);
        });
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id_222336', 'id_222336');
    }
}
