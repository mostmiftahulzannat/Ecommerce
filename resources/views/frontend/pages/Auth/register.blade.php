@extends('frontend.layouts.master')
@section('title', 'cart_page')
@section('frontend-content')
@include('frontend.pages.widgets.bread', ['pagename' => 'Register'])
    <!-- checkout-area start -->
    <div class="account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="account-form form-style">
                        <form action="{{ route('register.store') }}" method="post">
                            @csrf
                            <div class="account-form">
                                <label for="name">Name</label>
                                <input type="text" name="name "
                                    class="form-control @error('name')
                            is_invaalid
                            @enderror">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="account-form">
                                <label for="email">Email</label>
                                <input type="text" name="email "
                                    class="form-control @error('email')
                            is_invaalid
                            @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="account-form">
                                <label for="phone">phone</label>
                                <input type="number" name="phone "
                                    class="form-control @error('phone')
                            is_invaalid
                            @enderror">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="account-form">
                                <label for="passowrd">passowrd</label>
                                <input type="password" name="passowrd "
                                    class="form-control @error('passowrd')
                            is_invaalid
                            @enderror">
                                @error('passowrd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="account-form">
                                <label for="confirm_passowrd">passowrd</label>
                                <input type="password" name="confirm_passowrd "
                                    class="form-control @error('confirm_passowrd')
                            is_invaalid
                            @enderror">
                                @error('confirm_passowrd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Register</button>
                            <div class="text-center"><a href="{{ route('login.page') }}">LogIn</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- checkout-area end -->
@endsection
