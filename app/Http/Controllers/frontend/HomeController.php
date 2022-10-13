<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\Category;
use App\Models\Testmonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $categories = Category::where('is_active',1)
        ->latest('id')
        ->limit(5)
        ->select('id', 'title', 'slug', 'category_image')
        ->get();

        $products = Product::where('is_active', 1)
        ->latest('id')
        ->select('id', 'product_name', 'slug', 'product_price', 'product_stock', 'product_rating', 'product_image')
        ->paginate(8);

        $testimonials = Testmonial::where('is_active', 1)
        ->latest('id')
        ->limit(3)
        ->select('id', 'client_name', 'client_designation', 'client_message', 'client_image')
        ->get();
        // return $testimonial;
        // return $category;

        return view('frontend.pages.home',compact('testimonials','categories','products') );
    }

    public function shopPage()
        {
            $allproducts = Product::where('is_active', 1)
            ->latest('id')
            ->select('id', 'product_name', 'slug', 'product_price', 'product_stock', 'product_rating', 'product_image')
            ->paginate(10);

            $categories = Category::where('is_active', 1)
            ->with('products')
            ->latest('id')
            ->limit(5)
            ->select('id','title','slug')
            ->get();

            return view('frontend.pages.shop',compact('allproducts', 'categories'));
        }

        public function productDetails($product_slug)
        {
            $product = Product::whereSlug($product_slug)
                ->with('category', 'ProductImages')
                ->first();

            $related_products = Product::where('slug', '=!',$product_slug)
            ->select('id', 'product_name', 'slug', 'product_price', 'product_image')
            ->limit(2)
            ->get();
            // return  $product ;
            // return  $related_products ;
            return view('frontend.pages.single-product',compact('product', 'related_products'));
        }

}
