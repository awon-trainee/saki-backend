<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Laravel\Passport\HasApiTokens;

class Beneficiaries extends Authenticatable
{
    use HasFactory, HasApiTokens, CrudTrait, SoftDeletes;


    protected $fillable = ['name', 'email', 'id_number', 'income_source', 'phone', 'user_id', 'nationality_id', 'gender', 'material_status', 'monthly_income'];

    protected static function boot()
    {
        parent::boot();

        if (backpack_auth()->check()) {
            if (checkRolesAndPermission(\App\Models\User::ROLE_ADMIN)) {
                return;
            } else {
                static::addGlobalScope('charity', function ($query) {
                    $query->where('user_id', backpack_user()->id);
                });
            }
        }
    }


    public function sms(): MorphMany
    {
        return $this->morphMany(Sms::class, 'user');
    }

    public function getLastSms()
    {
        return $this->sms()->orderByDesc('id')->first();
    }


    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function balance(): MorphOne
    {
        return $this->morphOne(Balance::class, 'user');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function purchase(): HasMany
    {
        return $this->hasMany(Purchase::class, 'beneficiaries_id');
    }

    public function trackingBalanceBeneficiares()
    {
        return $this->hasMany(TrackingBeneficiary::class);
    }

    public function setEmailAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['email'] = NULL;
        } else {
            $this->attributes['email'] = $value;
        }
    }

    public function translatedMaterialStatus()
    {
        $options = [
            'married' => trans('backpack::base.beneficiaries.married'),
            'single' => trans('backpack::base.beneficiaries.single'),
            'widower' => trans('backpack::base.beneficiaries.widower'),
            'divorced' => trans('backpack::base.beneficiaries.divorced'),
        ];

        return $options[$this->material_status];
    }

    public function translatedGender()
    {
        $options = [
            'male' => trans('backpack::base.beneficiaries.male'),
            'female' => trans('backpack::base.beneficiaries.female'),
        ];
        return $options[$this->gender];
    }
}
