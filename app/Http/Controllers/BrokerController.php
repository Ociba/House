<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\broker;
use Auth;
use App\Models\User;

class BrokerController extends Controller
{
    //
    public function createBroker(Request $request)
    {
        //
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'current_location' => 'required',
        ]);
        $items  =broker::create([
            'name' =>$validateData['name'],
            'email' =>$validateData['email'],
            'phone_number' =>$validateData['phone_number'],
            'current_location' =>$validateData['current_location'],
        ]);
        return response()->json('New Broker has been created successfully');
    }
    /*
    * this function adds the photo to the folder
    */
   private function movePhotoToFolder(){
       if(empty(request()->photo)){
           return null;
       }else{
           $photo_path = request()->photo;
           $file_path = $photo_path->getClientOriginalName();
           $photo_path->move('Agent/photos',$file_path);
           return $file_path;
       }
   }
        protected function getBroker(){
        $agents =broker::get();
        return $agents->tojson();
    }

    public function deleteBroker($id)
    {
        //
        Broker::where('id', $id)->delete();
        return response()->json('Agent has been Deleted successfully');
    }
}
