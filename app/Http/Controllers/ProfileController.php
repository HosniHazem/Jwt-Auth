<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::where('id', Auth::user()->id)->get();
        if ($user) {

            //  return Conge::find($id)->where('salarie_id', Auth::user()->id)->get();
            return response()->json([
                'status' => 200,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Aucune congé Id trouvé',
            ]);
        }
    }


    public function update_profile(Request $request)
    {

        $validate_err = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'phone' => 'required|max:30',


        ]);
        if ($validate_err->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validate_err->getMessageBag(),
            ]);
        }

        $user = $request->user();



        if ($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $filename = time() . '.' . $profile_picture->getClientOriginalExtension();
            Image::make($profile_picture)->resize(300, 300)->save(public_path('/images/uploads/' . $filename));

            $user = Auth::user();
            $user->profile_picture = $filename;
            $user->save();
        }
        if ($request->input('password') != '') {
            $user->password = $request->input('password');
        }

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,



        ]);
        
        $user->update();

        return response()->json([
            'message' => 'Profile successfully updated',
            'status' => 200,
        ]);
    }
    public function uploadimage(Request $request)
    {

        $user = $request->user();

        //check file
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/uploads/', $filename);
            $user->profile_picture = $filename;
            //move image to public/img folder
            $user->save();
            $user->update();
            return response()->json(["status" => 200, "message" => "Image Uploaded Succesfully"]);
        } else {
            return response()->json(["status" => 200, "message" => "Select image first."]);
        }
    }
}

