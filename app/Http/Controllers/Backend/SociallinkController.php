<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Socilalink;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class SociallinkController extends Controller
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

            $data = Socilalink::latest()->get();

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
                $button = '<button data-toggle="modal" id="'.$data->id.'" value="'.$data->id.'" class="open-editsocialmodal btn btn-light btn-sm">Edit</button>';

                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$data->id.'" id="'.$data->id.'" class="social_delete btn btn-light btn-sm">Delete</button>';
                return $button;
            })
            ->rawColumns(['status','created_at','action'])->make(true);
        }

        return view('backend.page.social.index');
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
            'socail_name' => 'required|unique:socilalinks,socail_name',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = new Socilalink;
            $form_data->socail_name = $request->socail_name;
            $form_data->link = $request->link;
            $form_data->icon = $request->icon;
            $form_data->save();
            return response()->json(['success'=>'Social link added successfully.']);
        }
    }

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
        if(request()->ajax())
        {
            $data = Socilalink::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function socialupdate(Request $request)
    {
        $rules = array(
            'socail_name' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = array(
                'socail_name' =>  $request->socail_name,
                'link' =>  $request->link,
                'icon'=>  $request->icon,
            );
            Socilalink::whereId($request->id)->update($form_data);
            return response()->json(['success' => 'Social is successfully updated']);
        }
        return response()->json(['success' => 'Social is successfully updated']);
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

    public function socaildelete($so_id)
    {
        $category = Socilalink::findOrFail($so_id);
        if ($category){
            $category->delete();
            return response()->json(array('success' => true));
        }
    }

    public function socailstatus($so_id)
    {
        if(Socilalink::find($so_id)->status == 1){
            Socilalink::findOrFail($so_id)->update([
                'status' => 0,
            ]);
            return response()->json(['info'=>'Status deactive successfully.']);
        }
        else {
            Socilalink::findOrFail($so_id)->update([
                'status' => 1,
            ]);
            return response()->json(['success'=>'Status active successfully.']);
        }

    }






}
