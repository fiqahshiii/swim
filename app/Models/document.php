<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    protected $table = 'document';
    protected $fillable = [
        'id',
        'swcode',
        'filename',
        'document',
    ];
    use HasFactory;
}
