<?php

namespace App\Http\Controllers\frontend;

use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Models\Upazila;
use App\Models\District;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Mail\PurchaseConfirm;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function checkoutPage()
    {
        $upazilas = array();
        $carts = Cart::content();
        $total_price = Cart::subtotal();
       $districs = District::select('id','name','bn_name')->get();
       return view('frontend.pages.checkout',compact('carts','total_price','districs','upazilas'));
    }


    public function loadUpazillaAjax(Request $request)
    {
        $upazilas = Upazila::where('district_id',$request->districtId)->get(['id','name']);
        return view('frontend.pages.subdistrict_ajax',['upazilas'=>$upazilas]);
    }


    public function placeOrder(Request $request)
    {
        // dd($request->all());

        $billing = Billing::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'phone_number'=>$request->phone,
           'district_id'=>$request->district_id,
           'upazila_id'=>$request->upazila_id,
           'address'=>$request->address,
           'order_notes'=>$request->order_note,
        ]);

        $order = Order::create([
             'user_id '=>Auth::id(),
             'billing_id '=>$billing->id,
             'sub_total'=> Session::get('coupon')['cart_total'] ??  round(Cart::subtotalFloat()),
             'discount_amount'=> Session::get('coupon')['discount_amount'] ?? 0,
             'coupon_name'=> Session::get('cpupon')['name'] ?? '',
             'total' => Session::get('coupon')['balance'] ?? round(Cart::subtotalFloat()),

        ]);

//Order_etails table data insert using cart_items helpers
        foreach(Cart::content() as $cart_item ){
            OrderDetails::create([
                'order_id '=> $order->id,
                'user_id' => Auth::id(),
                'product_id ' => $cart_item->id,
                'product_qty'=>$cart_item->qty,
                'product_price'=>$cart_item->price,
            ]);

Product::findOrFail($cart_item->id)->decrement('product_stock', $cart_item->qty);
        }
        Cart::destroy();
        Session::forget('coupon');


        //get order ,billing,order details for meil
        $order = Order::whereId($order->id)->with(['billing', 'orderdetails'])->get();
        Mail::to($request->email)->send(new PurchaseConfirm($order));
        
        Toastr::success('Your Order placed successfully!');
        return redirect()->route('cart.page');
    }
}
