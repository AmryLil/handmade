<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table      = 'cart_items_222336';
    protected $primaryKey = 'id_222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_222336',
        'cart_id_222336',
        'product_id_222336',
        'quantity_222336',
        'price_222336',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_222336 = IdGenerator::generateId(new CartItem, 'CIT', 8);
        });
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id_222336', 'id_222336');
    }

    public function product()
    {
        return $this->belongsTo(Produk::class, 'product_id_222336', 'id_222336');
    }
}
