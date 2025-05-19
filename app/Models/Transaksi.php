<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table      = 'transaksi_222336';
    protected $primaryKey = 'id_transaksi_222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_transaksi_222336',
        'id_pelanggan_222336',
        'id_produk_222336',
        'jumlah_222336',
        'harga_total_222336',
        'status_222336',
        'bukti_tf_222336',
        'tanggal_transaksi_222336',
    ];

    protected $casts = [
        'tanggal_transaksi_222336' => 'datetime',
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
        return $this->belongsTo(Users::class, 'id_pelanggan_222336', 'id_222336');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk_222336', 'id_222336');
    }
}
