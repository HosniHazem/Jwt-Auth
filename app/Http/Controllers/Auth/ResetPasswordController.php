<?php

namespace App\Http\Controllers\API;


use Validator;
use App\Models\User;
use Carbon\carbon;
use Illuminate\Http\Request;
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
class resetPasswordController extends Controller
{
    
   public function forgetpassword( Request $request ){

    $email= $request->input('email');
    $token= Str::random(12);
    $salarie= User::where('email','=', $email)->get(); 
    if($salarie->isEmpty()){
        return  [
            'erreur' => ' Email non trouvé '
        ]; 
     }else{

    DB::table('password_resets')->insert([
        'email'=> $email,
        'token'=> $token,
        'created_at'=>Carbon::now()

    ]);
    $user= User::where('email','=', $email)->first(); 
    
     Mail::send('email.reset_password',['token'=>$token,'user'=>$user],function(message $message) use ($email){
        $message->subject('rest your password');
        $message->to($email);
    } );

    return  [
        'message' => 'vérifier votre e-mail '
    ];
   }
    }

 public function resetPassword(Request $request){

    $validatedData = $request->validate([
       
        'password' => ['confirmed'],
       
    ]);
   
 $passwordResets = DB::table('password_resets')->where ('token',$request->input('token'))->first();
 //$email=$passwordResets->email;
 //$password = Str::random(8);
 $model = 'User'; //Use the name of the model, not the table name
$interface_model = '\App\Models\\' . $model; 
 $user=$interface_model::where('email','=', $passwordResets->email)->first(); 
 
 if(!$user){
    return reponse([
        'error'=>'not found'
    ],400);  
 }
 /*
 $user->password=Hash::make($request->input('password'));*/
 $password = Str::random(8);
 $user->password = $password ;
 $user->save();
 //$user->tokens()->delete();
 //Mail::to($user)->send(new userEmail($user, $validatedData['password']));

// Mail::to($user)->send(new userEmail($user, $validatedData['password']));
$email=$user->email;
 Mail::send('email.email_password',['password'=>$password,'user'=>$user],function(message $message) use ($email){
   $message->subject('rest your password');
   $message->to($email);
} );

     //  $user->update();
 return[
'message'=>'succes',
'data'=>$passwordResets ,
'user'=> $user,

 ];
}
}
