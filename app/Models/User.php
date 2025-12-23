<?php

namespace App\Models;

// Import Interface JWT Contract dari library yang sudah diinstall
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    /**
     * PENTING:
     * Kita HAPUS "HasApiTokens" dari sini karena kita menggunakan JWT murni.
     * Jika "HasApiTokens" tetap ada saat laravel/sanctum dihapus, website akan error.
     */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Wajib ada sesuai fitur register kamu
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // =========================================================
    // WAJIB ADA: METHOD UNTUK JWT AUTHENTICATION
    // =========================================================

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * (Biasanya ID user)
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * (Kita bisa menyisipkan data tambahan ke dalam token, misal: role)
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role, // Berguna untuk cek hak akses di frontend nanti
        ];
    }
}
