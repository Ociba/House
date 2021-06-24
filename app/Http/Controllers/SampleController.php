<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Sample;

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
            'title' => 'required',
            'body'  => 'required'
        ]);
        $items  =Sample::create([
            'title' =>$validateData['title'],
            'body'  =>$validateData['body'],
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
}
