<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socilalink extends Model
{
    use HasFactory;
    protected $fillable = [
        'socail_name',
        'link',
        'icon',
        'status',
    ];
}
