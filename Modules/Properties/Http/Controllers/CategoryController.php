<?php

namespace Modules\Properties\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Properties\Entities\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getCategory()
    {
        $get_property_category =Category::get();
        return $get_property_category->tojson();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
       
        return view('properties::create_category');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
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
    public function editCategory($id)
    {
        $edit_category = Category::where('id',$id)->get();
        return response()->json($edit_category);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateCategory(Request $request, $id)
    {
        //
        Category::where('id', $id)->update(array(
             'name'       =>request()->name,
             'updated_by' =>Auth::user()->id,
        ));
        return response()->json('Category Content has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function deleteCategory($id)
    {
        //
        Category::where('id', $id)->delete();
        return response()->json('Category has been deleted successfully');
    }
}
