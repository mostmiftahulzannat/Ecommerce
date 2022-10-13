@extends('backend.layouts.master')
@section('title', 'Products_page')

@push('admin_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('admin-content')
    <div class="row">
        <h1>Coupon List</h1>
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <a href="{{ route('coupon.index') }}" class="btn btn-primary"><i class="fas fa-plus-circle">Back tO
                        Coupon</i></a>
            </div>
        </div>
        <div class="cil-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('coupon.update',$coupon->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="coupon-name">Coupon Name</label>
                            <input type="text" name="coupon_name" value="{{ $coupon->coupon_name }}"
                                class="form-control @error('coupon_name')is_invalid @enderror">
                            @error('coupon_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="discount_amount">Discount Amount</label>
                            <input type="number" name="discount_amount" min="0" value="{{ $coupon->discount_amount }}"
                                class="form-control @error('discount_amount')
                      is_invalid
                    @enderror">
                            @error('discount_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="minimum_purchase_amount">Minimum Purchases Amount</label>
                            <input type="number" name="minimum_purchase_amount" min="0" value="{{ $coupon->minimum_purchase_amount }}"
                                class="form-control @error('minimum_purchase_amount')
                    is_invalid
                    @enderror">
                            @error('minimum_purchase_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validity_date">Expire Date</label>
                            <input type="date" name="validity_date" value="{{ $coupon->validity_date }}"
                                class="form-control @error('validity_date')
                    is_invalid
                    @enderror">
                            @error('minimum_purchase_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check form-switch">
                            <input class="form-check-input" name="is_active" type="checkbox" role="switch"
                                id="activeStatus" checked>
                            <label class="form-check-label" for="activeStatus">Active or Inactive</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn btn-success">Update</button>
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
