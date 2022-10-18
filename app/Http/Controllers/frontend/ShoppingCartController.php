<?php

namespace App\Http\Controllers\frontend;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCartController extends Controller
{
    public function cartPage()
    {
       $carts = Cart::content();
    //    return $carts;
       $subtotal = Cart::subtotal();
       return view('frontend.pages.shopping-cart',compact('carts','subtotal'));
    }
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $product_slug = $request->product_slug;
        $order_qty = $request->order_qty;

        $product = Product::whereSlug($product_slug)->first();
    Cart::add([
        'id'=>$product->id,
        'name'=>$product->product_name,
        'qty'=>$order_qty,
        'stock'=>$product->product_stock,
        'weight'=>0,
        'price'=>$product->product_price,
        'options'=>[
        'image'=>$product->product_image,

        ]
    ]);
    Toastr::success('Add To Cart Successfully');
    return back();
    }


    public function removeToCart($cart_id)
    {
        // dd($cart_id);
        Cart::remove($cart_id);
        Toastr::success('Product Removed Successfully from Cart!');
        return back();
    }


        //Coupon Apply And Remove
        public function applyCoupon(Request $request)
        {
           if(!Auth::check()){
      Toastr::error('You must need  login first!');
      return redirect()->route('login.page');
           }
        //    dd($request->all());
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->first();
        //    dd($coupon);

        //don't allow double coupon
    if(Session::get('coupon')){
        Toastr::error('Already applied coupon!');
        return  redirect()->back();
    }
     //Coupon validity check
    if($coupon != null){
        // $coupon_validity = $coupon->validity_till >= Carbon::now()->format('Y-m-d');
        $coupon_validity  = $coupon->expiry_date >= Carbon::now();

        // return $coupon_validity;
        // if coupon date is not expried
        if($coupon_validity){
           // check coupon discount
            Session::put('coupon', [
                'name' => $coupon->coupon_name,
                'discount_amount' => round((Cart::subtotalFloat() * $coupon->discount_amount)/100),
                'cart_total' => Cart::subtotalFloat(),
                'balance' => round(Cart::subtotalFloat() - (Cart::subtotalFloat() * $coupon->discount_amount)/100)
            ]);
            Toastr::success('Coupon Percentage Applied!');
            return redirect()->back();
        }else{
            Toastr::error('Coupon Date Expire!');
            return redirect()->back();
        }
    }else{
        Toastr::error('Invalid Action/Coupon!');
        return redirect()->back();
    }
        }
}





