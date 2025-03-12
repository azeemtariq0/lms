<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- tailwind link -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <!-- fontawesome link -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">

    <!-- geist font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">

    <!-- jquery link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('assets/web/dist/css/style.css') }}">
    <!-- slider library -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>

<body>

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
                    <li class="md:absolute right-4 top-6">


                        <a href="{{ url('/login') }}"
                            class="border border-white/30 px-4 py-2 rounded-xl text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white"><i class="fa fa-globe"></i> EN</a>

                    @if(@auth()->user()->id)

                        <a href="{{ url('user-profile') }}"
                            class="border border-white/30 px-4 py-2 rounded-xl text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white"><i class="fa fa-user"></i></a>

                   @else
                        <a href="{{ url('/login') }}"
                            class="border border-white/30 px-4 py-2 rounded-xl text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white">Login</a>
                        <a href="{{ url('/signup') }}"
                            class="bg-[#FFDE79] px-4 py-2 rounded-xl text-sm font-medium text-stone-900">Register</a>
                    </li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>


<div class="h-[75px] md:h-[110px]">

    </div>
   <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="{{ asset('assets/images/slide-01.png') }}" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/images/slide-02.jpg') }}" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/images/slide-03.jpg') }}" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/images/slide-04.jpg') }}" alt=""></div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>

 <section class="py-30">
        <div class="container mx-auto px-4">
            <div class="lg:flex lg:items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0">
                    <img src="{{ asset('assets/images/about-section.png') }}" alt="Our Team"
                        class="rounded-lg shadow-lg w-full transition-transform transform hover:scale-105 duration-300">
                </div>
                <div class="lg:w-1/2 lg:pl-16">
                    <p class="text-sm font-semibold text-[#1b4d3e]">Introduction</p>
                    <h2 class="text-4xl font-bold text-stone-900 mb-6 relative">
                        LMS Dawat-e-Islami
                        <span class="absolute bottom-0 left-0 w-16 h-1 bg-[#1b4d3e] rounded-full"></span>
                    </h2>
                    <p class="text-gray-600 mb-2 leading-relaxed">
                        The Organizational Courses, an integral part of the Pakistan Mushawart Office Department, We are
                        pleased to introduce our new virtual training programs, which utilize an intuitive application
                        and an advanced Learning Management System.
                        <br><br> These courses are offered free of charge and are
                        designed to address the Religious (Shariah), Organizational, and Technical training needs of
                        preachers, personnel, and officials worldwide.

                    </p>
                    <div class="text-[#1b4d3e] mb-8 font-medium">Launching Date : September 2, 2024</div>
                    <div class="flex flex-wrap gap-4">
                        <a href="#"
                            class="bg-[#FFDE79] border border-[#1b4d3e] text-stone-900 py-3 px-6 rounded-full flex items-center gap-2">
                            Learn More <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="#"
                            class="border border-[#1b4d3e] text-[#1b4d3e] font-medium py-3 px-6 rounded-full flex items-center gap-2">
                            Contact Us <i class="fa-solid fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-30 text-center relative bg-[#FFDE79] p-10 rounded-3xl border border-[#1b4d3e]">
                <h2 class="text-4xl  font-bold text-stone-900 mb-8 relative z-10">Our Impact at a Glance</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative z-10">
                    <div class="p-8 rounded-2xl bg-white border border-[#1b4d3e] relative overflow-hidden">
                        <div class="absolute inset-0 rounded-2xl"></div>
                        <i class="fa-regular fa-user-graduate text-5xl text-[#1B4D3E] mb-4 relative z-10"></i>
                        <h4 class="text-3xl font-bold text-gray-900 mb-2 relative z-10 animate-count" data-target="413">
                            +</h4>
                        <p class="text-gray-700 relative z-10">Number of Enrollments</p>
                    </div>
                    <div class="p-8 rounded-2xl bg-white border border-[#1b4d3e] relative overflow-hidden">
                        <div class="absolute inset-0  rounded-2xl"></div>
                        <i class="fa-regular fa-check-circle text-5xl text-teal-600 mb-4 relative z-10"></i>
                        <h4 class="text-3xl font-bold text-gray-900 mb-2 relative z-10 animate-count" data-target="53">+
                        </h4>
                        <p class="text-gray-700 relative z-10">Number of Completed</p>
                    </div>
                    <div class="p-8 rounded-2xl bg-white border border-[#1b4d3e] relative overflow-hidden">
                        <div class="absolute inset-0  rounded-2xl"></div>
                        <i class="fa-regular fa-book-open text-5xl text-green-600 mb-4 relative z-10"></i>
                        <h4 class="text-3xl font-bold text-gray-900 mb-2 relative z-10 animate-count" data-target="5">+
                        </h4>
                        <p class="text-gray-700 relative z-10">Number of Courses</p>
                    </div>
                    <div class="p-8 rounded-2xl bg-white border border-[#1b4d3e] relative overflow-hidden">
                        <div class="absolute inset-0  rounded-2xl"></div>
                        <i class="fa-regular fa-chalkboard-teacher text-5xl text-yellow-600 mb-4 relative z-10"></i>
                        <h4 class="text-3xl font-bold text-gray-900 mb-2 relative z-10 animate-count" data-target="4">+
                        </h4>
                        <p class="text-gray-700 relative z-10">Number of Tutors</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="pb-30">
        <div class="container mx-auto px-4">
            <p class="text-sm font-semibold text-[#1b4d3e]">LMS</p>
            <h2 class="text-4xl font-bold text-stone-900 mb-6 relative">
                Our Featured Courses
                <span class="absolute bottom-0 left-0 w-16 h-1 bg-[#1b4d3e] rounded-full"></span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden card-transition hover:shadow-lg hover:shadow-[#FFDE79] hover:transform hover:-translate-y-2">
                    <img src="{{ asset('assets/images/post-01.jpg') }}" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">UC Nigran Course</h3>
                        <p class="text-gray-600 mb-4">Haji Muhammad Shahid Attari</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500"><i class="fa-solid fa-clock mr-1"></i> 12 Weeks</span>
                            <a href="#"
                                class="bg-[#FFDE79] border border-[#1b4d3e] text-stone-900 py-2 px-4 text-sm rounded-full flex items-center gap-2">
                                Enroll now
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden card-transition hover:shadow-lg hover:shadow-[#FFDE79] hover:transform hover:-translate-y-2">
                    <img src="{{ asset('assets/images/post-02.jpg') }}" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">12 Deeni Kaam Islamic Brother</h3>
                        <p class="text-gray-600 mb-4">Haji Muhammad Shahid Attari</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500"><i class="fa-solid fa-clock mr-1"></i> 8 Weeks</span>
                            <a href="#"
                                class="bg-[#FFDE79] border border-[#1b4d3e] text-stone-900 py-2 px-4 text-sm rounded-full flex items-center gap-2">
                                Enroll now
                            </a>
                        </div>
                    </div>
                </div>


                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden card-transition hover:shadow-lg hover:shadow-[#FFDE79] hover:transform hover:-translate-y-2">
                    <img src="{{ asset('assets/images/post-03.jpg') }}" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Itikaf Course</h3>
                        <p class="text-gray-600 mb-4">Haji Muhammad Shahid Attari</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500"><i class="fa-solid fa-clock mr-1"></i> 10 Weeks</span>
                            <a href="#"
                                class="bg-[#FFDE79] border border-[#1b4d3e] text-stone-900 py-2 px-4 text-sm rounded-full flex items-center gap-2">
                                Enroll now
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex justify-center pt-8 w-full">
                <a href="#"
                    class="bg-[#FFDE79] border border-[#1b4d3e] text-stone-900 py-3 px-6 rounded-full flex items-center gap-2">
                    Show All Courses <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
    <section id="upcoming-events" class="pb-30 px-13">
        <div class="container mx-auto">
            <div class=" flex justify-center">
                <div class="relative">
                    <h2 class="text-4xl font-bold mb-12 text-stone-900 ">Upcoming Events</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 340 85" fill="none" svg="animated"
                        class="testi-arrow absolute top-0 -right-20 w-[80%] -z-10">
                        <path
                            d="M124.828 4.59888C169.229 9.92943 213.631 16.4339 226.361 37.5468C244.064 66.8985 104.053 89.9727 42.2616 68.2072C-118.59 11.5502 261.312 -12.1056 249.479 47.5269C240.224 94.1576 -7.80185 73.4384 28.2422 27.3184C35.7437 17.725 76.6543 7.90018 121.293 4.82427C171.88 -1.7839 284.375 5.075 328.375 81.875L299.875 79.6244L330.68 82.7494L337.43 57.6243"
                            stroke="#FFDE79" stroke-width="4" stroke-miterlimit="10" class="path-2"
                            style="stroke-dashoffset: 0px; stroke-dasharray: 1300.05;"></path>
                    </svg>
                </div>
            </div>
            <ul class="space-y-4">

                <li class="event-item flex items-center justify-between">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#1B4D3E] mr-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <h3 class="text-xl font-semibold text-stone-900">Itikaf Course</h3>
                            <p class="text-sm text-stone-700">14 February, 2025 - Online</p>
                            <div class="event-details mt-2">
                                <p class="text-gray-500 text-sm">Learn the latest web development techniques and build
                                    your own projects.</p>
                                <a href="#"
                                    class="mt-2 inline-block bg-[#1B4D3E] text-white py-2 px-4 rounded-full text-sm">Register
                                    Now</a>
                            </div>
                        </div>
                    </div>
                    <span class="text-sm text-stone-600">Itikaf Course (Batch 1)</span>
                </li>

                <li class="event-item flex items-center justify-between">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500 mr-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.042A8.967 8.967 0 006 11c0 5.108 3.825 9.436 8.718 9.958.834.086 1.668.172 2.5.172 2.175 0 4.153-1.593 4.749-3.905A5.972 5.972 0 0018 11a8.963 8.963 0 00-6-4.958z" />
                        </svg>
                        <div>
                            <h3 class="text-xl font-semibold text-stone-900">Fundraising Course</h3>
                            <p class="text-sm text-stone-700">20 February, 2025 - Physical, City Hall</p>
                            <div class="event-details mt-2">
                                <p class="text-gray-500 text-sm">Explore the world of data science and learn how to
                                    analyze and visualize data.</p>
                                <a href="#"
                                    class="mt-2 inline-block bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-full text-sm">Learn
                                    More</a>
                            </div>
                        </div>
                    </div>
                    <span class="text-sm text-stone-600">Fundraising Course (Batch 1)</span>
                </li>


            </ul>
        </div>
    </section>

<footer class="bg-[#1B4D3E] text-white py-5">
        <div class="container mx-auto grid md:grid-cols-3">
            <div class="mb-6 md:mb-0">
                <div class="flex gap-3 justify-center md:justify-start items-center"><img class="h-8 rounded-lg"
                        src="{{asset('assets/images/navbar-logo.png')}}" />
                    <h1 class="text-lg font-light text-[#FFDE79]">LMS Dawat-e-Islami</h1>
                </div>

            </div>
            <div class="flex flex-col md:justify-center items-center md:flex-row space-y-4 md:space-y-0 md:space-x-8">
                <a href="#" class="text-sm font-light text-white/80 hover:text-white">Home</a>
                <a href="#" class="text-sm font-light text-white/80 hover:text-white">Courses</a>
                <a href="#" class="text-sm font-light text-white/80 hover:text-white">About Us</a>
                <a href="#" class="text-sm font-light text-white/80 hover:text-white">Contact Us</a>
                <a href="#" class="text-sm font-light text-white/80 hover:text-white">Events</a>
            </div>
            <div class="w-full flex items-center justify-center space-x-4 mt-6 md:mt-0 ">
                <a href="#" class=" text-sm font-light text-white/80 hover:text-white">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </a>
                <a href="#" class=" text-sm font-light text-white/80 hover:text-white">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                    </svg>
                </a>
                <a href="#" class=" text-sm font-light text-white/80 hover:text-white">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="container mx-auto mt-4 text-center ">
            <p class="text-sm">&copy; 2023 Your Company. All rights reserved.</p>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const countElements = document.querySelectorAll('.animate-count');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = parseInt(entry.target.dataset.target);
                        let count = 0;
                        const increment = Math.ceil(target / 200); // Adjust speed here

                        const updateCount = () => {
                            if (count < target) {
                                count += increment;
                                entry.target.textContent = count + '+';
                                requestAnimationFrame(updateCount);
                            } else {
                                entry.target.textContent = target + '+';
                            }
                        };
                        updateCount();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 }); // Trigger when 50% of the element is visible

            countElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>

<script type="text/javascript" src="{{ asset('assets/web/dist/js/app.js') }}"></script>
</body>
</html>