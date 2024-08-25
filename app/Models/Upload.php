<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'file_name', 'user_id' ,'original_name', 'background', 'file_size', 'mime', 'reference_type', 'reference_id'];

    const ATTACHMENT = 'attachment';
    const RECEIPT = 'receipt';

    const MARKET = 'market';


    public function upload(): MorphTo
    {
        return $this->morphTo();
    }
}
