  <?php 
$page_title = "";
$slug = "";
if(!empty($data)){
    if(!empty($data['page_management'])){
        if($data['page_management']['page_title'] != ""){
            $page_title = $data['page_management']['page_title']; 
        }

        if($data['page_management']['slug'] != ""){
            $slug = $data['page_management']['slug']; 
        }

    }
}
?>
<!doctype html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>LMS</title>
        <meta name="description" content="" />
        <meta name="Author" content="Ghulam Rasool [imgrasool@gmail.com]" />

        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

        <!-- WEB FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

        <!-- CORE CSS -->
        <link href="{{ asset('assets/admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/plugins/bootstrap.datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- THEME CSS -->
        <link href="{{ asset('assets/admin/css/essentials.css?v=1.2') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/css/layout.css?v=1.2') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/plugins/toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/css/color_scheme/green.css') }}" rel="stylesheet" type="text/css" id="color_scheme" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Call Jquery -->
        <script type="text/javascript" src="{{ asset('assets/admin/plugins/jquery/jquery-2.1.4.min.js')}}"></script>


        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script type="text/javascript" src="{{ asset('assets/admin/plugins/toastr/toastr.js')}}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/plugins\sweetAlert\sweetalert.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/plugins\bootstrap.datepicker/js/bootstrap-datepicker.min.js')}}"></script>
       <script src="{{ asset('assets/admin/plugins/jquery/jquery-validate.min.js') }}"></script>


        @yield('pagelevelstyle')
    </head>
    <!--
        .boxed = boxed version
    -->
    <body>


        <!-- WRAPPER -->
        <div id="wrapper" class="clearfix">

            <!-- ASIDE 
            Keep it outside of #wrapper (responsive purpose)
        -->
        @include('layouts.sidebar')
        <!-- /ASIDE -->

        <!-- HEADER -->
        @include('layouts.header')
        <!-- /HEADER -->

        <!-- MIDDLE -->


            <section id="middle">

              <!-- page title -->
              <header id="page-header" style="margin-top: 55px !important;">
                <h1>

                    <?php 
                    echo $page_title;
                ?>
            @if(Request::segment(2)!='')
                <a href="{{url('/').'/'.\Request::segment(1)}}" class="btn btn-default" style="float: right;"><i class="fa fa-undo"></i> Back</a>
                @endif

            </h1>
                <ol class="breadcrumb">
                    <li><a href="{{url('/').'/admin/'.\Request::segment(2)}}">{{ucfirst(\Request::segment(2));}}</a></li>
                    @if(!empty($slug))
                    <li class="active">{{ucfirst($slug);}} </li>
                    @endif


                      
                </ol>

            </header>
            <!-- /page title -->

            @yield('content')
            <!-- /MIDDLE -->
        </section>


<!-- overlay -->

<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>

    </div>




    <!-- JAVASCRIPT FILES -->
    <!--     <script type="text/javascript">var plugin_path = 'assets/admin/plugins/';</script> -->
    <script type="text/javascript">var plugin_path = "{{ URL::asset('assets/admin/plugins/') }}/";</script>
    <!-- <script type="text/javascript" src="{{ asset('assets/admin/plugins/jquery/jquery-2.1.4.min.js')}}"></script> -->
    <script type="text/javascript" src="{{ asset('assets/admin/js/app.js?v=1.1') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/custom.js?v=1.1') }}"></script>
    <!-- STYLESWITCHER - REMOVE -->
    <!-- <script async type="text/javascript" src="{{ asset('assets/admin/plugins/styleswitcher/styleswitcher.js') }}"></script> -->
    <script>
        
        function datepicker (){
            $('.datepicker').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true
            });    
         } 
         datepicker();

        $('.web-select2').select2();

        $(document).ajaxSend(function() {
           $("#overlay").fadeIn(300);　
        });

        $(document).ajaxStop(function() {
          $("#overlay").fadeOut(300);　
        });

        $(document).on('change','#change-permission',function (argument) {
            $.ajax({
                url:'<?php echo url('admin/change-permission') ?>',
                type:'post',
                data:{'permission_id':$(this).val(),"_token": "{{ csrf_token() }}"},
                success:function(){
                    location.reload();
                }
            });
        });
        

    </script>
    @yield('pagelevelscript')
</body>
</html>