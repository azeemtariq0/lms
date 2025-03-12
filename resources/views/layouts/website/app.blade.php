   @include('layouts.website.header')

   <!-- WRAPPER -->
        <div id="wrapper" class="clearfix">

            <!-- ASIDE 
            Keep it outside of #wrapper (responsive purpose)
        -->
     
        @include('layouts.website.navigation-bar')

        <div class="h-[75px] md:h-[110px]"></div>
        @yield('content')


        @include('layouts.website.footer')
