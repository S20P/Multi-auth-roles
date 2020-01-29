<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include("customer.inc.head")
</head>
<body>
   <div id="app" class="app">
        @include('customer.inc.nav')
        @include('customer.inc.header')
        <div class="sidenav">
            @include('customer.inc.sidenav')
        </div>
        <div class="content">
            @include('customer.inc.errors')
         
            @yield('content')
        </div>
        @include('customer.inc.footer')
    </div>
    @include('customer.inc.footer-scripts')
</body>
</html>