
    <nav id="navbar" class="h-fit md:h-[110px] bg-[#1B4D3E] p-4 ">
        <div class="container  mx-auto flex justify-between items-center md:gap-[1rem] ">
            <div class="flex gap-3 items-center"><img class="h-10 rounded-xl" src="{{asset('assets/images/navbar-logo.png')}}" />
                <h1 class="text-lg font-light text-[#FFDE79]">LMS Dawat-e-Islami</h1>
            </div>

            <button id="menu-toggle"
                class="absolute right-5 top-5 cursor-pointer active:bg-white/10 w-8 h-8 rounded-full text-white md:hidden focus:outline-none">
                <i class="fa-solid fa-bars "></i>
            </button>

            <div id="menu" class="md:flex hidden w-full justify-center">
                <ul class="w-full md:flex md:justify-center md:flex md:space-x-7 space-y-7 md:space-y-0 md:mt-0 mt-4">
                    <li><a href="{{ url('/') }}" class="text-sm font-light text-white/80 hover:text-white">Home</a></li>
                    <li><a href="{{ url('/courses') }}" class="text-sm font-light text-white/80 hover:text-white">Courses</a></li>
                    
                    <li><a href="{{ url('/about-us') }}" class="text-sm font-light text-white/80 hover:text-white">About Us</a></li>
                    <li><a href="{{ url('/contact-us') }}" class="text-sm font-light text-white/80 hover:text-white">Contact Us</a></li>
                    <li><a href="{{ url('/events') }}" class="text-sm font-light text-white/80 hover:text-white">Events</a></li>


                     <!-- Language Dropdown -->
        <li class="md:absolute right-4 top-6 relative">
            <a href="javascript:void(0)" 
                class="border border-white/30 px-4 py-2 rounded-xl text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white"
                id="language-toggle">
                <i class="fa fa-globe"></i> EN <i class="fa fa-angle-down"></i>
            </a>


             @if(@auth()->user()->id)

            <a href="javascript:void(0)"  id="login-id-toggle"
                   class="border border-white/30 px-4 py-2 rounded-xl text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white">
                   <i class="fa fa-user"></i> {{ auth()->user()->name }} <i class="fa fa-angle-down"></i>
                </a>

            @else
                  <a href="{{ url('/login') }}"
                            class="border border-white/30 px-4 py-2 rounded-xl text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white">Login</a>
                        <a href="{{ url('/signup') }}"
                            class="bg-[#FFDE79] px-4 py-2 rounded-xl text-sm font-medium text-stone-900">Register</a>

            @endif

            <!-- Dropdown menu -->
            <div id="language-dropdown" class="dropdown-menu absolute hidden bg-white/10 border border-white/30 rounded-xl mt-2 w-32">
                <ul>
                    <li><a href="javascript:void(0)" class="block px-4 py-1 text-xs text-white hover:bg-white/20">EN</a></li>
                    <li><a href="javascript:void(0)" class="block px-4 py-1 text-xs text-white hover:bg-white/20">UR (Soon)</a></li>
                </ul>
            </div>

             <!-- Dropdown menu -->
            <div id="login-id-dropdown" class=" right-0 dropdown-menu absolute hidden bg-white/10 border border-white/30 rounded-xl mt-2 w-25">
                <ul>
                    <li><a href="{{ url('user-profile/') }}" class="block   px-2 py-1 text-xs text-white hover:bg-white/20">Change Profile</a></li>
                    <li><a href="{{ url('logout/') }}" class="block   px-2 py-1 text-xs text-white hover:bg-white/20">Logout</a></li>
                </ul>
            </div>

        </li>


                </ul>

            </div>
        </div>
    </nav>



    <script type="text/javascript">
        


    // Toggle language dropdown visibility on click
    const languageToggle = document.getElementById('language-toggle');
    const languageDropdown = document.getElementById('language-dropdown');

    languageToggle.addEventListener('click', () => {
        languageDropdown.classList.toggle('hidden');
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', (e) => {
        if (!languageToggle.contains(e.target) && !languageDropdown.contains(e.target)) {
            languageDropdown.classList.add('hidden');
        }
    });



       // Toggle language dropdown visibility on click
    const languageToggle2 = document.getElementById('login-id-toggle');
    const languageDropdown2 = document.getElementById('login-id-dropdown');

    languageToggle2.addEventListener('click', () => {
        languageDropdown2.classList.toggle('hidden');
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', (e) => {
        if (!languageToggle2.contains(e.target) && !languageDropdown2.contains(e.target)) {
            languageDropdown2.classList.add('hidden');
        }
    });

    </script>