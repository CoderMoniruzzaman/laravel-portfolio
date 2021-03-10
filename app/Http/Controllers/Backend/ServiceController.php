<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if( $request->ajax() )
        {

            $data = Service::latest()->get();

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
                $button = '<button data-toggle="modal" id="'.$data->id.'" value="'.$data->id.'" class="open-editservicemodal btn btn-light btn-sm">Edit</button>';

                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$data->id.'" id="'.$data->id.'" class="service_delete btn btn-light btn-sm">Delete</button>';
                return $button;
            })
            ->rawColumns(['status','created_at','action'])->make(true);
        }
        return view('backend.page.service.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $rules = array(
            'service_name' => 'required|unique:services,service_name',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = new Service;
            $form_data->service_name = $request->service_name;
            $form_data->icon = $request->icon;
            $form_data->service_description = $request->service_description;
            $form_data->save();
            return response()->json(['success'=>'Service added successfully.']);
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
            $data = Service::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
    public function serviceupdate(Request $request)
    {
        $rules = array(
            'service_name' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = array(
                'service_name' =>  $request->service_name,
                'icon'=>  $request->icon,
                'service_description'=>  $request->service_description,
            );
            Service::whereId($request->id)->update($form_data);
            return response()->json(['success' => 'Service is successfully updated']);
        }
        return response()->json(['success' => 'Service is successfully updated']);
    }
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
    public function servicedelete($so_id)
    {
        $servce = Service::findOrFail($so_id);
        if ($servce){
            $servce->delete();
            return response()->json(array('success' => true));
        }
    }
    public function servicestatus($sa_id)
    {
        if(Service::find($sa_id)->status == 1){
            Service::findOrFail($sa_id)->update([
                'status' => 0,
            ]);
            return response()->json(['info'=>'Status deactive successfully.']);
        }
        else {
            Service::findOrFail($sa_id)->update([
                'status' => 1,
            ]);
            return response()->json(['success'=>'Status active successfully.']);
        }

    }


}
