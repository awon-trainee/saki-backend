<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingBeneficiary extends Model
{
    use HasFactory;

    protected $fillable = ['market_id', 'amount' , 'operation', 'old_balance', 'new_balance', 'beneficiaries_id'];

    /**
     * Operation Type
     */

    const PURCHASE = 'purchase';
    const TRANSFER = 'transfer';

    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiaries::class , 'beneficiaries_id');
    }
}
