<!DOCTYPE html>
<html lang="en" data-footer="true"
    data-override='{"attributes": {"placement": "vertical", "layout": "boxed" }, "storagePrefix": "ecommerce-platform"}'>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Ecoms @yield('title')</title>
    <meta name="description" content="Ecommerce Dashboard" />
    @include('backend.layouts.include.style')
    @include('frontend.layouts.include.style')
</head>

<body>
    <div id="root">
        <div id="nav" class="nav-container d-flex">
            <div class="nav-content d-flex">
                @include('backend.layouts.include.logo')
                @include('backend.layouts.include.user-menu')
                @include('backend.layouts.include.menu')
                <!-- Mobile Buttons Start -->
                <div class="mobile-buttons-container">
                    <!-- Menu Button Start -->
                    <a href="#" id="mobileMenuButton" class="menu-button">
                        <i data-cs-icon="menu"></i>
                    </a>
                    <!-- Menu Button End -->
                </div>
                <!-- Mobile Buttons End -->
            </div>
            <div class="nav-shadow"></div>
        </div>

        <main>
            <div class="container">
                @yield('admin-content')
            </div>
        </main>

    </div>
    @include('backend.layouts.include.script')
</body>

</html>
