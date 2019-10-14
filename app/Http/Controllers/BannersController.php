<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use DB;

class BannersController extends Controller
{
    public function addBanner(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //status to enable/disable banner
            if(empty($data['status']))
            {
                $status = 0;
            }else{
                $status = 1;
            }

            $banner = new Banner();
            //upload banner image
            $banner->title = strip_tags($data['title']);
            $banner->link = strip_tags($data['link']);
            $banner->status = $status;

            if($request->hasFile('image'))
            {
                $image_tmp = Input::file('image');
                if($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banners/'.$filename;
                    Image::make($image_tmp)->resize(1140,340)->save($banner_path);

                    //Store image name in products table
                    $banner->image = $filename;
                }
            }
            $banner->save();
            return redirect('admin1/bannerslist')->with('update_message','Banner Added Successfully!');
        }
        return view("admin.banners.add_banner");
    }

    public function showBanners()
    {
        $banners = Banner::orderBy('id','DESC')->get();
        return view('admin.banners.banners_list')->with(compact('banners'));
    }

    public function getPosts()
    {
        $banners = DB::table('banners')->select('*');
        return Datatables::of($banners)
            ->make(true);
    }

    public function editBanner(Request $request, $id = null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            if(empty($data['status']))
            {
                $status = 0;
            }else{
                $status = 1;
            }

            if(empty($data['title']))
            {
                $data['title'] = '';
            }
            if(empty($data['link']))
            {
                $data['link'] = '';
            }

            if($request->hasFile('image'))
            {
                $image_tmp = Input::file('image');
                if($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banners/'.$filename;
                    Image::make($image_tmp)->resize(1140,340)->save($banner_path);
                }
            }elseif (!empty($data['current_image'])){
                $filename = $data['current_image'];
            }else{
                $filename = '';
            }

            Banner::where(['id'=>$id])->update(
                [
                    'title' => strip_tags($data['title']),
                    'link' => strip_tags($data['link']),
                    'image' => $filename,
                    'status' => $status,
                ]
            );
            return redirect('admin1/bannerslist')->with('update_message','Banner has been updated successfully!');
        }
        $bannerDetails = Banner::where(['id'=>$id])->first();
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));
    }

    public function deleteBanner($id = null)
{
    Banner::where('id',$id)->delete();
    return redirect()->back()->with('update_message','Banner deleted successfully!');

}
}
