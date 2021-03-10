<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillKnowledge extends Model
{
    use HasFactory;
    protected $fillable = [
        'knowledgeskill_name',
        'percentage',
        'skill_color',
        'status',
    ];
}
