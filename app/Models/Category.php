<?php

namespace App\Models;

use App\Enums\MarketStatus;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function market(): BelongsToMany
    {
        return $this->belongsToMany(Market::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activeMarket()
    {
        $beneficiary = auth()->user();
        $charity = $beneficiary->user;
        return $this->market()->where('status', MarketStatus::ACTIVE)->where('user_id', $charity->id);
    }
}
