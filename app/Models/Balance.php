<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Balance extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['user_type' , 'user_id' , 'amount'];


    public function user(): MorphTo
    {
        return $this->morphTo();
    }
}
