<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanCustom extends Model
{
    use HasFactory;

    protected $table      = 'permintaan_custom_222336';
    protected $primaryKey = 'id_222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_222336',
        'user_id_222336',
        'judul_222336',
        'deskripsi_222336',
        'path_img_222336',
        'status_222336',
        'harga_penawaran_222336',
        'harga_akhir_222336',
        'catatan_admin_222336',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_222336 = IdGenerator::generateId(new PermintaanCustom, 'CST', 8);
        });
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id_222336', 'email_222336');
    }
}
