<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Validator;


class RolePermissionController extends Controller
{

    public function show($id)
    {

        $item =RolePermission::find($id);
        if($item){

        return response()->json(['RolePermission'=>$item], 200);
        }
    else
    {
    return response()->json(['message'=>'not found'], 404);
    }
    }

    public function index()
    {

        $item =RolePermission::all();

        return response()->json(['RolePermission'=>$item], 200);
    }

    public function store(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'menu_id' => 'required',
            'Is_Full' => 'required',
            'Is_View' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->getMessageBag(),
            ]);
        } else {
        $item =new RolePermission();
      //  $item->RoleID=$req->RoleID;
        $item->menu_id=$req->MenuID;
        $item->Is_Full=$req->Is_Full;
        $item->Is_View=$req->Is_View;
        $item->save();
        return response()->json(['message'=>'done','status' => 200]);
    }
}
    public function update(Request $req,$id)
    {

        $validator = Validator::make($req->all(), [
            'menu_id' => 'required',
            'Is_Full' => 'required',
            'Is_View' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'validate_err' => $validator->getMessageBag(),
            ]);
        } else {
        $item =RolePermission::find($id);

        if($item){
        //$item->RoleID=$req->RoleID;
        $item->menu_id=$req->MenuID;
        $item->Is_Full=$req->Is_Full;
        $item->Is_View=$req->Is_View;
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

        $item =RolePermission::find($id);
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

