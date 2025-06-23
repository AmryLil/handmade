<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Voucher extends Model
{
    use HasFactory;

    protected $table      = 'vouchers_222336';
    protected $primaryKey = 'id_voucher_222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_voucher_222336',
        'kode_voucher_222336',
        'id_user_222336',
        'tipe_222336',
        'persentase_diskon_222336',
        'tanggal_kadaluarsa_222336',
        'status_222336',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id_voucher_222336) {
                $latest                   = static::latest('id_voucher_222336')->first();
                $lastNumber               = $latest ? (int) substr($latest->id_voucher_222336, 2) : 0;
                $model->id_voucher_222336 = 'VC' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            }
            if (!$model->kode_voucher_222336) {
                $model->kode_voucher_222336 = 'DISKON-' . strtoupper(Str::random(8));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'id_user_222336', 'email_222336');
    }
}
