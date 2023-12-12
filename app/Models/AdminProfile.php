<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'phone',
        'address',
        'country',
        'city',
        'image',
        'email'
    ];
    protected $table = 'admin_profile';

    use HasFactory;
}
