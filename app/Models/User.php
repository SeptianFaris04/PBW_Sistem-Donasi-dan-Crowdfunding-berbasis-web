<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
     protected $fillable = [
        'name',
        'google_id',
        'email',
        'password',
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

    public function Payment():HasMany{
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function Donasi():HasMany{
        return $this->hasMany(Donasi::class, 'user_id');
    }

    public function UrunDana():HasMany{
        return $this->hasMany(UrunDana::class, 'user_id');
    }

    // public function model_has_roles():MorphToMany{
    //     return $this->morphToMany(Role::class, 'model', 'model_has_roles', 'model_id', 'role_id');
    // }

    // public function model_has_permissions():MorphToMany{
    //     return $this->morphToMany(Permission::class, 'model', 'model_has_permissions', 'model_id', 'permission_id');
    // }
}
