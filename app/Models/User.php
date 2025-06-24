<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_telp',
        'role',
        'foto_user',
        'avatar',
        'google_id',
        'reset_token',
        'reset_token_expires_at', // Tambahkan ini
        'email_verified_at',
        'password_changed_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'reset_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password_changed_at' => 'datetime',
        'reset_token_expires_at' => 'datetime', // Tambahkan ini
        'password' => 'hashed',
    ];

    /**
     * Check if reset token is valid
     */
    public function isResetTokenValid($token)
    {
        return $this->reset_token === $token &&
               $this->reset_token_expires_at &&
               $this->reset_token_expires_at->isFuture();
    }

    /**
     * Clear reset token
     */
    public function clearResetToken()
    {
        $this->update([
            'reset_token' => null,
            'reset_token_expires_at' => null,
        ]);
    }

    /**
     * Check if user can request password reset
     * Only regular users (non-Google) can reset password
     */
    public function canResetPassword()
    {
        return $this->isRegularUser() && $this->hasPassword();
    }

    /**
     * Get reset token expiry status
     */
    public function getResetTokenStatusAttribute()
    {
        if (!$this->reset_token) {
            return [
                'status' => 'none',
                'message' => 'Tidak ada token reset aktif'
            ];
        }

        if (!$this->reset_token_expires_at) {
            return [
                'status' => 'invalid',
                'message' => 'Token tidak valid'
            ];
        }

        if ($this->reset_token_expires_at->isPast()) {
            return [
                'status' => 'expired',
                'message' => 'Token sudah kadaluarsa'
            ];
        }

        return [
            'status' => 'valid',
            'message' => 'Token masih berlaku',
            'expires_in' => $this->reset_token_expires_at->diffForHumans()
        ];
    }

    /**
     * Check if user has Google account
     */
    public function hasGoogleAccount()
    {
        return !empty($this->google_id);
    }

    /**
     * Check if user is regular (non-Google) user
     */
    public function isRegularUser()
    {
        return empty($this->google_id);
    }

    /**
     * Check if user has password set
     */
    public function hasPassword()
    {
        return !empty($this->password);
    }

    /**
     * Get the formatted last password change date
     */
    public function getLastPasswordChangeAttribute()
    {
        if (!$this->password_changed_at) {
            return 'Belum pernah diubah';
        }

        return $this->password_changed_at->diffForHumans();
    }

    /**
     * Get the formatted last password change date with full format
     */
    public function getLastPasswordChangeFullAttribute()
    {
        if (!$this->password_changed_at) {
            return 'Belum pernah diubah';
        }

        return $this->password_changed_at->format('d M Y, H:i');
    }

    /**
     * Check if user can change password
     * Only regular users (non-Google) can change password
     */
    public function canChangePassword()
    {
        return $this->isRegularUser() && $this->hasPassword();
    }

    /**
     * Get user's login method
     */
    public function getLoginMethodAttribute()
    {
        if ($this->hasGoogleAccount()) {
            return 'Google';
        }

        return 'Email';
    }

    /**
     * Get user's account type for display
     */
    public function getAccountTypeAttribute()
    {
        if ($this->hasGoogleAccount()) {
            return [
                'type' => 'google',
                'label' => 'Akun Google',
                'icon' => 'google',
                'color' => 'blue'
            ];
        }

        return [
            'type' => 'regular',
            'label' => 'Akun Reguler',
            'icon' => 'user',
            'color' => 'gray'
        ];
    }

    // Relationships
    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }

    public function pembayaran()
    {
        return $this->hasManyThrough(Pembayaran::class, Tiket::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function sebagaiPenumpang()
    {
        return $this->hasMany(Penumpang::class);
    }

    public function tiketSebagaiPemesan()
    {
        return $this->hasManyThrough(
            Tiket::class,
            Penumpang::class,
            'user_id', // Foreign key pada Penumpang
            'id', // Foreign key pada Tiket
            'id', // Local key pada User
            'tiket_id' // Local key pada Penumpang
        )->where('penumpang.is_pemesan', true);
    }
}
