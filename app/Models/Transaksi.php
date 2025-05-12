<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table      = 'transaksi_2222336';
    protected $primaryKey = 'id_transaksi_2222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_transaksi_2222336',
        'id_pelanggan_2222336',
        'id_produk_2222336',
        'jumlah_2222336',
        'harga_total_2222336',
        'status_2222336',
        'bukti_tf_2222336',
        'tanggal_transaksi_2222336',
    ];

    protected $casts = [
        'tanggal_transaksi_2222336' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            // Explicitly use the correct key name
            $model->{$model->getKeyName()} = IdGenerator::generateId(new Transaksi, 'TRX', 8);
        });
    }

    public function pelanggan()
    {
        return $this->belongsTo(Users::class, 'id_pelanggan_2222336', 'id_2222336');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk_2222336', 'id_2222336');
    }
}
