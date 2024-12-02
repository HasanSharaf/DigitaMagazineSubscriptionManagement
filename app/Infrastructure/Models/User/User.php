<?php

namespace App\Infrastructure\Models\User;

use App\Enums\UserRoleEnum;
use App\Infrastructure\Models\BaseModel;
use App\Infrastructure\Models\Comment\Comment;
use App\Infrastructure\Models\Payment\Payment;
use App\Infrastructure\Models\Subscription\Subscription;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends BaseModel implements Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = ['id'];

    protected $casts = [
        'role' => UserRoleEnum::class,
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin';
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
