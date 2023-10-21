<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Visa extends Model
{
    use HasFactory;
    protected $table = 'visa';
    protected $fillable = [
        'id',
        'buy_form',
        'company',
        'country',
        'worker_salary',
        'prof_name',
        'purchase_tk',
        'quantity',
        'per_visa',
        'invoice'

    ];
}