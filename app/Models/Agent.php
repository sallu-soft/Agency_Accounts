<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Agent extends Model
{
    use HasFactory;
    protected $table = 'agent';
    protected $fillable = [
        'id',
        'name',
        'phone',
        'address',
        'id_card',
        'photo'
    ];
}