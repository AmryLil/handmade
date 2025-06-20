<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table      = 'carts_222336';
    protected $primaryKey = 'id_222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_222336',
        'user_id_222336',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_222336 = IdGenerator::generateId(new Cart, 'CRT', 8);
        });
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'email_222336', 'user_id_222336');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id_222336', 'id_222336');
    }
}
