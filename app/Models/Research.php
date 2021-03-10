<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;
    protected $fillable = [
        'research_title',
        'research_description',
        'research_publication_link',
        'research_project_url',
        'status',
    ];
}
