<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preview extends Model
{
    use HasFactory;

    protected $table      = 'preview_222336';
    protected $primaryKey = 'id_222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_222336',
        'produk_id_222336',
        'user_id_222336',
        'komentar_222336',
        'rating_222336',
        'is_approved_222336',
    ];

    protected $casts = [
        'is_approved_222336' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_222336 = IdGenerator::generateId(new Preview, 'PRV', 8);
        });
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id_222336', 'id_222336');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_222336', 'id_222336');
    }
}
