<?php

namespace App\Http\Controllers;

use App\Models\information;
use Illuminate\Http\Request;
use Validator;
use DataTables;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('form');
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
       $rules= array(
                    'name' => 'required',
                    'username' => 'required',
                    'email' => 'required|unique:information|max:255|email|regex:/^[a-zA-Z0-9#]+@[a-zA-Z]+.[a-zA-Z]+$/',
                    'password' => 'required|min:8|regex:/^[a-zA-Z0-9#@]+$/',
                    'confirm_password' => 'required_with:password|same:password|min:8|regex:/^[a-zA-Z0-9#@]+$/',
                    'mobile'=>'required|min:10|numeric',
                   'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                   'dob'=>'required',
                   'address'=>'required',
                   'city'=>'required',
                   'state'=>'required',
                   'country'=>'required'
                    
                );
         $validated = Validator::make($request->all(),$rules);
     if(!$validated->fails())
         {
        
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $image = "$profileImage";
        }
      
            $res = new information();
            $res->name=$request->name;
            $res->username=$request->username;
            $res->email=$request->email;
            $res->password=$request->password;
            $res->mobile=$request->mobile;
            $res->image=$image;
            $res->dob=$request->dob;
            $res->address=$request->address;
            $res->city=$request->city;
            $res->state=$request->state;
            $res->country=$request->country;

            
            $test=$res->save();

            if($test){
                return response()->json(['status_code'=>200,'msg'=>'Data Added Successfully !']);
            }else{
                return response()->json(['status_code'=>201,'msg'=>'Server Error !']);
            }
         
          }
        
         return response()->json(['status_code'=>202,'msg'=>$validated->errors()->all()]);


       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\information  $information
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->ajax())
        {
      $data = information::select('*')->where('status',1);
      
        return DataTables::eloquent($data)
            ->filterColumn('name', function($query, $keyword) {
                $sql = "name  like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->toJson();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\information  $information
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       $data=information::find($request->user_id);

        return response()->json(['status_code'=>200,'data'=>$data]);
       

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\information  $information
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, information $information)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\information  $information
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = information::find($request->user_id);
        if($id)
        {
        information::where('id',$request->user_id)->update(['status' => 0]);
          return response()->json(['status_code'=>200,'msg'=>"Record deleted Successfully"]);
    }
    else{
        return response()->json(['status_code'=>202,'msg'=>"Data not found"]);
    }
    }
}
