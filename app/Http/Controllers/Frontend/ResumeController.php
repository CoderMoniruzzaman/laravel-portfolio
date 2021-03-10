<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Achievement;
use App\Models\Research;

class ResumeController extends Controller
{

    public function index()
    {
        $all_educations = Education::orderBy('created_at', 'DESC')->where('status', 1)->get();
        $all_experiences = Experience::orderBy('created_at', 'DESC')->where('status', 1)->get();
        $all_achievements = Achievement::orderBy('created_at', 'DESC')->where('status', 1)->get();
        $all_researchs = Research::orderBy('created_at', 'DESC')->where('status', 1)->get();
        return view('frontend/page/resume',compact('all_educations','all_experiences','all_achievements','all_researchs'));
    }

}
