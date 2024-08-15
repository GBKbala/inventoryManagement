<!DOCTYPE html>
<html lang="en">
<head>
   @include('includes.head')
</head>
<body>
    <!-- <div id="global-loader">
        <div class="whirly-loader"></div>
    </div> -->
    <div class="main-wrapper">
        @include('includes.header')
        @include('includes.sidebar')
    
        <div class="page-wrapper">
            @yield('content')
        </div>
   </div>
   <footer>
        @include('includes.footer')
    </footer>
</body>