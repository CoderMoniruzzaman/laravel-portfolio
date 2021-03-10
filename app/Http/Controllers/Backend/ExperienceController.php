<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use App\Models\Experience;

class ExperienceController extends Controller
{

    public function index(Request $request)
    {
        if( $request->ajax() )
        {
            $data = Experience::latest()->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status',function($data){
                if($data->status == 1){

                    $status = '<button name="status" data-id="'.$data->id.'" class="change_status btn btn-success btn-sm">Active</button>';
                }
                else{
                    $status = '<button name="status" data-id="'.$data->id.'" class="change_status btn btn-danger btn-sm">Deactive</button>';
                }
                return $status;
            })
            ->addColumn('created_at',function($data){
                $time = $data->created_at->format('d-M-Y h:i:s A').'<br>';
                $time .=$data->created_at->diffForHumans();
                return $time;
            })
            ->addColumn('action',function($data){
                $button = '<button data-toggle="modal" id="'.$data->id.'" value="'.$data->id.'" class="open-editexperiencemodal btn btn-light btn-sm">Edit</button>';

                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$data->id.'" id="'.$data->id.'" class="experience_delete btn btn-light btn-sm">Delete</button>';
                return $button;
            })
            ->rawColumns(['status','created_at','action'])->make(true);
        }
        return view('backend.page.experience.index');
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
        $rules = array(
            'company_name' => 'required',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = new Experience;
            $form_data->company_name = $request->company_name;
            $form_data->position = $request->position;
            $form_data->job_year = $request->job_year;
            $form_data->job_description = $request->job_description;
            $form_data->save();
            return response()->json(['success'=>'Experience added successfully.']);
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Experience::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function experienceupdate(Request $request)
    {
        $rules = array(
            'company_name' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = array(
                'company_name' =>  $request->company_name,
                'position'=>  $request->position,
                'job_year'=>  $request->job_year,
                'job_description'=>  $request->job_description,
            );
            Experience::whereId($request->id)->update($form_data);
            return response()->json(['success' => 'Experience is successfully updated']);
        }
        return response()->json(['success' => 'Experience is successfully updated']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function experiencedelete($exp_id)
    {
        $servce = Experience::findOrFail($exp_id);
        if ($servce){
            $servce->delete();
            return response()->json(array('success' => true));
        }
    }

    public function destroy($id)
    {
        //
    }

    public function experiencestatus($exp_id)
    {
        if(Experience::find($exp_id)->status == 1){
            Experience::findOrFail($exp_id)->update([
                'status' => 0,
            ]);
            return response()->json(['info'=>'Status deactive successfully.']);
        }
        else {
            Experience::findOrFail($exp_id)->update([
                'status' => 1,
            ]);
            return response()->json(['success'=>'Status active successfully.']);
        }

    }



}
