<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ResalProduct extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'photo',
        'description',
        'begin_price',
        'display',
    ];

    public function resalVariants(): HasMany
    {
        return $this->hasMany(ResalVariant::class);
    }

    public function market(): HasOne
    {
        return $this->hasOne(Market::class);
    }
}
