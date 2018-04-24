<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{ $title }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Mohamed Zayed" name="author" />
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="{{asset('backend/base/css/main.min.css')}}" rel="stylesheet" type="text/css" />
        <style media="screen">
            .required::after { content:"*"; color: #f4516c; }
        </style>
        @yield('styles')
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">

        <!-- BEGIN HEADER -->
        @include('backend.theme.includes.header')
        <!-- END HEADER -->

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->


        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            @include('backend.theme.includes.sidebar')
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">

                    @if (count($errors->all()) > 0)
                        <div class="note note-danger">
                            <ul>
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->

        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> {{ date('Y') }} &copy; Developed By
                <a target="_blank" href="https://www.facebook.com/mohamed.zayed709">@@Mohamed Zayed</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->

        <!--[if lt IE 9]>
        <script src="{{asset('backend/assets/global/plugins/respond.min.js')}}"></script>
        <script src="{{asset('backend/assets/global/plugins/excanvas.min.js')}}"></script>
        <script src="{{asset('backend/assets/global/plugins/ie8.fix.min.js')}}"></script>
        <![endif]-->

        <script src="{{asset('backend/base/js/main.min.js')}}" type="text/javascript"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            });

            function select_all() {
                $('input[class=selected_data]:checkbox').each(function(){
                    if($('input[class=select-all]:checkbox:checked').length == 0){
                        $(this).prop("checked", false);
                    } else {
                        $(this).prop("checked", true);
                    }
                });
            }
        </script>

        @include('backend.theme.includes.messages')

        @yield('scripts')
    </body>
</html>
