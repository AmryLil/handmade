<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    use HasFactory;

    protected $table      = 'gambar_2222336';
    protected $primaryKey = 'id_2222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_2222336',
        'produk_id_2222336',
        'path_img_2222336',
        'alt_text_2222336',
        'is_main_2222336',
        'sort_order_2222336',
    ];

    protected $casts = [
        'is_main_2222336' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_2222336 = IdGenerator::generateId(new Gambar, 'IMG', 8);
        });
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id_2222336', 'id_2222336');
    }
}
