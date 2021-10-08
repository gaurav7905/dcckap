<?php

namespace App\Http\Controllers;

use App\Models\information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use DataTables;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userlogin(Request $req)
    {
        $rules = array(
                    'email' => 'required|max:255|email|regex:/^[a-zA-Z0-9#]+@[a-zA-Z]+.[a-zA-Z]+$/',
                    'password' => 'required|min:8|regex:/^[a-zA-Z0-9#@]+$/',
                );
            $validated = Validator::make($req->all(),$rules);
            if(!$validated->fails())
             {
               $email = $req->email;
               $password = $req->password;

                if(Auth::attempt(['email' => $email , 'password' => $password,'role'=>'user' ])){
                    $res = Auth::user();

                    $token = $res->createToken('api_token')->accessToken;
                
                   return response()->json(['status_code'=>200,'token'=>$token->token,'email'=>$email,'id'=>$res->id]);
                }
                else
                {
                    return response()->json(['status_code'=>201,'msg'=>'Email and password did not matched']);
                }
             }else{

                return response()->json(['status_code'=>202,'msg'=>$validated->errors()->all()]);  
             }

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


    public function store(Request $request){

        if(empty($request->id)){
            $rules = array(
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
                $profileImage = date('YmdHis') . "." .$image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $image = $profileImage;
            }
      
            $res = new User();
            $res->name = $request->name;
            $res->username = $request->username;
            $res->email = $request->email;
            $res->password =  bcrypt($request->password);
            $res->mobile = $request->mobile;
            $res->image = $image;
            $res->dob = $request->dob;
            $res->address = $request->address;
            $res->city = $request->city;
            $res->state = $request->state;
            $res->country = $request->country;
            $res->role = 'user';
            $response = $res->save();

            if($response){
                return response()->json(['status_code'=>200,'msg'=>'Data Added Successfully !']);
            }else{
                return response()->json(['status_code'=>201,'msg'=>'Server Error !']);
            }
         
          }

        return response()->json(['status_code'=>202,'msg'=>$validated->errors()->all()]);
      }else{
            $rules = array(
                    'name' => 'required',
                    'username' => 'required',
                    'mobile'=>'required|min:10|numeric',
                    'dob'=>'required',
                    'address'=>'required',
                    'city'=>'required',
                    'state'=>'required',
                    'country'=>'required'
                    
                );
            $validated = Validator::make($request->all(),$rules);
            if(!$validated->fails())
             {
            $formdata = array();
            if($image = $request->file('image')) {
                $destinationPath = 'image/';
                $profileImage = date('YmdHis') . "." .$image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $formdata['image'] = $profileImage;
            }
            if(!empty($request->password) && !empty($request->confirm_password)){
                if($request->password != $request->confirm_password){
                    return response()->json(['status_code'=>203,'msg'=>'Password and Confirm password did not matched !']);
                }
                $formdata['password'] =  bcrypt($request->password);
            }

            $formdata['name'] = $request->name;
            $formdata['mobile'] = $request->mobile;
            $formdata['city'] = $request->city;
            $formdata['country'] = $request->country;
            $formdata['state'] = $request->state;
            $formdata['address'] = $request->address;
            $formdata['dob'] = $request->dob;
            $formdata['username'] = $request->username;
            $response = User::where('id',$request->id)->update($formdata);
            if($response){
                return response()->json(['status_code'=>200,'msg'=>'Data Updated Successfully !']);
            }else{
                return response()->json(['status_code'=>201,'msg'=>'Server Error !']);
            }
         
          }

            return response()->json(['status_code'=>202,'msg'=>$validated->errors()->all()]);
      }
        
       
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
            $data = User::select('*')->where(['role'=>'user']);
         
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
       $data = User::where('id' , $request->user_id)->get([DB::raw(
                "DATE_FORMAT(dob, '%m/%d/%Y') as dofb"),
                'name','email','username','city','country','state','image','mobile','id','address'
                ]);
        return response()->json(['status_code'=>200,'data'=>@$data[0]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\information  $information
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request, $id)
    {
       $data = User::where('id' , $id)->get();
      
       return view('show',['data'=>$data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\information  $information
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = User::find($request->user_id);
        if($id)
        {
        User::where('id',$request->user_id)->update(['status' => 0]);
          return response()->json(['status_code'=>200,'msg'=>"Record deleted Successfully"]);
        }
        else{
            return response()->json(['status_code'=>202,'msg'=>"Data not found"]);
        }   
    }
    public function getdata(Request $request)
    {
        $data = User::where('id',$request->id)->get();
        return view('/userdashboard',['data'=>$data]);
    }
}
