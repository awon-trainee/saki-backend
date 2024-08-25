<?php

namespace App\Models;

use App\Enums\MarketStatus;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Market extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'support_delivery',
        'description',
        'status',
        'resal_product_id',
        'user_id',
    ];

    protected $casts = [
        'status' => MarketStatus::class
    ];


    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    // public function items():HasMany
    // {
    //     return $this->hasMany(Item::class);
    // }

    public function resalProduct(): BelongsTo
    {
        return $this->belongsTo(ResalProduct::class);
    }

    public function upload(): MorphMany
    {
        return $this->morphMany(Upload::class, 'upload');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
