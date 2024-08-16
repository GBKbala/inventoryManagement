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
    <script>
        function showToastr(type, message) {
            toastr[type](message, null, {
                onclick: function() {
                    toastr.clear();
                },
                timeOut: 3000,
                "closeButton": true,
                "progressBar": true,
            });
        }

        $(document).ready(function() {

            @if(Session::has('success'))
                showToastr('success', '{{ Session::get('success') }}');
            @endif

            @if(Session::has('error'))
                showToastr('error', '{{ Session::get('error') }}');
            @endif
        });
    </script>
    @yield('scripts')
</body>
</html>

