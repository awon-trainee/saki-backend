<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Purchase extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'beneficiaries_id',
        'amount_detect',
        'status',
        'amount',
        'item_id',
        'qty',
        'resal_order_id',
        'resal_redemption_id',
        'code',
    ];


    protected static function boot()
    {
        parent::boot();

        if (backpack_auth()->check()) {
            if (checkRolesAndPermission(\App\Models\User::ROLE_ADMIN)) {
                return;
            } else {
                static::addGlobalScope('charity', function ($query) {
                    $query->whereHas('beneficiary', function ($query) {
                        $query->where('user_id', backpack_user()->id);
                    });
                });
            }
        }
    }


    protected $casts = [
        'code' => 'encrypted',
    ];

    public function item(): HasOne
    {
        return $this->hasOne(ResalVariant::class, 'id', 'item_id');
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiaries::class, 'beneficiaries_id');
    }
}
