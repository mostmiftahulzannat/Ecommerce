@extends('frontend.layouts.master')
@section('frontendtitle')
Home Page
@endsection


@section('frontend-content')
@include('frontend.pages.widgets.slider')
@include('frontend.pages.widgets.feature')
@include('frontend.pages.widgets.countdown')
@include('frontend.pages.widgets.bestseller-product')
@include('frontend.pages.widgets.latest-product')
@include('frontend.pages.widgets.testmonial')
@endsection



