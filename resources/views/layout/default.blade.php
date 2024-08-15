<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('/assets/')}}" data-template="vertical-menu-template">
<head>
    @include('includes.head')
</head>
<body>
    
  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript> -->

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

