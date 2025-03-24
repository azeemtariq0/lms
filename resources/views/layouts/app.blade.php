  {{-- New Scalable Dashboard Design  --}}
  <?php
  $page_title = '';
  $slug = '';
  if (!empty($data)) {
      if (!empty($data['page_management'])) {
          if ($data['page_management']['page_title'] != '') {
              $page_title = $data['page_management']['page_title'];
          }
  
          if ($data['page_management']['slug'] != '') {
              $slug = $data['page_management']['slug'];
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
          @apply w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#023c40]/10 file:text-[#023c40] hover:file:bg-[#023c40]/20;
      }

      .btn-default {
          @apply px-4 py-2 text-xs font-medium bg-gray-300 rounded-md hover:bg-gray-300/90 focus:outline-none focus:ring-2 focus:ring-[#023c40]/50 focus:ring-offset-2 transition-all duration-200;
      }

      .btn-primary {
          @apply px-4 py-2 text-xs font-medium bg-[#023c40] text-white rounded-md hover:bg-[#023c40]/90 focus:outline-none focus:ring-2 focus:ring-[#023c40]/50 focus:ring-offset-2 transition-all duration-200;
      }

      .action-danger {
          @apply w-7 h-7 rounded-md p-0 flex items-center justify-center text-sm bg-gray-50 cursor-pointer group-hover:bg-rose-100 transition-all;
      }

      .action-success {
          @apply w-7 h-7 rounded-md p-0 flex items-center justify-center text-sm bg-gray-50 cursor-pointer group-hover:bg-emerald-100 transition-all;
      }

      .form-checkbox {
          @apply w-4 h-4 mr-1 cursor-pointer text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2;
      }

      .form-radio {
          @apply w-4 h-4 mr-1 cursor-pointer text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2;
      }
  </style>

  <body class="bg-gradient-to-r from-blue-100 to-red-100 flex flex-col min-h-screen">
      <!-- Navbar -->
      @include('layouts.header')

      <!-- Sidebar -->
      @include('layouts.sidebar')

      <!-- Main -->
      <main class=" flex flex-col pt-16 ml-[256px] transition-all ease-in-out duration-300 h-screen" id="mainContent">

          <section class=" flex-1 bg-white/60 backdrop-blur-md border border-gray-300 rounded-lg m-3 mb-0 p-5 px-7">
              <div class="flex align-center justify-between ">
                  <h1 class="text-2xl font-medium">
                      <?php
                      echo $page_title;
                      ?>
                  </h1>
                  <nav id="breadcrumbs" class="flex items-center justify-end " aria-label="Breadcrumb"></nav>
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
