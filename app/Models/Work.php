<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'project_description',
        'category_id',
        'skill_id',
        'project_image',
        'slider_image',
        'client_link',
        'project_link',
        'project_status',
        'project_video_link',
    ];

    function relationcategory(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    function relationskill(){
        return $this->belongsToMany(Skill::class, 'skill_work');
    }



}
