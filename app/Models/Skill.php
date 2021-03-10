<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'skill_name',
        'status',
    ];
    public function works() {
        return $this->belongsToMany(Work::class,'skill_work');
    }
}
