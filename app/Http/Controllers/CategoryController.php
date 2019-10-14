<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB,
    Hash,
    File,
    Validator;

class CategoryController extends Controller
{
    // <!-- view: add-categories -->
    public function addCategory(Request $request)
    {

        if($request->isMethod('post'))
        {
            $data = $request->all();

            //status to enable/disable category
            if(empty($data['status']))
            {
                $status = 0;
            }else{
                $status = 1;
            }
            $category = new Category;
            $category->name = strip_tags($data['category_name']);
            $category->parent_id = strip_tags($data['parent_id']);
            $category->description = strip_tags($data['description']);
            $category->url =strip_tags($data['url']);
            $category->status = $status;
            $category->save();
            return redirect('admin1/categorieslist')->with('update_message','Category Added Successfully!');
        }

        $levels = Category::where(['parent_id'=> 0 ])->get();
        return view('admin.categories.add_category',compact('levels'));
    }

    //view : categories list
    public function showCategories()
    {
        $categories = Category::get();
        return view('admin.categories.categories_list')->with(compact('categories'));
    }

    //view: Edit categories
    public function editCategory(Request $request, $id=null)
    {

        if($request->isMethod('post'))
        {
            $data = $request->all();
            //status to enable/disable category
            if(empty($data['status']))
            {
                $status = 0;
            }else{
                $status = 1;
            }

            Category::where(['id'=>$id])->update(
                [
                    'name'=>strip_tags($data['category_name']),
                    'description'=>strip_tags($data['description']),
                    'url'=>strip_tags($data['url']),
                    'status'=>$status,
                ]
            );

            return redirect('admin1/categorieslist')->with('update_message','Category updated successfully!');
        }

        $categoryDetails = Category::where(['id'=>$id])->first();
        $levels = Category::where(['parent_id'=> 0 ])->get();

        return view('admin.categories.edit_category')->with(compact('categoryDetails','levels'));
    }

    //Delete categories
    public function deleteCategory($id = null)
    {
        if(!empty($id)) {
            Category::where(['id' => $id])->delete();
            return redirect()->back()->with('update_message', 'Category deleted successfully!');
        }
    }

}
