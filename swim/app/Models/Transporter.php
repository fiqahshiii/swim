<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    protected $table = 'transporter';

    protected $fillable = [
        'id',
        'scheduledwasteID',
        'fullname',
        'phonenum',
        'email',
        'address',
        'gender',
    ];
}
