<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Sample;
use  App\Models\broker;
use Modules\Properties\Entities\Category;

class SampleController extends Controller
{
    //
    /** 
     * Fetching data from the database
    */
    public function index(){
        $items =Sample::orderBy('created_at','desc')->get();
        return $items->tojson();
    }
    /** 
     * storing data to the databse
     * Validate data before storing
    */
    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'email'  => 'required',
            'phone_number' =>'required',
            'current_location' =>'required'
        ]);
        $items  =broker::create([
            'name' =>$validateData['name'],
            'email'  =>$validateData['email'],
            'phone_number' =>$validateData['phone_number'],
            'current_location'  =>$validateData['current_location'],
        ]);
        return response()->json('Added successfully');
    }
    /** 
     * This function edits items
    */
    public function edit($id){
        $item =Sample::where('id',$id)->get();
        return response()->json($item);
    }
    /** 
     * This function updates the updated data
    */
    public function update(Request $request){
        $item =Sample::find($id);
        $item->title =$request->title;
        $item->body =$request->body;
        $item ->save();

        return response()->json('Successfully Updated');
    }
    /** 
     * This function deletes item permanently
    */
    public function destroy($id){
        Sample::where('id', $id)->update(array('status' =>'not active'));
        return response()->json('Successfully Deleted');
    }
    public function createCategory(Request $request)
    {
        //
        // $create_property_category =new Category;
        // $create_property_category ->name =request()->name;
        // $create_property_category ->save();
        $validateData = $request->validate([
            'name' => 'required'
        ]);
        $items  =Category::create([
            'name' =>$validateData['name'],
        ]);
        return response()->json('New property Category has been created successfully');
    }
    public function store1(Request $request)
    {
        //
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'current_location' => 'required',
        ]);
        $items  =Broker::create([
            'name' =>$validateData['name'],
            'email' =>$validateData['email'],
            'phone_number' =>$validateData['phone_number'],
            'current_location' =>$validateData['current_location'],
        ]);
        return response()->json('New Broker has been created successfully');
    }
}
