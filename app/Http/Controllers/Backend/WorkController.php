<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Skill;
use Carbon\Carbon;
use App\Models\Work;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class WorkController extends Controller
{
    public function index()
    {
        $categoreies = Category::all();
        $projects = Work::all();
        return view('backend.page.work.index',compact('projects','categoreies'));
    }

    public function create()
    {
        $categoreies = Category::orderBy('created_at', 'DESC')->where('status', 1)->get();
        $skills = Skill::orderBy('created_at', 'DESC')->where('status', 1)->get();
        return view('backend.page.work.create',compact('categoreies','skills'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'project_name' => 'required',
            'project_description' => 'required',
            'category_id' => 'required',
            'skill_id' => 'required',
            'project_image' => 'required',
        ]);
        if($validate){
            $work = new Work();
            $work->project_name = $request->project_name;
            $work->project_description = $request->project_description;
            $work->category_id = $request->category_id;
            $work->project_link = $request->project_link;
            $work->project_video_link = $request->project_video_link;
            $work->save();
            if($request->skill_id){
                $work->relationskill()->sync($request->skill_id,false);
            }
            $product_insert_id = $work->id;
            if($product_insert_id != NULL){
                if($request->hasfile('project_image')){
                    $photo_to_upload = $request->project_image;
                    $filename = $product_insert_id.".".$photo_to_upload->getClientOriginalExtension();
                    Image::make($photo_to_upload)->resize(750,490)->save(base_path('public/uploads/ProjectImage/preview/'.$filename));
                    Work::find($product_insert_id)->update([
                        'project_image' => $filename,
                    ]);
                }
                if ($request->hasFile('slider_image')) {
                    if ($files = $request->file('slider_image')) {
                        $flag=0;
                         foreach($files as $img) {
                            $new_photo_name = $product_insert_id."-".$flag.".".$img->getClientOriginalExtension();
                            $destinationPath ='public/uploads/ProjectImage/slider/'.$new_photo_name;
                            Image::make($img)->resize(750,490)->save(base_path($destinationPath));
                            $flag++;
                            $data[] = $new_photo_name;
                        }
                            $imagemodel= new Work();
                            $slider_insert_id  = $product_insert_id;
                            $imagemodel->find($slider_insert_id)->update([
                            'slider_image' => json_encode($data)
                        ]);
                    }
                }
            }
        }
        toast('Project have been created succesfully ','success');
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categoreies = Category::all();
        $skills = Skill::all();
        $projects_info = Work::findOrFail($id);
        $multiple_photos = json_decode($projects_info->slider_image, true);
        return view('backend.page.work.edit',compact('projects_info','categoreies','skills','multiple_photos'));
    }

    public function editproductsingle(Request $request,$single_photo,$single_id)
    {
        if(empty($request->slider_image )){
            toast('Please select Image','warning');
            return back();
        }
        if($single_photo){
            $imag = $single_photo;
            if( $imag == "defaultsliderphoto.jpg"){
                $extension = "";
                foreach($request->slider_image as $photos) {
                    $extension= $photos->getClientOriginalExtension();
                    $file_name_new=$single_id."-"."0".".".$extension ;
                    $photo_to_upload=$photos;
                Image::make($photo_to_upload)->resize(750,490)->save(base_path('public/uploads/ProjectImage/slider/'.$file_name_new));
                }
                $single_product_info = Work::findOrFail($single_id);
                $multiple_photos = json_decode($single_product_info->slider_image, true);
                $photos_new_db[]="";
                $i=0;
                foreach($multiple_photos as $photos) {
                if($photos===$single_photo){
                    $photos_new_db[$i]=$file_name_new;
                    $i++;
                }
                else{
                    $photos_new_db[$i]=$photos;
                    $i++;
                }
                }
                $imagemodel= new Work();
                $imagemodel->where('id', $single_id)->update([
                'slider_image' => json_encode($photos_new_db)
                ]);
            }

            else{
                unlink(base_path('public/uploads/ProjectImage/slider/'.$single_photo));
                $file_name = pathinfo($single_photo, PATHINFO_FILENAME);
                $extension = "";
                foreach($request->slider_image as $photos) {
                    $extension= $photos->getClientOriginalExtension();
                    $file_name_new=$file_name.".".$extension ;
                    $photo_to_upload=$photos;
                Image::make($photo_to_upload)->resize(750,490)->save(base_path('public/uploads/ProjectImage/slider/'.$file_name_new));
                }

                $single_product_info = Work::findOrFail($single_id);
                $multiple_photos = json_decode($single_product_info->slider_image, true);
                $photos_new_db[]="";
                $i=0;
                foreach($multiple_photos as $photos) {
                if($photos===$single_photo){
                    $photos_new_db[$i]=$file_name_new;
                    $i++;
                }
                else{
                    $photos_new_db[$i]=$photos;
                    $i++;
                }
                }
                $imagemodel= new Work();
                $imagemodel->where('id', $single_id)->update([
                'slider_image' => json_encode($photos_new_db)
                ]);
            }

        }
        toast('Product preview image has been updated','success');
        return back();
    }
    public function deleteproductsingle($single_photo,$single_id)
    {
        $single_product_info = Work::findOrFail($single_id);
        $multiple_photos = json_decode($single_product_info->slider_image, true);
        $photos_match[]="";
        $photos_new_db[]="";
        $i=0;
        $j=0;
        foreach($multiple_photos as $photos) {
            if($photos===$single_photo){
            $photos_match[$i]=$photos;
            $i++;
            }
            else{
            $photos_new_db[$j]=$photos;
            $j++;
            }
        }
        foreach($photos_match as $photos) {
            if($photos == 'defaultsliderphoto.jpg'){
                toast('Sorry,You have no image for deleting ','warning');
                return back();
            }
            else{
                unlink(base_path('public/uploads/ProjectImage/slider/'.$photos));
            }
        }
        $imagemodel= new Work();
        if (in_array(null, $photos_new_db, true) || in_array('', $photos_new_db, true)) {

            $imagemodel->where('id', $single_id)->update([
            'slider_image' => '["defaultsliderphoto.jpg"]'
            ]);
        }
        else{
            $imagemodel->where('id', $single_id)->update([
            'slider_image' => json_encode($photos_new_db)
            ]);
        }
        toast('Image has been deleted ','warning');
        return back();
    }

    public function update(Request $request)
    {
        if($request->hasFile('project_image')){
            if (Work::find($request->id)->project_image == 'defaultprojectphoto.jpg') {
              $photo_to_upload = $request->project_image;
              $filename = $request->id.".".$photo_to_upload->getClientOriginalExtension();
              Image::make($photo_to_upload)->resize(750,490)->save(base_path('public/uploads/ProjectImage/preview/'.$filename));
              Work::find($request->id)->update([
                'project_image' => $filename,
              ]);
            }
            else {
              $delete_this_file = Work::find($request->id)->project_image;
              unlink(base_path('public/uploads/ProjectImage/preview/'.$delete_this_file));
              $photo_to_upload = $request->project_image;
              $filename = $request->id.".".$photo_to_upload->getClientOriginalExtension();
              Image::make($photo_to_upload)->resize(750,490)->save(base_path('public/uploads/ProjectImage/preview/'.$filename));
              Work::find($request->id)->update([
                'project_image' => $filename,
              ]);
            }
        }
        Work::find($request->id)->update([
            'project_name' => $request->project_name,
            'category_id' => $request->category_id,
            'project_link' => $request->project_link,
            'project_video_link' => $request->project_video_link,
            'client_link' => $request->client_link,
            'project_description' => $request->project_description,
        ]);
        if($request->has('skill_id')){
            $work = Work::find($request->id);
            $work->relationskill()->sync((array)$request->input('skill_id'));
        }
        $single_product_info = Work::findOrFail($request->id);
        $multiple_photos = json_decode($single_product_info->slider_image, true);

        if ($multiple_photos=== null || $multiple_photos=== '') {
            if ($files = $request->file('photo_name_new')) {
                $flag=0;
                foreach($files as $img) {
                    $profileImage =$request->id."-".$flag.".".$img->extension();
                    Image::make($img)->resize(750,490)->save(base_path('public/uploads/ProjectImage/slider/'.$profileImage));
                    $data[] = $profileImage;
                    $flag++;
                    }
                $imagemodel= new Work();
                $imagemodel->where('id', $request->id)->update([
                'slider_image' => json_encode($data)
                ]);
            }
        }
        else{
            $last_photo =end($multiple_photos);
            $file_name = pathinfo($last_photo, PATHINFO_FILENAME);
            $numbers = explode('-', $file_name);
            $lastNumber = end($numbers);
            if ($files = $request->file('photo_name_new')) {
               if($last_photo == 'defaultsliderphoto.jpg'){
                    $i=1;
                    foreach($files as $img) {
                            $profileImage =$request->id."-".$i.".".$img->extension();
                            Image::make($img)->resize(750,490)->save(base_path('public/uploads/ProjectImage/slider/'.$profileImage));
                            $data[] = $profileImage;
                            $i++;
                        }
                        $imagemodel= new Work();
                        $imagemodel->where('id', $request->id)->update([
                        'slider_image' => json_encode($data)
                    ]);
               }
               else{
                    $flag=$lastNumber + 1;
                    foreach($files as $img) {
                        $profileImage =$request->id."-".$flag.".".$img->extension();
                        Image::make($img)->resize(750,490)->save(base_path('public/uploads/ProjectImage/slider/'.$profileImage));
                        $data[] = $profileImage;
                        $flag++;
                    }
                    $all_images = array_merge($multiple_photos,$data);
                        $imagemodel= new Work();
                        $imagemodel->where('id', $request->id)->update([
                        'slider_image' => json_encode($all_images)
                    ]);
                }
            }
        }
        toast('Project has been Updated ','info');
        return back();
    }

    public function changestatus($id)
    {
        if (Work::find($id)->project_status) {
            Work::findOrFail($id)->update([
                'project_status' => 0,
          ]);
          toast('project has been unpublished ','warning');
        }
        else {
            Work::findOrFail($id)->update([
                'project_status' => 1,
          ]);
          toast('project has been published ','success');
        }
        return back();

    }

    public function destroy($id)
    {
        $single_product_info = Work::findOrFail($id);
        $multiple_photos = json_decode($single_product_info->slider_image, true);
        if(!empty($multiple_photos)){
            foreach($multiple_photos as $photos) {
                if($photos !=='defaultsliderphoto.jpg'){
                    unlink(base_path('public/uploads/ProjectImage/slider/'.$photos));
                }
            }
        }
        if ($delete_this_file = Work::findOrFail($id)->project_image == 'defaultprojectphoto.jpg') {
            $single_product_info->delete();
        }
        else {
            $delete_this_file = Work::findOrFail($id)->project_image;
            unlink(base_path('public/uploads/ProjectImage/preview/'.$delete_this_file));
            $single_product_info->delete();
        }
        toast('Product has been deleted ','warning');
        return back();

    }
}
