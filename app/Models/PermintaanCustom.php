<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanCustom extends Model
{
    use HasFactory;

    protected $table      = 'permintaan_custom_2222336';
    protected $primaryKey = 'id_2222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_2222336',
        'user_id_2222336',
        'judul_2222336',
        'deskripsi_2222336',
        'path_img_2222336',
        'status_2222336',
        'harga_penawaran_2222336',
        'harga_akhir_2222336',
        'catatan_admin_2222336',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_2222336 = IdGenerator::generateId(new PermintaanCustom, 'CST', 8);
        });
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id_2222336', 'id_2222336');
    }
}
