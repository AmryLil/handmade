<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $table      = 'gambar_222336';
    protected $primaryKey = 'id_222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_222336',
        'produk_id_222336',
        'path_img_222336',
        'alt_text_222336',
        'is_main_222336',
        'sort_order_222336',
    ];

    protected $casts = [
        'is_main_222336' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_222336 = IdGenerator::generateId(new Gambar, 'IMG', 8);
        });
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id_222336', 'id_222336');
    }
}
