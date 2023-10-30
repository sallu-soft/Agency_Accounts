<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Passenger extends Model
{
    use HasFactory;
    protected $table = 'passenger';
    protected $fillable = [
        'id',
        'passenger_name',
        'pnumber',
        'image_file',
        'passport_pic',
        'district',
        'agent',
        'passport',
        'address',
        'id_card',
        'photo'
    ];
}
