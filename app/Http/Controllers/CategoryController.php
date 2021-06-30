<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Properties\Entities\Category;

class CategoryController extends Controller
{
   /** 
    * get categories
   */
  public function getCategory()
    {
        $get_property_category =Category::get();
        return $get_property_category->tojson();
    }
    /** 
     * Create Categories
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
     * This function edits category
    */
    public function editCategory($id)
    {
        $edit_category = Category::where('id',$id)->get();
        return response()->json($edit_category);
    }
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
