<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preview extends Model
{
    use HasFactory;

    protected $table      = 'preview_2222336';
    protected $primaryKey = 'id_2222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_2222336',
        'produk_id_2222336',
        'user_id_2222336',
        'komentar_2222336',
        'rating_2222336',
        'is_approved_2222336',
    ];

    protected $casts = [
        'is_approved_2222336' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_2222336 = IdGenerator::generateId(new Preview, 'PRV', 8);
        });
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id_2222336', 'id_2222336');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_2222336', 'id_2222336');
    }
}
