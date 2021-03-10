<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Work;

class PortfolioController extends Controller
{

    public function index()
    {
        $categoreies = Category::where('status', 1)->get();
        $works = Work::where('project_status', 1)->get();
        return view('frontend/page/portfolio',compact('categoreies','works'));
    }

    public function portfolioindex($id)
    {
        $categoreies = Category::all();
        $skills = Skill::all();
        $projects_info = Work::findOrFail($id);
        $multiple_photos = json_decode($projects_info->slider_image, true);
        $related_products = Work::where('id', '!=',$id)->where('category_id',$projects_info->category_id)->get();
        return view('frontend/page/workdetails',compact('projects_info','categoreies','skills','multiple_photos','related_products'));
    }

}
