<?php

namespace Modules\Properties\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Properties\Entities\PropertyDetails;
use Auth;

class PropertyDetailsController extends Controller
{
    /** 
     * This function Displays all properties
    */
    public function getAllProperty(){
        $get_all_property_details =PropertyDetails::join('users','property_details.user_id','users.id')
        ->join('categories','property_details.category_id','categories.id')
        ->select('property_details.*','categories.name')
        ->get();
        return $get_all_property_details->tojson();
    }
    /**
     * Display properties which are for sale and rent of the resource.
     * @return Renderable
     */
    public function getPropertyDetails()
    {

        $get_hot_offer =PropertyDetails::join('users','property_details.user_id','users.id')
        ->join('categories','property_details.category_id','categories.id')
        ->select('property_details.*','categories.name')
        ->where('property_details.status','hot offer')
        ->get();

        $get_featured_offer =PropertyDetails::join('users','property_details.user_id','users.id')
        ->join('categories','property_details.category_id','categories.id')
        ->select('property_details.*','categories.name')
        ->where('property_details.status','featured offer')
        ->get();

        $get_rent_and_sale_property =PropertyDetails::join('users','property_details.user_id','users.id')
        ->join('categories','property_details.category_id','categories.id')
        ->select('property_details.*','categories.name')
        ->where('property_details.status','rent')
        ->orWhere('property_details.status','sale')
        ->get();
        return $get_rent_and_sale_property,$get_hot_offer,$get_featured_offer->tojson();
    }
   
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('properties::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
        $create_property_details =new PropertyDetails;
        $create_property_details ->category_id =request()->category;
        $create_property_details ->user_id     =Auth::user()->id;
        $create_property_details ->property_size =request()->property_size;
        $create_property_details  ->bedroom     =request()->bedroom; //optional
        $create_property_details  ->bathroom    =request()->bathroom; //optional
        $create_property_details  ->garage      =request()->garage;  //optional
        $create_property_details  ->location    =request()->location;
        $create_property_details  ->description =request()->description;
        $create_property_details  ->price       =request()->price;
        $create_property_details  ->property_status =request()->property_status;
        $create_property_details  ->image = $this->moveImageToFolder();
        $create_property_details ->save();
        return response()->json('New Property Details has been created successfully');
    }
    /**
     * this function adds the images to the folder
     */
    private function moveImageToFolder(){
        if(empty(request()->image)){
            return null;
        }else{
            $image_path = request()->image;
            $file_path = $image_path->getClientOriginalName();
            $image_path->move('property/images',$file_path);
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
        return view('properties::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editProperty($id)
    {
        $edit_property_details =PropertyDetails::where('id', $id)->get();
        $get_category =Category::select('id','name')->get();
        return response()->json($edit_property_details,$get_category);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateProperty(Request $request, $id)
    {
        //
        PropertyDetails::where('id', $id)->update(array(
            'property_size'  =>request()->property_size,
            'bedroom'        =>request()->bedroom,
            'bathroom'       =>request()->bathroom,
            'garage'         =>request()->garage,
            'location'       =>request()->location,
            'description'    =>request()->description,
            'price'          =>request()->price,
            'property_status'=>request()->property_status
        ));
        return response()->json('New Property Details has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function deleteProperty($id)
    {
        //
        $delete_property_details =PropertyDetails::where('id', $id)->update(array('property_status' =>'taken'));
        return response()->json('New Property Details has been Updated successfully');
    }
}
