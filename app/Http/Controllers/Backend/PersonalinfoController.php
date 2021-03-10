<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Personalinfo;
use Intervention\Image\Facades\Image;

class PersonalinfoController extends Controller
{
    public function personalview(){
        $infos = Personalinfo::all();
        return view('backend.page.personal.index',compact('infos'));
    }
    public function personaledit($id){
        $info = Personalinfo::findOrFail($id);
        return view('backend.page.personal.edit',compact('info'));
    }

    public function personalupdate(Request $request){
        if($request->hasFile('cv')){
            if(Personalinfo::find($request->id)->cv == 'defaultcv.pdf'){
                $pdf_upload = $request->cv;
                $pdf_name = $request->name;
                $filename = $pdf_name.".".$pdf_upload->getClientOriginalExtension();
                $upload = $request->cv->move(base_path('public/uploads/mysite/cv/'), $filename);
                if($upload){
                    Personalinfo::find($request->id)->update([
                    'cv' => $filename,
                    ]);
                }
            }
            else{
                $delete_this_file = Personalinfo::find($request->id)->cv;
                unlink(base_path('public/uploads/mysite/cv/') . $delete_this_file);

                $pdf_upload = $request->cv;
                $filename = $request->name.".".$pdf_upload->getClientOriginalExtension();
                $upload = $request->cv->move(base_path('public/uploads/mysite/cv/'), $filename);
                if($upload){
                    Personalinfo::find($request->id)->update([
                    'cv' => $filename,
                    ]);
                }
            }
        }
        if($request->hasFile('image')){
            if (Personalinfo::find($request->id)->image == 'defaultphoto.jpg') {
              $photo_to_upload = $request->image;
              $filename = $request->id.".".$photo_to_upload->getClientOriginalExtension();
              Image::make($photo_to_upload)->resize(1920,1080)->save(base_path('public/uploads/mysite/personal/'.$filename));
              Personalinfo::find($request->id)->update([
                'image' => $filename,
              ]);
            }
            else {
              $delete_this_file = Personalinfo::find($request->id)->image;
              unlink(base_path('public/uploads/mysite/personal/'.$delete_this_file));
              $photo_to_upload = $request->image;
              $filename = $request->id.".".$photo_to_upload->getClientOriginalExtension();
              Image::make($photo_to_upload)->resize(1920,1080)->save(base_path('public/uploads/mysite/personal/'.$filename));
              Personalinfo::find($request->id)->update([
                'image' => $filename,
              ]);
            }
        }
        Personalinfo::find($request->id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
        ]);
        return back();

    }

    public function downloadcv($id)
    {
        $files = Personalinfo::findOrFail($id)->get()->where('status', 1);
        foreach ($files as $file) {
          $filename = $file->cv;
        }
        $myFile = base_path('public/uploads/mysite/cv/').$filename;
        return response()->download($myFile);
    }

}
