<?php

namespace App\Http\Controllers;

use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Coupon;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use DB;
use Auth,
    Session,
    App\Category,
    App\Product;

class ProductsController extends Controller
{
    public function addProduct(Request $request)
    {

        if($request->isMethod('post'))
        {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            //status to enable/disable category
            if(empty($data['status']))
            {
                $status = 0;
            }else{
                $status = 1;
            }
            if(empty($data['category_id']))
            {
                return redirect()->back()->with('error','Category is missing!');

            }
            $product = new Product();

            $product->category_id = strip_tags($data['category_id']);
            $product->product_name = strip_tags($data['product_name']);
            $product->product_code = strip_tags($data['product_code']);
            $product->product_color = strip_tags($data['product_color']);
            if(!empty($data['description']))
            {
                $product->description = strip_tags($data['description']);
            }else{
                $product->description = "";
            }
            if(!empty($data['care']))
            {
                $product->care = strip_tags($data['care']);
            }else{
                $product->care = "";
            }
            $product->price = strip_tags($data['price']);

            //Upload image
            if($request->hasFile('image'))
            {
                $image_tmp = Input::file('image');
                if($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/products/large/'.$filename;
                    $medium_image_path = 'images/products/medium/'.$filename;
                    $small_image_path = 'images/products/small/'.$filename;

                    //resize image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    //Store image name in products table
                    $product->image = $filename;
                }

            }
            $product->status = $status;

            $product->save();
            return redirect('admin1/productslist')->with('update_message','Product Added Successfully!');

        }

        //Categories dropdown start

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value=''selected disabled>Select</option>";

        foreach($categories as $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        //Categories dropdown end-

        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    //Show products

    public function showProducts()
    {
        $products = Product::orderBy('id','DESC')->get();
        foreach($products as $key => $val)
        {
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.products_list')->with(compact('products'));
    }

    //Edit Products

    public function editProduct(Request $request, $id = null)
    {

        if($request->isMethod('post'))
        {
            $data = $request->all();
            //status to enable/disable product
            if(empty($data['status']))
            {
                $status = 0;
            }else{
                $status = 1;
            }

            //Upload image
            if($request->hasFile('image'))
            {
                $image_tmp = Input::file('image');
                if($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/products/large/'.$filename;
                    $medium_image_path = 'images/products/medium/'.$filename;
                    $small_image_path = 'images/products/small/'.$filename;
                    //resize image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                }
            }else{
                $filename = $data['current_image'];
            }
            if(empty($data['description']))
            {
                $data['description'] = '';
            }

            if(empty($data['care']))
            {
                $data['care'] = '';
            }

            Product::where(['id'=>$id])->update(
                [
                    'category_id' => strip_tags($data['category_id']),
                    'product_name' => strip_tags($data['product_name']),
                    'product_code' => strip_tags($data['product_code']),
                    'product_color' => strip_tags($data['product_color']),
                    'price' => strip_tags($data['price']),
                    'description' => strip_tags($data['description']),
                    'care' => strip_tags($data['care']),
                    'image' => $filename,
                    'status' => $status,
                ]
            );
            return redirect('admin1/productslist')->with('update_message','Product has been updated successfully!');
        }
        //get product details
        $productDetails = Product::where(['id'=>$id])->first();

        //Categories dropdown start

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value=''selected disabled>Select</option>";

        foreach($categories as $cat)
        {
            if($cat->id == $productDetails->category_id)
            {
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='" . $cat->id . "'".$selected.">" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat){
                if($sub_cat->id == $productDetails->category_id)
                {
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value='".$sub_cat->id."'".$selected.">&nbsp;&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        //Categories dropdown end-

        return view('admin.products.edit_product',compact('productDetails','categories_dropdown'));
    }

    //Delete Product Image

    public function deleteProductImage($id = null)
    {
        //Get product image name
        $productImage = Product::where(['id'=>$id])->first();

        //Get image path
        $large_image_path = 'images/products/large/';
        $medium_image_path = 'images/products/medium/';
        $small_image_path = 'images/products/small/';

       // Delete large image
        if(file_exists($large_image_path.$productImage->image))
        {
            unlink($large_image_path.$productImage->image);
        }

        // Delete medium image
        if(file_exists($large_image_path.$productImage->image))
        {
            unlink($large_image_path.$productImage->image);
        }

        // Delete small image
        if(file_exists($small_image_path.$productImage->image))
        {
            unlink($small_image_path.$productImage->image);
        }

        //Delete image from products table
        Product::where(['id'=>$id])->update(
          [
              'image' => ''
          ]
        );

        return redirect()->back()->with('update_message','Product image has been deleted successfully!');
    }

    //Delete Product

    public function deleteProduct($id = null)
    {
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('update_message','Product has been deleted successfully!');
    }

    //Add Product attributes

    public function addAttributes(Request $request, $id = null)
    {
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();

        if($request->isMethod('post'))
        {
            $data = $request->all();

            foreach($data['sku'] as $key => $val)
            {
                if(!empty($val))
                {
                    //Prevent duplicate SKU check
                    $attrCountSKU = ProductsAttribute::where('sku',$val)->count();
                    if($attrCountSKU > 0)
                    {
                        return redirect('admin1/add-attribute/'.$id)->with('error','SKU already exists! Please add another SKU');
                    }

                    //Prevent duplicate Size check
                    $attrCountSize = ProductsAttribute::where(['product_id'=>$id , 'size'=>$data['size'][$key]])->count();
                    if($attrCountSize > 0)
                    {
                        return redirect('admin1/add-attribute/'.$id)->with('error',''.$data['size'][$key].' size already exists! Please add another size');
                    }

                    $attribute = new ProductsAttribute();
                    $attribute->product_id = $id;
                    $attribute->sku = strip_tags($val);
                    $attribute->size = strip_tags($data['size'][$key]);
                    $attribute->price = strip_tags($data['price'][$key]);
                    $attribute->stock = strip_tags($data['stock'][$key]);

                    $attribute->save();
                }
            }

            return redirect('admin1/add-attribute/'.$id)->with('update_message','Product Attributes have been added successfully!');
        }


        return view('admin.products.add_attributes')->with(compact('productDetails'));
    }

    //Edit attributes
    public function editAttributes(Request $request, $id = null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();

            foreach($data['idAttr'] as $key => $attr)
            {
                ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update(
                    [
                        'price' => strip_tags($data['price'][$key]),
                        'stock' => strip_tags($data['stock'][$key])
                    ]
                );
            }
            return redirect()->back()->with('update_message','Product attributes have been updated successfully!');

        }
    }
    //Add alternate images
    public function addImages(Request $request,$id = null)
    {
        $productDetails = Product::with('images')->where(['id'=>$id])->first();

        if($request->isMethod('post'))
        {
            //Add images
            $data = $request->all();
            if($request->hasFile('image'))
            {
                $files = $request->file('image');
                foreach($files as $file)
                {
                    //Upload images after resize
                    $image = new ProductsImage();
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;


                    $large_image_path = 'images/products/large/'.$filename;
                    $medium_image_path = 'images/products/medium/'.$filename;
                    $small_image_path = 'images/products/small/'.$filename;

                    //resize image
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);

                    $image->image = $filename;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
            }
            return redirect('admin1/add-images/'.$id)->with('update_message','Product Images have been added successfully!');
        }

        $productImages= ProductsImage::where(['product_id'=>$id])->get();
        return view('admin.products.add_images')->with(compact('productDetails','productImages'));
    }

    //Delete Alternate Images
    public function deleteAltImage($id = null)
    {
        //Get product image name
        $productImage = ProductsImage::where(['id'=>$id])->first();
        //Get image path
        $large_image_path = 'images/products/large/';
        $medium_image_path = 'images/products/medium/';
        $small_image_path = 'images/products/small/';
        // Delete large image
        if(file_exists($large_image_path.$productImage->image))
        {
            unlink($large_image_path.$productImage->image);
        }

        // Delete medium image
        if(file_exists($large_image_path.$productImage->image))
        {
            unlink($large_image_path.$productImage->image);
        }

        // Delete small image
        if(file_exists($small_image_path.$productImage->image))
        {
            unlink($small_image_path.$productImage->image);
        }

        //Delete image from products table
        ProductsImage::where(['id'=>$id])->update(
            [
                'image' => ''
            ]
        );
        ProductsImage::where(['id'=>$id])->delete();
        return redirect()->back()->with('update_message','Product alternate image has been deleted successfully!');
    }

    //Delete attribute

    public function deleteAttributes($id = null)
    {
        ProductsAttribute::where(['id'=>$id])->delete();

        return redirect()->back()->with('update_message','Product Attribute has been deleted successfully!');
    }

    //List products

    public function products($url = null)
    {

        //Show 404 if category url doesn't exist
        $countCategory = Category::where(['url'=>$url,'status'=>1 ] )->count();
        if($countCategory == 0)
        {
            abort(404);
        }
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $categoryDetails = Category::where(['url'=>$url])->first();

        if($categoryDetails->parent_id == 0)
        {
            //url is main category
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();

            foreach($subCategories as $subcat)
            {
                $cat_ids[] = $subcat->id;
            }
            $productsAll = Product::whereIn('category_id',$cat_ids)->where('status',1)->get();
        }else{
            //url is sub category
            $productsAll = Product::where(['category_id' => $categoryDetails->id])->where('status',1)->get();
        }
        //echo $categoryDetails->id;
        return view('products.listing')->with(compact('categories','categoryDetails','productsAll'));

    }

    //Product details

    public function product($id = null)
    {
        //Show 404 page if product is disabled
        $productsCount = Product::where(['id'=>$id,'status'=>1])->count();
        if($productsCount == 0)
        {
            abort(404);
        }
        //Get product details
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $productAltImages = ProductsImage::where(['product_id'=>$id])->get();

        //Check product availability
        $total_stock = ProductsAttribute::where(['product_id'=>$id])->sum('stock');

        //Related items
        $relatedProducts = Product::where('id','!=', $id)->where(['category_id'=>$productDetails->category_id])->where('status',1)->get();
       // $relatedProducts = json_decode(json_encode( $relatedProducts));
       // echo "<pre>";print_r($relatedProducts);die;

        return view('products.detail')->with(compact('productDetails','categories','productAltImages','total_stock','relatedProducts'));
    }

    //Product attribute price
    public function getProductPrice(Request $request)
    {
        $data = $request->all();
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0],'size' => $proArr[1]])->first();
        echo $proAttr->price;
        echo "#";
        echo $proAttr->stock;

    }

    //Add to cart
    public function addtocart(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
       // $user_email = Auth::user()->email;

        $data = $request->all();
       // echo "<pre>";print_r($data);die;
        if(empty($data['size']))
        {
            return redirect()->back()->with('error','Please select size!');
        }
        if(empty(Auth::user()->email))
        {
            $data['user_email'] = "";
        }else{
            $data['user_email'] = Auth::user()->email;
        }
        if(empty($user_email))
        {
            $user_email = "";
        }

        $session_id = Session::get('session_id');

        if(empty($session_id))
        {
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }
        $sizeArr = explode('-',$data['size']);
        //Check whether product already exists in cart
        $countProducts = DB::table('cart')->where([
            'product_id' => $data['product_id'],
//            'product_code' =>$data['product_code'],
            'product_color' =>$data['product_color'],
            'size' => $sizeArr[1],
            'session_id' => $session_id
            ])->count();
//        dd($countProducts);
        if($countProducts > 0)
        {
            return redirect()->back()->with('update_message','Product has already been added in cart!');
        }else{
            $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$sizeArr[1]])->first();

            DB::table('cart')->insert([
                'product_id' => strip_tags($data['product_id']),
                'product_name' => strip_tags($data['product_name']),
                'product_code' => $getSKU->sku,
                'product_color' => strip_tags($data['product_color']),
                'price' => strip_tags($data['price']),
                'size' => strip_tags($sizeArr[1]),
                'quantity' => strip_tags($data['quantity']),
                'user_email' => $data['user_email'],
                'session_id' => $session_id,
            ]);

            return redirect('/cart')->with('update_message','Product has been added in cart!');
        }
    }

    //Cart Page
    public function cart()
    {
        if(Auth::check())
        {
            $user_email = Auth::user()->email;
            $user_cart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        }
        else{
            $session_id = Session::get('session_id');
            $user_cart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }
        // echo "<pre>"; print_r($user_cart);die;
        foreach($user_cart as $key => $product)
        {
            $productDetails = Product::where(['id'=>$product->product_id])->first();
            $user_cart[$key]->image = $productDetails->image;
         }

        return view('products.cart')->with(compact('user_cart'));
    }

    //Update cart Quantity
    public function updateCartQuantity($id = null, $quantity = null)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $getCartDetails = DB::table('cart')->where(['id'=>$id])->first();
        $getAttributeStock = ProductsAttribute::where('sku',$getCartDetails->product_code)->first();
        $updated_quantity = $getCartDetails->quantity+$quantity;
        if($getAttributeStock->stock >= $updated_quantity)
        {
            DB::table('cart')->where(['id'=>$id])->increment('quantity',$quantity);
            return redirect('/cart')->with('update_message','Product quantity has been updated successfully!');
        }else{
            return redirect('/cart')->with('error','Required product quantity is not available!');
        }
    }

    //Delete product from cart
    public function deleteCartProduct($id = null)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        DB::table('cart')->where(['id'=>$id])->delete();
        return redirect('/cart')->with('update_message','Product has been deleted from cart');
    }

    //Apply Coupon
    public function applyCoupon(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0)
        {
            return redirect()->back()->with('error','Coupon is not valid');
        }else{
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();

            //If coupon status is disabled
            if($couponDetails->status == 0)
            {
                return redirect()->back()->with('error','Coupon is not active!');
            }

            //If coupon is expired
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');

            if($expiry_date < $current_date)
            {
                return redirect()->back()->with('error','This Coupon is expired!');

            }
            //Coupon is valid
            //GEt total amount
              $session_id = Session::get('session_id');
//            $user_cart = DB::table('cart')->where(['session_id' => $session_id])->get();
            if(Auth::check())
            {
                $user_email = Auth::user()->email;
                $user_cart = DB::table('cart')->where(['user_email'=>$user_email])->get();
            }
            else{
                $session_id = Session::get('session_id');
                $user_cart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }
            $total_amount = 0;
            foreach($user_cart as $item)
            {
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }
            //Check amount type
            if($couponDetails->amount_type == 'Fixed')
            {
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);
            return redirect()->back()->with('update_message','Coupon code successfully applied. You are availing discount!');
        }


    }

    //Checkout
    public function checkout(Request $request)
    {
        $user_id = Auth::User()->id;
        $user_email = Auth::User()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        $shippingDetails = array();
        $shippingCount  = DeliveryAddress::where('user_id',$user_id)->count();
        if($shippingCount > 0)
        {
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }
        //Update user email in cart
        $session_id = Session::get('session_id');
        DB::table('cart')->where('session_id',$session_id)->update(
            [
                'user_email' => $user_email
            ]
        );
        if($request->isMethod('post'))
        {
            $data = $request->all();
            if(empty($data['billing_name'])||empty($data['billing_address'])||empty($data['billing_city'])||empty($data['billing_province'])||
                empty($data['billing_country'])||empty($data['billing_pincode'])||empty($data['billing_mobile'])||empty($data['shipping_name'])||
                empty($data['shipping_address'])||empty($data['shipping_city'])||empty($data['shipping_province'])||
            empty($data['shipping_country'])||empty($data['shipping_pincode'])||empty($data['shipping_mobile']))
            {
                return redirect()->back()->with('error','Please fill all fields to Check out');
            }
            //Update user details
            User::where(['id'=>$user_id])->update(
                [
                    'name' => $data['billing_name'],
                    'address' => $data['billing_address'],
                    'city' => $data['billing_city'],
                    'province' => $data['billing_province'],
                    'country' => $data['billing_country'],
                    'pincode' => $data['billing_pincode'],
                    'mobile' => $data['billing_mobile']
                ]
            );
            if($shippingCount > 0)
            {
                //Update shipping address
                DeliveryAddress::where('user_id',$user_id)->update(
                    [
                        'name' => $data['shipping_name'],
                        'address' => $data['shipping_address'],
                        'city' => $data['shipping_city'],
                        'province' => $data['shipping_province'],
                        'country' => $data['shipping_country'],
                        'pincode' => $data['shipping_pincode'],
                        'mobile' => $data['shipping_mobile']
                    ]
                );
            }else{
                //Add new shipping address
                $shipping = new DeliveryAddress();
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->province = $data['shipping_province'];
                $shipping->country = $data['shipping_country'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
            }
//            echo"Redirect to order review page";die;
            return redirect('order-review');
        }
        return view('products.checkout')->with(compact('userDetails','countries','shippingDetails'));
    }

    //Order Review
    public function orderReview()
    {
        $user_id = Auth::User()->id;
        $user_email = Auth::User()->email;
        $userDetails = User::find($user_id);
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $user_cart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        foreach($user_cart as $key => $product)
        {
            $productDetails = Product::where(['id'=>$product->product_id])->first();
            $user_cart[$key]->image = $productDetails->image;
        }


        return view('products.order_review')->with(compact('userDetails','shippingDetails','user_cart'));
    }

    //Place order
    public function placeOrder(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $user_id = Auth::User()->id;
            $user_email = Auth::User()->email;
//            print_r($data);die;

            if(empty(Session::get('CouponCode')))
            {
                $coupon_code = '';
            }else{
                $coupon_code = Session::get('CouponCode');
            }
            if(empty(Session::get('CouponAmount')))
            {
                $coupon_amount = '';
            }else
            {
                $coupon_amount =  Session::get('CouponAmount');
            }

            //Get shipping address of user
            $shippingDetails = DeliveryAddress::where('user_email',$user_email)->first();
            $order = new Order();
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name =$shippingDetails->name;
            $order->address =$shippingDetails->address;
            $order->city =$shippingDetails->city;
            $order->province =$shippingDetails->province;
            $order->country =$shippingDetails->country;
            $order->pincode =$shippingDetails->pincode;
            $order->mobile =$shippingDetails->mobile;
            $order->coupon_code =$coupon_code;
            $order->coupon_amount =$coupon_amount;
            $order->order_status ="New";
            $order->payment_method =$data['payment_method'];
            $order->grand_total =$data['grand_total'];

            $order->save();

           $order_id =  DB::getPdo()->lastInsertId();
           $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
           foreach($cartProducts as $pro)
           {
               $cartPro = new OrdersProduct();
               $cartPro->order_id = $order_id;
               $cartPro->user_id = $user_id ;
               $cartPro->product_id =$pro->product_id ;
               $cartPro->product_code =$pro->product_code ;
               $cartPro->product_name =$pro->product_name ;
               $cartPro->product_color =$pro->product_color ;
               $cartPro->product_size =$pro->size ;
               $cartPro->product_price =$pro->price ;
               $cartPro->product_qty =$pro->quantity ;
               $cartPro->save();
           }

           Session::put('order_id',$order_id);
           Session::put('grand_total',$data['grand_total']);

           if($data['payment_method']=='COD')
           {//COD- redirect to thanks page after saving order
               return redirect('thanks');
           }else{
               //Paypal-redirect to paypal page
               return redirect('/paypal');
           }

        }
    }

    //Thankyou page
    public function thanks()
    {
        $user_email = Auth::user()->email;
        DB::table('cart')->where(['user_email'=>$user_email])->delete();
        return view('orders.thanks');
    }

    //User Orders
    public function userOrders()
    {
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        return view('orders.users_orders')->with(compact('orders'));
    }

    public function userOrderDetails($order_id)
    {
        $user_id = Auth::user()->email;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        return view('orders.user_order_details')->with(compact('orderDetails'));
    }

    //Paypal
    public function paypal(Request $request)
    {
        return view('orders.paypal');
    }

    //Show orders
    public function showOrders()
    {
        $orders = Order::with('orders')->orderBy('id','DESC')->get();
        return view('admin.orders.orders_list')->with(compact('orders'));
    }

    //View order details
    public function viewOrderDetails($order_id)
    {
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
    }
}
