<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use App\Models\Education;


class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->ajax() )
        {
            $data = Education::latest()->get();
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
                $button = '<button data-toggle="modal" id="'.$data->id.'" value="'.$data->id.'" class="open-editeducationmodal btn btn-light btn-sm">Edit</button>';

                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$data->id.'" id="'.$data->id.'" class="education_delete btn btn-light btn-sm">Delete</button>';
                return $button;
            })
            ->rawColumns(['status','created_at','action'])->make(true);
        }
        return view('backend.page.education.index');
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
            'institute_name' => 'required',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = new Education;
            $form_data->institute_name = $request->institute_name;
            $form_data->institute_degree = $request->institute_degree;
            $form_data->degree_year = $request->degree_year;
            $form_data->education_description = $request->education_description;
            $form_data->save();
            return response()->json(['success'=>'education added successfully.']);
        }
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

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Education::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function educationupdate(Request $request)
    {
        $rules = array(
            'institute_name' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = array(
                'institute_name' =>  $request->institute_name,
                'institute_degree'=>  $request->institute_degree,
                'degree_year'=>  $request->degree_year,
                'education_description'=>  $request->education_description,
            );
            Education::whereId($request->id)->update($form_data);
            return response()->json(['success' => 'Education is successfully updated']);
        }
        return response()->json(['success' => 'Education is successfully updated']);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function educationdelete($edu_id)
    {
        $servce = Education::findOrFail($edu_id);
        if ($servce){
            $servce->delete();
            return response()->json(array('success' => true));
        }
    }
    public function educationstatus($edu_id)
    {
        if(Education::find($edu_id)->status == 1){
            Education::findOrFail($edu_id)->update([
                'status' => 0,
            ]);
            return response()->json(['info'=>'Status deactive successfully.']);
        }
        else {
            Education::findOrFail($edu_id)->update([
                'status' => 1,
            ]);
            return response()->json(['success'=>'Status active successfully.']);
        }

    }
}
