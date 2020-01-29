<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include("supplier.inc.head")
</head>
<body>
   <div id="app" class="app">
        @include('supplier.inc.nav')
        @include('supplier.inc.header')
        <div class="sidenav">
            @include('supplier.inc.sidenav')
        </div>
        <div class="content">
            @include('supplier.inc.errors')
         
            @yield('content')
        </div>
        @include('supplier.inc.footer')
    </div>
    @include('supplier.inc.footer-scripts')
</body>
</html>