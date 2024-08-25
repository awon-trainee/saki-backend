<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name_en' , 'name_ar', 'nationality_en' , 'nationality_ar' , 'code'];





}
