<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    protected $table = 'transporter';

    protected $fillable = [
        'id',
        'fullname',
        'phonenum',
        'email',
        'address',
        'gender',
        'platenumber',
        'city',
        'status', 
    ];
}
