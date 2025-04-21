<!doctype html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LMS</title>
    <meta name="Author" content="Ghulam Rasool [imgrasool@gmail.com]" />

    <!-- mobile settings -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <link href="{{ asset('assets/admin/plugins/flowbite-3.1.2/css/flowbite.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-6.7.2/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/components.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}" type="text/css" />

    <script src="{{ asset('assets/admin/plugins/tailwindcss/tailwindcss.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/flowbite-3.1.2/js/flowbite.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jquery/jquery-3.7.2.min.js') }}"></script>


    <!--  -->


</head>
<!--
        .boxed = boxed version
    -->

<body style="background-image:url('../assets/images/about-section.png'); background-size:cover;">

        @yield('content')
        

</body>
<script src="{{ asset('assets/admin/plugins/jquery/jquery-validate-1.21.0.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/components.js') }}"></script>
<script src="{{ asset('assets/admin/js/app.js') }}"></script>

</html>
