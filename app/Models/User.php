<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $fillable = [
        'licence_name',
        'rl_no',
        'phone',
        'office_address',
        'email',
        'password',
        'updated_at',
        'created_at',
        'is_delete',
        'role',
        'previous_month',
        'is_paid'
    ];
}