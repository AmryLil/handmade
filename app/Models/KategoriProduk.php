<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    use HasFactory;

    protected $table      = 'kategori_produk_2222336';
    protected $primaryKey = 'id_2222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_2222336',
        'nama_2222336',
        'deskripsi_2222336',
        'path_img_2222336',
        'tags_2222336',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_2222336 = IdGenerator::generateId(new KategoriProduk, 'KTG', 8);
        });
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id_2222336', 'id_2222336');
    }
}
