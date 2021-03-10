<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\SkillKnowledge;
class HomeController extends Controller
{
    public function index()
    {
        $all_skills = SkillKnowledge::orderBy('created_at', 'DESC')->where('status', 1)->get();
        $all_services = Service::orderBy('created_at', 'ASC')->where('status', 1)->get();
        return view('frontend/page/home',compact('all_skills','all_services'));
    }
}
