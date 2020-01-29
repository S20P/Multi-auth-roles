<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
                color: #467fd0;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .m-t-lg {
                margin-top: 60px;
            }
            a:hover {
                color: #467fd0;
            }
        </style>
        @include("FrontEnd.inc.head")
    </head>
    <body>
        <div class="flex-center position-ref full-height">
        @if(!Auth::guard('backpack')->user())
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <!-- <a href="{{ route('login') }}">Login</a> -->
                        <a href="{{ url('/supplier/login') }}">supplier Login</a>
                        <a href="{{ url('/customer/login') }}">customer Login</a>

                        @if (Route::has('register'))
                            <!-- <a href="{{ route('register') }}">Register</a> -->
                            <a href="{{ url('/supplier/register') }}">supplier Register</a>
                            <a href="{{ url('/customer/register') }}">customer Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            @endif
            
            <div class="content">
                <div class="title m-b-md">
                Party Perfect
                </div>

                <div class="links">
                @if(!Auth::guard('backpack')->user())
                    <a href="{{ backpack_url() }}">Admin Login</a>
                 @endif
                </div>

                  <div class="m-t-lg">
                      <!-- * No front-end pages are provided in this demo. Only the admin panel. -->
                </div>
            </div>
        </div>
        @include('FrontEnd.inc.footer-scripts')
    </body>
</html>
