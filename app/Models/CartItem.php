<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table      = 'cart_items_2222336';
    protected $primaryKey = 'id_2222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_2222336',
        'cart_id_2222336',
        'product_id_2222336',
        'quantity_2222336',
        'price_2222336',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_2222336 = IdGenerator::generateId(new CartItem, 'CIT', 8);
        });
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id_2222336', 'id_2222336');
    }

    public function product()
    {
        return $this->belongsTo(Produk::class, 'product_id_2222336', 'id_2222336');
    }
}
