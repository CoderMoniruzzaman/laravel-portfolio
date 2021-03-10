<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use DataTables;
use App\Models\SkillKnowledge;

class SkillKnowledgeController extends Controller
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
            $data = SkillKnowledge::latest()->get();
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
                $button = '<button data-toggle="modal" id="'.$data->id.'" value="'.$data->id.'" class="open-editskilknowmodal btn btn-light btn-sm">Edit</button>';

                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" data-id="'.$data->id.'" id="'.$data->id.'" class="skilknow_delete btn btn-light btn-sm">Delete</button>';
                return $button;
            })
            ->rawColumns(['status','created_at','action'])->make(true);
        }
        return view('backend.page.skillknowledge.index');
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
            'knowledgeskill_name' => 'required',
            'percentage' => 'required',
            'skill_color' => 'required',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = new SkillKnowledge;
            $form_data->knowledgeskill_name = $request->knowledgeskill_name;
            $form_data->percentage = $request->percentage;
            $form_data->skill_color = $request->skill_color;
            $form_data->save();
            return response()->json(['success'=>'Skill added successfully.']);
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
            $data = SkillKnowledge::findOrFail($id);
            return response()->json(['result' => $data]);
        }
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

    public function skillknowledgeupdate(Request $request)
    {
        $rules = array(
            'knowledgeskill_name' => 'required',
            'percentage' => 'required',
            'skill_color' => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        else {
            $form_data = array(
                'knowledgeskill_name' =>  $request->knowledgeskill_name,
                'percentage'=>  $request->percentage,
                'skill_color'=>  $request->skill_color,
            );
            SkillKnowledge::whereId($request->id)->update($form_data);
            return response()->json(['success' => 'Skill is successfully updated']);
        }
        return response()->json(['success' => 'Skill is successfully updated']);
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

    public function skillknowledgedelete($sk_id)
    {
        $skill = SkillKnowledge::findOrFail($sk_id);
        if ($skill){
            $skill->delete();
            return response()->json(array('success' => true));
        }
    }

    public function skillknowledgestatus($sk_id)
    {
        if(SkillKnowledge::find($sk_id)->status == 1){
            SkillKnowledge::findOrFail($sk_id)->update([
                'status' => 0,
            ]);
            return response()->json(['info'=>'Status deactive successfully.']);
        }
        else {
            SkillKnowledge::findOrFail($sk_id)->update([
                'status' => 1,
            ]);
            return response()->json(['success'=>'Status active successfully.']);
        }

    }


}
