<?php

namespace Modules\Agents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Agents\Entities\Owner;
use Auth;
use App\Models\User;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getOwner()
    {
        $get_property_owner =Owner::get();
        return $get_agent->tojson();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('agents::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function createOwner(Request $request)
    {
        $create_owner =new Owner;
        $create_owner ->name  =request()->name;
        $create_owner ->email =request()->email;
        $create_owner ->phone_number =request()->phone_number;
        $create_owner ->current_location =request()->current_location;
        $create_owner ->photo = $this->movePhotoToFolder();
        $create_owner ->created_by =Auth::user()->id;
        $create_owner ->save();

        $create_owners_account =new User;
        $create_owners_account ->name  =request()->name;
        $create_owners_account ->email =request()->email;
        $create_owners_account ->password =Hash::make(request()->password);
        $create_owners_account  ->save();
        return response()->json('New Owner has been created successfully');
    }

    /**
     * this function adds the photo to the folder
     */
    private function movePhotoToFolder(){
        if(empty(request()->photo)){
            return null;
        }else{
            $photo_path = request()->photo;
            $file_path = $photo_path->getClientOriginalName();
            $photo_path->move('Owner/Photos',$file_path);
            return $file_path;
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('agents::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editOwner($id)
    {
        $edit_owner =Owner::where('id', $id)->get();
        return response()->json($edit_owner);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateOwner(Request $request, $id)
    {
        //
        Owner::where('id', $id)->update(array(
            'name'       =>request()->name,
            'email'      =>request()->email,
            'phone_number'=>request()->phone_number,
            'current_location'=>request()->current_location
        ));
        return response()->json('Property Owner info has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function deleteOwner($id)
    {
        //
        Owner::where('id', $id)->delete();
        return response()->json('Owner has been Deleted successfully');
    }
}
