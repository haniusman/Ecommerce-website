<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function addCoupon(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //dd($data); die;
            //status to enable/disable coupon
            if(empty($data['status']))
            {
                $status = 0;
            }else{
                $status = 1;
            }

            $coupon = new Coupon();
            $coupon->coupon_code = strip_tags($data['coupon_code']);
            $coupon->amount = strip_tags($data['amount']);
            $coupon->amount_type = strip_tags($data['amount_type']);
            $coupon->expiry_date = strip_tags($data['expiry_date']);
            $coupon->status = $status;

            $coupon->save();
            return redirect('admin1/couponslist')->with('update_message','Coupon Added Successfully!');
        }
        return view('admin.coupons.add_coupon');
    }

    //Show coupons list
    public function showCoupons()
    {
        $coupons = Coupon::orderBy('id','DESC')->get();

        return view('admin.coupons.coupons_list')->with(compact('coupons'));
    }

    //Edit coupon
    public function editCoupon(Request $request, $id = null)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //status to enable/disable coupon
            if(empty($data['status']))
            {
                $status = 0;
            }else{
                $status = 1;
            }
            Coupon::where(['id'=>$id])->update(
                [
                    'coupon_code' => strip_tags($data['coupon_code']),
                    'amount' => strip_tags($data['amount']),
                    'amount_type' => strip_tags($data['amount_type']),
                    'expiry_date' => strip_tags($data['expiry_date']),
                    'status' => $status,
                ]
            );
            return redirect('admin1/couponslist')->with('update_message','Coupon Updated Successfully!');

        }
        $couponDetails = Coupon::find($id);
        return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    }

    //Delete Coupon
    public function deleteCoupon($id = null)
    {
        Coupon::where(['id'=>$id])->delete();
        return redirect('admin1/couponslist')->with('update_message','Coupon Deleted Successfully!');

    }
}
