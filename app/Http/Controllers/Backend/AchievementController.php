<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Achievement;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Redirect,Response;

class AchievementController extends Controller
{
    public function index()
    {
        $achievementsites = Achievement::orderBy('created_at', 'DESC')->get();
        return view('backend.page.achievement.index',compact('achievementsites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'achievement_title' => 'required|unique:achievements,achievement_title',
            'achievement_image' => 'mimes:jpeg,jpg,png,gif|required|max:500000',
        ]);
        if($validator){
            $last_inserted_id = Achievement::insertGetId([
                'achievement_title' => $request->achievement_title,
                'achievement_description' => $request->achievement_description,
                'achievement_url' => $request->achievement_url,
                'created_at' => Carbon::now()
            ]);
            if($request->hasFile('achievement_image',)){
                $photo_to_upload = $request->achievement_image;
                $filename = $last_inserted_id.".".$photo_to_upload->getClientOriginalExtension();
                Image::make($photo_to_upload)->resize(750,490)->save(base_path('public/uploads/achievement/'.$filename));
                Achievement::find($last_inserted_id)->update([
                'achievement_image' => $filename,
                ]);
            }
            toast('Achievement have been created succesfully ','success');
        }
        return redirect('admin/achievementsite');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->hasFile('achievement_image')){
            if (Achievement::find($request->achi_id)->achievement_image == 'defaultachievementphoto.jpg') {
                $photo_to_upload = $request->achievement_image;
                $filename = $request->achi_id.".".$photo_to_upload->getClientOriginalExtension();
                Image::make($photo_to_upload)->resize(750,490)->save(base_path('public/uploads/achievement/'.$filename));
                Achievement::find($request->achi_id)->update([
                'achievement_image' => $filename,
                ]);
            }
            else {
                $delete_this_file = Achievement::find($request->achi_id)->achievement_image;
                unlink(base_path('public/uploads/achievement/'.$delete_this_file));
                $photo_to_upload = $request->achievement_image;
                $filename = $request->achi_id.".".$photo_to_upload->getClientOriginalExtension();
                Image::make($photo_to_upload)->resize(750,490)->save(base_path('public/uploads/achievement/'.$filename));
                Achievement::find($request->achi_id)->update([
                'achievement_image' => $filename,
                ]);
            }
        }
        Achievement::find($request->achi_id)->update([
            'achievement_title' => $request->achievement_title,
            'achievement_description' => $request->achievement_description,
            'achievement_url' => $request->achievement_url,
        ]);
        toast('Achievement have been updated','info');
        return redirect('admin/achievementsite');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $achievement = Achievement::findOrFail($id);
        if ($achievement){
            $delete_this = Achievement::findOrFail($id)->achievement_image;
            unlink(base_path('public/uploads/achievement/'.$delete_this));
            $achievement->delete();
            toast('Achievement have been deleted','warning');
            return redirect('admin/achievementsite');
        }
    }

    public function status($id)
    {
        if ($achievement = Achievement::find($id)->status) {
            Achievement::findOrFail($id)->update([
                'status' => 0,
          ]);
          toast('Achievement site Deactivated ','warning');
        }
        else {
            Achievement::findOrFail($id)->update([
                'status' => 1,
          ]);
          toast('Achievement site Activated ','success');
        }
        return redirect('admin/achievementsite');
    }
}
