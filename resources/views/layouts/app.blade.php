  <?php
  $page_title = '';
  $title = '';
  $slug = '';
  if (!empty($data)) {
      if (!empty($data['page_management'])) {
          if ($data['page_management']['page_title'] != '') {
              $page_title = $data['page_management']['page_title'];
          }
  
          if ($data['page_management']['slug'] != '') {
              $slug = $data['page_management']['slug'];
          }
  
          if ($data['page_management']['title'] != '') {
              $title = $data['page_management']['title'];
          }
      }
  }
  ?>
  <!DOCTYPE html>
  <html lang="{{ app()->getLocale() }}">

  <head>
      <meta charset="utf-8" />
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <title>LMS</title>
      <meta name="description" content="" />
      <meta name="Author" content="Ghulam Rasool [imgrasool@gmail.com]" />
      <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />


      <link href="{{ asset('assets/admin/plugins/flowbite-3.1.2/css/flowbite.min.css') }}" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-6.7.2/css/all.min.css') }}">

      <script src="{{ asset('assets/admin/plugins/tailwindcss/tailwindcss.min.js') }}"></script>
      <script src="{{ asset('assets/admin/plugins/flowbite-3.1.2/js/flowbite.min.js') }}"></script>
      <script src="{{ asset('assets/admin/plugins/jquery/jquery-3.7.2.min.js') }}"></script>

      <link rel="stylesheet" href="{{ asset('assets/admin/css/components.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}" type="text/css" />

      <meta name="csrf-token" content="{{ csrf_token() }}">

      @yield('pagelevelstyle')

  </head>

  <body class="body">


      {{-- toast alert --}}
      @if ($message = Session::get('success'))
          <div id="alert-success"
              class="z-100 min-w-1/4 fixed top-5 left-1/2 -translate-x-1/2 flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-200  border border-green-500/40 shadow-lg"
              role="alert">
              <div class="flex items-center ml-1 mr-5 text-sm">
                  <i class=" fa-regular fa-check-circle"></i>
                  <div class="ms-3 text-sm font-medium">
                      {{ $message }}
                  </div>
              </div>
              <button type="button"
                  class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-50 cursor-pointer inline-flex items-center justify-center h-8 w-8 "
                  data-dismiss-target="#alert-success" aria-label="Close">
                  <i class="fa-solid fa-xmark"></i>
              </button>
          </div>
      @endif

      {{-- danger toast alert --}}
      @if (count($errors) > 0)
          <div id="alert-danger"
              class="z-100 min-w-1/4 fixed top-5 left-1/2 -translate-x-1/2 flex items-center p-4 mb-4 text-rose-800 rounded-lg bg-rose-200  border border-rose-500/40 shadow-lg"
              role="alert">
              <div class="flex ml-1 mr-5 text-sm font-medium">
                  <div class="w-5 h-5 flex items-center ">
                      <i class="fa-regular fa-xmark-circle"></i>
                  </div>
                  <div>
                      <span class="font-medium">Ensure that these requirements are met:</span>
                      <ul class="mt-1.5 list-disc list-inside">
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>

              </div>
              <button type="button"
                  class="ms-auto -mx-1.5 -my-1.5 bg-rose-100 text-rose-500 rounded-lg focus:ring-2 focus:ring-rose-400 p-1.5 hover:bg-rose-50 cursor-pointer inline-flex items-center justify-center h-8 w-8 "
                  data-dismiss-target="#alert-danger" aria-label="Close">
                  <i class="fa-solid fa-xmark"></i>
              </button>
          </div>
      @endif

      <!-- Navbar -->
      @include('layouts.header')

      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main -->
      <main class="relative flex flex-col pt-16 ml-[256px] transition-all ease-in-out duration-300 h-screen"
          id="mainContent">

          <section class=" flex-1 bg-white/60 backdrop-blur-md border border-gray-300 rounded-lg m-3 mb-0 p-5 px-7">
              {{-- <span class="loader"></span> --}}
              <div class="flex align-center justify-between ">
                  <h1 class="text-xl font-medium">
                      <?php
                      echo $title;
                      ?>
                  </h1>
                  <nav id="breadcrumbs" class="flex items-center justify-end " aria-label="Breadcrumb"></nav>
              </div>
              <div class="block my-3 h-1 border-t border-gray-300">
              </div>
              {{-- Content --}}
              @yield('content')

          </section>
          <!-- footer -->
          @include('layouts.footer')
      </main>
  </body>

  <script src="{{ asset('assets/admin/plugins/jquery/jquery-validate-1.21.0.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/components.js') }}"></script>
  <script src="{{ asset('assets/admin/js/app.js') }}"></script>
  
  @yield('pagelevelscript')


  </html>
