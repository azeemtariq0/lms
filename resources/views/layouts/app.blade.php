  {{-- New Scalable Dashboard Design  --}}
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

      {{-- google font (Geist Sans) --}}
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">

      {{-- tailwind and flowbite UI library --}}
      <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
      <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

      {{-- fontawesome icons library --}}
      <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">

      {{-- jquery library --}}
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      {{-- select2 library --}}
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

      {{-- external components and global css --}}
      <link rel="stylesheet" href="{{ asset('assets/admin/css/components.css') }}" type="text/css" />
      <link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}" type="text/css" />

      <meta name="csrf-token" content="{{ csrf_token() }}">

      @yield('pagelevelstyle')

  </head>

  <!-- tailwind classes components -->
  <style type="text/tailwindcss">
      .form-label {
          @apply block ml-2 mb-1 text-sm font-medium text-gray-700 relative;
      }

      .form-label.required::after {
          @apply content-['*'] text-red-500 w-4 h-4 absolute top-0 -left-2;
      }

      .form-input {
          @apply bg-transparent w-full px-3 py-2 text-gray-700 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#023c40]/50 focus:border-transparent transition-all;
      }

      .form-file {
          @apply w-full text-gray-700 file:mr-4 file:py-2 file:px-4 px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#023c40]/10 file:text-[#023c40] hover:file:bg-[#023c40]/20;
      }

      .btn-default {
          @apply px-4 py-2 text-xs font-medium bg-gray-300 rounded-md hover:bg-gray-300/90 focus:outline-none focus:ring-2 focus:ring-[#023c40]/50 focus:ring-offset-2 transition-all duration-200 cursor-pointer;
      }

      .btn-primary {
          @apply px-4 py-2 text-xs font-medium bg-[#023c40] text-white rounded-md hover:bg-[#023c40]/90 focus:outline-none focus:ring-2 focus:ring-[#023c40]/50 focus:ring-offset-2 transition-all duration-200 cursor-pointer;
      }

      .action-danger {
          @apply w-7 h-7 rounded-md p-0 flex items-center justify-center text-sm bg-gray-50 cursor-pointer group-hover:bg-rose-100 transition-all;
      }

      .action-success {
          @apply w-7 h-7 rounded-md p-0 flex items-center justify-center text-sm bg-gray-50 cursor-pointer group-hover:bg-emerald-100 transition-all;
      }
      .action-info {
          @apply w-7 h-7 rounded-md p-0 flex items-center justify-center text-sm bg-gray-50 cursor-pointer group-hover:bg-blue-100 transition-all;
      }

      .form-checkbox {
          @apply w-4 h-4 mr-1 cursor-pointer text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2;
      }

      .form-radio {
          @apply w-4 h-4 mr-1 cursor-pointer text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2;
      }

      .body {
          @apply bg-gradient-to-r from-blue-100 to-red-100 flex flex-col min-h-screen;
      }
  </style>

  <body class="body">

      {{-- loader --}}



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
                  <i class="fa-duotone fa-xmark"></i>
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
                  <i class="fa-duotone fa-xmark"></i>
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
              <span class="loader"></span>
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
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script src="{{ asset('assets/admin/js/app.js') }}"></script>
  <script src="{{ asset('assets/admin/js/components.js') }}"></script>

  @yield('pagelevelscript')

  </html>
