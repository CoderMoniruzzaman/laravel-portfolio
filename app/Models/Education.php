<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'institute_name',
        'institute_degree',
        'degree_year',
        'education_description',
        'status',
    ];
}
