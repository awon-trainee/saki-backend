<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, CrudTrait, HasFactory, Notifiable, LogsActivity;


    /**
     * Roles
     */

    const ROLE_ADMIN = 'admin';
    const ROLE_CHARITY = 'charity';


    /**
     * Type
     */

    const ADMIN = 1;
    const CHARITY = 2;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'type',
        'charity_name'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('user');
    }

    public function sms(): HasMany
    {
        return $this->hasMany(Sms::class);
    }


    public function balance(): MorphOne
    {
        return $this->morphOne(Balance::class, 'user');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'user_id');
    }

    public function beneficiaries(): HasMany
    {
        return $this->hasMany(Beneficiaries::class, 'user_id');
    }
}
