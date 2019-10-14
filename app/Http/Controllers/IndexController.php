<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
      //  $productsAll = Product::orderBy('id','DESC')->get(); // show in descending order

        //in random order
        $productsAll = Product::inRandomOrder()->where('status',1)->get();
       $categories = Category::with('categories')->where(['parent_id'=>0])->get();
//       dump($productsAll);
       /*$categories_menu = '';
       foreach ($categories as $cat)
       {
           $categories_menu .= "
                                    <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='accordion' href='#".$cat->id."'>
                                            <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                             ".$cat->name."
                                        </a>
                                    </h4>
                                </div>             
                                   <div id='#".$cat->id."' class='panel-collapse collapse'>
                                    <div class='panel-body'>
                                        <ul>";
                                     $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
                                     foreach($sub_categories as $sub_cat)
                                     {
                                         $categories_menu .= " <li><a href='#'>".$sub_cat->name." </a></li> ";
                                     }
                                    $categories_menu .= " </ul>
                                    </div>
                                </div>
                                </div>
                                ";
       }*/  //Simple method for displaying categories without relations
        $banners = Banner::where('status','1')->get();
        return view('index',compact('productsAll','categories','banners'));
    }
}
