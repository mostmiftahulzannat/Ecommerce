@extends('frontend.layouts.master')
@section('title', 'cart_page')
@section('frontend-content')
@include('frontend.pages.widgets.bread', ['pagename' => 'Customer Dashboard'])
<div class="col-lg-12 col-md-12 m-auto" >
    <div class="card">
        <div class="card-header tx-white bg-teal">
            <h4 class="card-title tx-white">Customer Name : {{ $user->name }}</h4>
        </div>
        <div class="card-body ">
        </div>
    </div>
</div>
@endsection
