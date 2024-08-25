<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    protected $fillable = ['sms', 'type', 'user_id', 'expires_at', 'validated_at'];

    /**
     * Type of Sms
     */
    const OTP = 1;
    const VOUCHER = 2;


    protected $casts = [
        'expires_at' => 'datetime'
    ];


    public function user()
    {
        return $this->morphTo();
    }
}
