<?php

namespace App\Models;

use App\Enums\TransferStatus;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Transfer extends Model
{
    use CrudTrait, HasFactory;

    protected $fillable = ['user_id', 'amount' , 'reject_by' ,'from_name', 'status'];


    protected $casts = [
        'status' => TransferStatus::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function upload(): MorphOne
    {
        return $this->morphOne(Upload::class, 'upload');
    }

    public function trackingBalance(): HasOne
    {
        return $this->hasOne(TrackingBalance::class);
    }

}
