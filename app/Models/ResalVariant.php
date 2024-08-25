<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResalVariant extends Model
{
    use CrudTrait;
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'resal_product_id',
        'value',
        'price_with_vat',
        'display',
        'barcode',
        'quantity',
    ];

    public function resalProduct(): BelongsTo
    {
        return $this->belongsTo(ResalProduct::class);
    }
}
