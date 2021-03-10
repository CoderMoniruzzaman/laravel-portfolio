<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Freelance;

class FreelanceController extends Controller
{
    public function index()
    {
        $all_freelances = Freelance::orderBy('created_at', 'DESC')->where('status', 1)->get();
        return view('frontend/page/freelance',compact('all_freelances'));
    }
}
