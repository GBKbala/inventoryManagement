<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('/assets/')}}" data-template="vertical-menu-template">
<head>
    @include('includes.head')
</head>
<body>
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            @include('includes.sidebar')

            <div class="layout-page">
                @include('includes.header')

                <div class="content-wrapper">
                    @yield('content')
                </div>
            
            </div>
        </div>
    </div>
    <footer>
        @include('includes.footer')
    </footer>
    @yield('scripts')
</body>
</html>

