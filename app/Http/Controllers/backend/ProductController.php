<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\ProductImages;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('is_active', 1)
        ->with('category')
        ->latest('id')
        ->select('id','category_id','product_name','slug','product_code','product_price','product_stock','product_qty','product_image','product_rating','updated_at')->paginate(15);
        // return $products;
        return view('backend.pages.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $categories = Category::select(['id','title'])->get();
        return view('backend.pages.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {

        //  dd($request->all());
        $products = Product::create([
            'category_id'=>$request->category_id,
            'product_name'=>$request->product_name,
            'slug'=>Str::slug($request->product_name),
            'product_code'=>$request->product_code,
            'product_price'=>$request->product_price,
            'product_stock'=>$request->product_stock,
            'product_qty'=>$request->product_qty,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'additional_info'=>$request->additional_info,

        ]);
    //    return $peoducts;
        $this->image_upload($request, $products->id);
        $this->multiple_image_upload($request, $products->id);
        Toastr::success('Data Store Successfully!');
        return redirect()->route('products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
         $products = Product::where('slug',$slug)->first();

    //    $products;
       $categories = Category::select(['id','title'])->get();
       return view('backend.pages.products.edit',compact('categories', 'products'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $slug)
    {
        $products = Product::whereSlug($slug)->first();
        $products->update([
            'category_id'=>$request->category_id,
            'product_name'=>$request->product_name,
            'slug'=>Str::slug($request->product_name),
            'product_code'=>$request->product_code,
            'product_price'=>$request->product_price,
            'product_stock'=>$request->product_stock,
            'product_qty'=>$request->product_qty,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,
            'additional_info'=>$request->additional_info,

        ]);
        $this->image_upload($request, $products->id);
        $this->multiple_image_upload($request, $products->id);
        Toastr::success('Data update Successfully!');
        return redirect()->route('products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $products = Product::whereSlug($slug)->first();
        $mul_images=ProductImages::where('product_id',$products->id)->get();
        foreach($mul_images as $mul_image){
        if($mul_images){
            $photo_location = 'public/uploads/product/';
            $old_photo_location = $photo_location . $mul_image->product_multiple_image;
            if($old_photo_location){
                unlink(base_path($old_photo_location));
            }

            $mul_image->delete();
        }
    }
        if($products->product_image){
            $photo_location = 'uploads/product/'. $products->product_image;
            unlink($photo_location);
        }
        $products->delete();
        Toastr::success('Data Deleted Successfully!');
        return redirect()->route('products.index');
    }


    public function image_upload($request, $product_id)
    {

        $products = Product::findorFail($product_id);
        //dd($request->all(), $products, $request->hasFile('product_image'));
        if ($request->hasFile('product_image')) {
            if ($products->product_image != 'product_image.jpg') {
                //delete old photo
                $photo_location = 'public/uploads/product/';
                $old_photo_location = $photo_location . $products->product_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/product/';
            $uploaded_photo = $request->file('product_image');
            $new_photo_name = $products->id . '.' . $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(105,105)->save(base_path($new_photo_location), 40);
            $check = $products->update([
                'product_image' => $new_photo_name,
            ]);
        }
    }

    public function multiple_image_upload($request,  $product_id)
    {
       if($request->hasFile('product_multiple_image')){
        $multiple_images = ProductImages::where('product_id',$product_id)->get();
        foreach($multiple_images as $multiple_image){
            if($multiple_image->product_multiple_image != 'product_image.jpg');
            $photo_location = 'public/uploads/product/';
            $old_photo_location = $photo_location . $multiple_image->product_multiple_image;
            if($old_photo_location){
                unlink(base_path($old_photo_location));
            }

            $multiple_image->delete();
        }
        // Toastr::success('Data Deleted Successfully!');



       }
       $flag =1;
        // $name = $request->file('product_multiple_image');
       foreach($request->file('product_multiple_image',[]) as $key => $single_image){
        $photo_location = 'public/uploads/product/';
        $new_photo_name = $product_id. '_'.$flag.'.'.$single_image->getClientOriginalExtension();
        $new_photo_location = $photo_location.$new_photo_name ;
        Image::make($single_image)->resize(600,622)->save(base_path($new_photo_location),40);
        ProductImages::create([
           'product_id'=>$product_id,
           'product_multiple_image'=>$new_photo_name,
        ]);
        $flag++;
       }
    }
}
