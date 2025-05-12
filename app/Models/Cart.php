<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table      = 'carts_2222336';
    protected $primaryKey = 'id_2222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_2222336',
        'user_id_2222336',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_2222336 = IdGenerator::generateId(new Cart, 'CRT', 8);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id_2222336', 'id_2222336');
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id_2222336', 'id_2222336');
    }
}
