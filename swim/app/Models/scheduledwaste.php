<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scheduledwaste extends Model
{
    protected $table = 'scheduledwaste';

    protected $fillable = [
        'id',
        'wastecode',
        'weight',
        'wastedescription',
        'disposalsite',
        'wastetype',
        'packaging',
        'state',
        'statusDisposal',
        'wasteDate', 
        'pic', 
        'expiredDate',
        'transporter', 
        'diff', 

    ];
}
