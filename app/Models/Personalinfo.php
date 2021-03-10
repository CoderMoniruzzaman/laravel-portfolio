<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personalinfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'age',
        'description',
        'status',
        'address',
        'cv',
        'image',
        'phone',
        'skype',
    ];
}
