@extends('backend.layouts.master')
@section('title', 'Edit Products_page')
@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('admin-content')
    <div class="row">
        <h1>Edit Product Form</h1>
        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    <i class="fas fa-backward"></i>
                    Back to Products
                </a>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.update', $products->slug) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class=" col-12 mb-3">
                                <label for="category-name" class="form-label">Select Caegory</label>
                                <select name="category_id" id="category-name" class="form-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($products->category_id == $category->id)
                                            selected
                                            @endif>{{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class=" col-12 mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control " name="product_name" id="" value="{{ $products->product_name }}">
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="product_price" class="form-label">Product Price</label>
                                <input type="number" class="form-control " min="0" name="product_price"
                                    id="" value="{{ $products-> product_price}}">
                                @error('product_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label for="product_code" class="form-label">Product Code</label>
                                <input type="number" class="form-control " name="product_code" id="" value="{{ $products-> product_code}}">
                                @error('product_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label for="product_stock" class="form-label">Product Stock</label>
                                <input type="number" class="form-control " min="0" name="product_stock"
                                    id="" value="{{ $products->product_stock }}">
                                @error('product_stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label for="product_qty" class="form-label">Product Quantity</label>
                                <input type="number" class="form-control " min="1" name="product_qty"
                                    id="" value="{{ $products->product_qty }}">
                                @error('product_qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class=" col-12 mb-3">
                                <label for="short_description" class="form-label">Short Description</label>
                                <input type="text" class="form-control " name="short_description" id="" value="{{ $products->short_description }}">
                                @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class=" col-12 mb-3">
                                <label for="long_description" class="form-label">Long Description</label>
                                <input type="text" class="form-control " name="long_description" id="" value="{{ $products->long_description }}">
                                @error('long_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class=" col-12 mb-3">
                                <label for="additional_info" class="form-label">Additional Information</label>
                                <input type="text" class="form-control " name="additional_info" id="" value="{{ $products->additional_info }}">
                                @error('additional_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="product_image" class="form-label">Product Image</label>
                                <input type="file" class="form-control dropify" name="product_image"  data-default-file="{{ asset('uploads/product') }}/{{ $products->product_image }}">
                                @error('product_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label for="multiple_image" class="form-label">Multiple Image</label>
                                <input type="file" name="product_multiple_image[]"  Multiple id="" class="form-control">
                                @error('product_multiple_image')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-success">update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush
