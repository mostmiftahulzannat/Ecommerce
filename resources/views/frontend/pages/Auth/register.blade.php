@extends('frontend.layouts.master')
@section('title', 'cart_page')
@section('frontend-content')
@include('frontend.pages.widgets.bread', ['pagename' => 'Register'])
<!-- checkout-area start -->
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <form action="{{ route('register.store') }}" method="post">
                    @csrf
                <div class="account-form form-style">
                    <p>User Name *</p>
                    <input type="text" name="name">
                    <p>Email *</p>
                    <input type="email" name="email">
                    <p>phone *</p>
                    <input type="tel" name="phone">
                    <p>Password *</p>
                    <input type="Password" name="password">
                    <p>Confirm Password *</p>
                    <input type="Password" name="password_confirmation">
                    <button>Register</button>
                    <div class="text-center">
                        <a href="{{ route('login.page') }}">Or Login</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection
