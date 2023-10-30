<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class VisaSell extends Model
{
    use HasFactory;
    protected $table = 'visa_sell';
    protected $fillable = [
        'id',
        'agent',
        'company',
        'passanger',
        'sell_price',
        'total',
        'profit',
        'quantity',
        'user',
        'visa'

    ];
}
