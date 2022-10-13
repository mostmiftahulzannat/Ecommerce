
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>honeyed @yield('frontendtitle')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('frontend.layouts.include.style')
</head>

<body>
    <!--Start Preloader-->
    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div>
 @include('frontend.layouts.include.search')

@include('frontend.layouts.include.header')


@yield('frontend-content')
@include('frontend.layouts.include.newslatter')

 @include('frontend.layouts.include.footer')

@include('frontend.layouts.include.modal')

@include('frontend.layouts.include.script')
</body>


<!-- Mirrored from themepresss.com/tf/html/tohoney/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Mar 2020 03:33:34 GMT -->
</html>
