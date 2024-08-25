<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['market_id', 'daleel_store_market_id' , 'amount'];


    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }


    public function daleelStoreMarket()
    {
        return $this->belongsTo(DaleelStoreMarket::class);
    }
}
