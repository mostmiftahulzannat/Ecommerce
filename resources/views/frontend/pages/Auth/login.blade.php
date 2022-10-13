@extends('frontend.layouts.master')
@section('title', 'cart_page')
@section('frontend-content')
@include('frontend.pages.widgets.bread', ['pagename' => 'Login'])
    <!-- login-area start -->
    <div class="account-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <form action="{{ route('login.store') }}" method="post">
                        @method('post')
                        @csrf
                        <div class="account-form form-style">
                            <p>User Name or Email Address *</p>
                            <input type="email" name="email"
                                class="form-control @error('email')
                    is_invalid
                    @enderror">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p>Password *</p>
                            <input type="Password" name="password" class="form-control @error('password')
                            is_invalid
                            @enderror">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                            {{-- <div class="row">
                                <div class="col-lg-6">
                                    <input id="password" type="checkbox">
                                    <label for="password">Save Password</label>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <a href="#">Forget Your Password?</a>
                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-danger">SIGN IN</button>
                            <div class="text-center">
                                <a href="{{ route('register.page') }}">Or Creat an Account</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- login-area end -->
@endsection
