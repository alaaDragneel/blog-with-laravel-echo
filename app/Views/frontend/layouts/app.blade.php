<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Blogger</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Site Description Here">
        <link href="{{ asset('frontend/css/main.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style media="screen">
            .social-button {
                    font-size: 46px;
            }
            .article__share li {
                display: inline-block;
                float: none;
                margin-right: 20px;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <a id="start"></a>


            @include('frontend.includes.top-header')

            <search-form></search-form>

            @include('frontend.includes.navbar')

            <div class="main-container">
                @yield('content')

                @include('frontend.includes.footer')
            </div>
            
            @auth
                {{--
                    Please Becarful We Send user_id by binding It like That :user_id insted of user_id 
                    Because We Need The Id To Be An Integer For The Realtime checks 
                    So Don't Play Around Here and Go Away :) 
                --}}
                <flash :user_id="{{ auth()->id() }}" message="{{ session('success') }}"></flash>   
            @endauth

            <a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
                <i class="stack-interface stack-up-open-big"></i>
            </a>
        

        </div>

        <script src="{{ asset('frontend/js/main.min.js') }}"></script>
        <script src="{{ asset('frontend/js/app.min.js') }}"></script>
        <script src="{{ asset('js/share.js') }}"></script>
    </body>
</html>
