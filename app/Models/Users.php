<?php

namespace App\Models;

use App\Helpers\IdGenerator;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table      = 'users_2222336';
    protected $primaryKey = 'id_2222336';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_2222336',
        'email_2222336',
        'name',
        'password_2222336',
        'gender_2222336',
        'role_2222336',
        'address_2222336',
        'phone_2222336',
        'birth_date_2222336',
        'profile_photo_2222336',
    ];

    protected $hidden = [
        'password_2222336',
    ];

    protected $casts = [
        'birth_date_2222336' => 'date',
    ];

    public function getAuthPassword()
    {
        return $this->password_2222336;
    }

    public function getAuthIdentifierName()
    {
        return 'id_2222336';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_2222336 = IdGenerator::generateId(new Users, 'USR', 8);
        });
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id_2222336', 'id_2222336');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan_2222336', 'id_2222336');
    }

    public function reviews()
    {
        return $this->hasMany(Preview::class, 'user_id_2222336', 'id_2222336');
    }

    public function permintaanCustom()
    {
        return $this->hasMany(PermintaanCustom::class, 'user_id_2222336', 'id_2222336');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role_2222336 === 'admin';
    }

    // For Filament avatar
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->profile_photo_2222336 ? asset('storage/' . $this->profile_photo_2222336) : null;
    }

    // If you want to use Filament name display

    public function getFilamentName(): string
    {
        return "{$this->name} ";
    }
}
