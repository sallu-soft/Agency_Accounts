<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchase';
    protected $fillable = [
        'id',
        'agent',
        'deal_price',
        'deal_after',
        'order_id',
        'passanger',
        'profit',
        'user',

    ];
}
