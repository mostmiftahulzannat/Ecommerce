<?php

namespace App\Http\Controllers\backend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\couponStoreRequest;
use App\Http\Requests\couponUpdateRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest('id')->paginate(10);
        // return $coupons;
          return view('backend.pages.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(couponStoreRequest $request)
    {
        $coupons = Coupon::create([
            'coupon_name'=>$request->coupon_name,
            'discount_amount'=>$request->discount_amount,
            'minimum_purchase_amount'=>$request->minimum_purchase_amount,
            'validity_date'=>$request->validity_date,
           ]);
     Toastr::success('Data Stored Successfully');
     return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('backend.pages.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(couponUpdateRequest $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->update([
            'coupon_name'=>$request->coupon_name,
            'discount_amount'=>$request->discount_amount,
            'minimum_purchase_amount'=>$request->minimum_purchase_amount,
            'validity_date'=>$request->validity_date,
            'is_active' => $request->filled('is_active'),
           ]);
     Toastr::success('Data Update Successfully');
     return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
    //   $coupon= Coupon::find($id)->delete();
      $coupon = Coupon::find($id);
      $coupon->delete();
    //   dd($id);
       Toastr::success('Data Deleted Successfully');
       return redirect()->route('coupon.index');
    }
    }

