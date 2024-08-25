<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingBalance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id' , 'old_balance' , 'action_by' , 'new_balance' , 'transfer_id'];
}
