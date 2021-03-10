<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Research;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Redirect,Response;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researchsites = Research::orderBy('created_at', 'DESC')->get();
        return view('backend.page.research.index',compact('researchsites'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Research::insert($request->except('_token') + [
            'created_at' => Carbon::now()
        ]);
        toast('Research have been created succesfully ','success');
        return redirect('admin/researchsite');
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
        Research::find($request->re_id)->update([
            'research_title' => $request->research_title,
            'research_description' => $request->research_description,
            'research_publication_link' => $request->research_publication_link,
            'research_project_url' => $request->research_project_url,
        ]);
        toast('Research have been updated','info');
        return redirect('admin/researchsite');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $research = Research::findOrFail($id);
        if ($research){
            $research->delete();
            toast('Research have been deleted','warning');
            return redirect('admin/researchsite');
        }
    }
    public function status($id)
    {
        if (Research::find($id)->status) {
            Research::findOrFail($id)->update([
                'status' => 0,
            ]);
            toast('Research Deactivated ','warning');
        }
        else {
            Research::findOrFail($id)->update([
                'status' => 1,
            ]);
            toast('Research Activated ','success');
        }
        return redirect('admin/researchsite');
    }
}
