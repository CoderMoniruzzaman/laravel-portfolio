<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Freelance;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Redirect,Response;

class FreelanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freelancessites = Freelance::orderBy('created_at', 'DESC')->get();
        return view('backend.page.freelance.index',compact('freelancessites'));
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
            'feelancesite_name' => 'required|unique:freelances,feelancesite_name',
        ]);
        if($validator){
            $last_inserted_id = Freelance::insertGetId([
                'feelancesite_name' => $request->feelancesite_name,
                'feelancesite_description' => $request->feelancesite_description,
                'freelance_url' => $request->freelance_url,
                'created_at' => Carbon::now()
            ]);
            if($request->hasFile('feelancesite_image',)){
                $photo_to_upload = $request->feelancesite_image;
                $filename = $last_inserted_id.".".$photo_to_upload->getClientOriginalExtension();
                Image::make($photo_to_upload)->resize(140,125)->save(base_path('public/uploads/freelancesiteIcon/'.$filename));
                Freelance::find($last_inserted_id)->update([
                'feelancesite_image' => $filename,
                ]);
            }
            toast('feelance site have been created succesfully ','success');
        }
        return redirect('admin/freelanceesite');
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
        if($request->hasFile('feelancesite_image')){
            if (Freelance::find($request->fee_id)->feelancesite_image == 'feelancesite_image.jpg') {
                $photo_to_upload = $request->feelancesite_image;
                $filename = $request->fee_id.".".$photo_to_upload->getClientOriginalExtension();
                Image::make($photo_to_upload)->resize(140,125)->save(base_path('public/uploads/freelancesiteIcon/'.$filename));
                Freelance::find($request->fee_id)->update([
                'feelancesite_image' => $filename,
                ]);
            }
            else {
                $delete_this_file = Freelance::find($request->fee_id)->feelancesite_image;
                unlink(base_path('public/uploads/freelancesiteIcon/'.$delete_this_file));
                $photo_to_upload = $request->feelancesite_image;
                $filename = $request->fee_id.".".$photo_to_upload->getClientOriginalExtension();
                Image::make($photo_to_upload)->resize(140,125)->save(base_path('public/uploads/freelancesiteIcon/'.$filename));
                Freelance::find($request->fee_id)->update([
                'feelancesite_image' => $filename,
                ]);
            }
        }
        Freelance::find($request->fee_id)->update([
        'feelancesite_name' => $request->feelancesite_name,
        'feelancesite_description' => $request->feelancesite_description,
        'freelance_url' => $request->freelance_url,
        ]);
        toast('Feelance site have been updated','info');
        return redirect('admin/freelanceesite');
    }

    public function destroy($id)
    {
        $category = Freelance::findOrFail($id);
        if ($category){
            $delete_this = Freelance::findOrFail($id)->feelancesite_image;
            unlink(base_path('public/uploads/freelancesiteIcon/'.$delete_this));
            $category->delete();
            toast('Feelance site have been deleted','warning');
            return redirect('admin/freelanceesite');
        }
    }

    public function status($id)
    {
        if ($category = Freelance::find($id)->status) {
            Freelance::findOrFail($id)->update([
                'status' => 0,
          ]);
          toast('Freelance site Deactivated ','warning');
        }
        else {
            Freelance::findOrFail($id)->update([
                'status' => 1,
          ]);
          toast('Freelance site Activated ','success');
        }
        return redirect('admin/freelanceesite');
    }
}
