<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
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
}
