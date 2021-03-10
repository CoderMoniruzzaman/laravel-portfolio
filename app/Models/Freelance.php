<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelance extends Model
{
    use HasFactory;
    protected $fillable = [
        'feelancesite_name',
        'feelancesite_image',
        'feelancesite_description',
        'freelance_url',
        'status',
    ];
}
