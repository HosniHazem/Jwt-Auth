<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use App\Mail\userEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class UserController extends Controller
{

    public function show($id)
    {

        $item =User::find($id);
        if($item){

        return response()->json(['User'=>$item,'status'=>200], 200);
        }
    else
    {
    return response()->json(['message'=>'not found','status'=>404], 404);
    }
    }
    public function uploadimage(Request $request)
    {



            $file      = $request->file('attach');
            $filename  = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture   = $filename;
            //move image to public/img folder
            $file->move(public_path('images/uploads'), $picture);
            return response()->json(["message" => "Image Uploaded Succesfully",'status' => 200]);

    }
    public function index()
    {

        $item =User::all();

        return response()->json(['User'=>$item,'status'=>200], 200);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone_no' => 'required',
            'organization' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->getMessageBag(),
            ]);
        } else {
        $user =new User();
       $user->RoleID=$req->RoleID;
       $user->name=$req->name;
       $user->email=$req->email;
       $user->city=$req->city;
       $user->phone_no=$req->phone_no;
       $user->country=$req->country;
       $user->organization=$req->organization;
       $user->profile_picture=$req->profile_picture;
       $user->Is_Active=$req->Is_Active;
       $user->sold_total=$req->sold_total;
       $user->sold=$req->sold_total;

       $user->password=Hash::make($req->input('password'));
       $password = Str::random(8);

       $user->password = $password ;
      $email=$user->email;
       Mail::send('email.email_password',['password'=>$password,'user'=>$user],function(message $message) use ($email){
         $message->subject('This is your Login info');
         $message->to($email);
      } );


        $user->save();
        return response()->json(['message'=>'done','status' => 200]);
    }
}
    public function update(Request $req,$id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone_no' => 'required',
            'organization' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->getMessageBag(),
            ]);
        } else {
        $item =User::find($id);


        if($item){
            $item->RoleID=$req->RoleID;
            $item->name=$req->name;
            $item->phone_no=$req->phone_no;
            $item->city=$req->city;
            $item->country=$req->country;
            $item->organization=$req->organization;
            $item->profile_picture=$req->profile_picture;
            $item->Is_Active=$req->Is_Active;
            $item->sold_total=$req->sold_total;
            $item->sold=$req->sold;
            $item->sold_consumed=$req->sold_consumed;
            $item->update();
        return response()->json(['message'=>'done','status' => 200]);
                }
                else
                {
                return response()->json(['message'=>'not done','status' => 404]);
                }
            }
    }
    public function destroy($id)
    {

        $item =User::find($id);
        if($item){
        $item->delete();
        return response()->json(['message'=>'deleted'], 200);
                }
                else
                {
                return response()->json(['message'=>'not deleted'], 404);
                }
    }
}

