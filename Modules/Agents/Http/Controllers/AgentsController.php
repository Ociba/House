<?php

namespace Modules\Agents\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Agents\Entities\Broker;
use Auth;
use App\Models\User;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getBroker()
    {
        $get_agent =Broker::get();
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
    public function createBroker(Request $request)
    {
        //
        $create_agent =new Broker;
        $create_agent ->name  =request()->name;
        $create_agent ->email =request()->email;
        $create_agent ->phone_number =request()->phone_number;
        $create_agent ->current_location =request()->current_location;
        $create_agent ->photo = $this->movePhotoToFolder();
        $create_agent ->created_by =Auth::user()->id;
        $create_agent ->save();

        $create_agents_account =new User;
        $create_agents_account ->name  =request()->name;
        $create_agents_account ->email =request()->email;
        $create_agents_account ->password =Hash::make(request()->password);
        $create_agents_account  ->save();
        return response()->json('New Broker has been created successfully');
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
            $photo_path->move('Agent/Photos',$file_path);
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
    public function editBroker($id)
    {
        $edit_agent =Broker::where('id', $id)->get();
        return response()->json($edit_agent);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateBroker(Request $request, $id)
    {
        //
        Broker::where('id', $id)->update(array(
            'name'       =>request()->name,
            'email'      =>request()->email,
            'phone_number'=>request()->phone_number,
            'current_location'=>request()->current_location
        ));
        return response()->json('Agent info has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function deleteBroker($id)
    {
        //
        Broker::where('id', $id)->delete();
        return response()->json('Agent has been Deleted successfully');
    }
}
