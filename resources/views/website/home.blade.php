@extends('../layouts.website.app')


@section('content')


    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @if (count($banners) != 0)
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <img src="{{ asset($banner->path) }}" alt="">
                    </div>
                @endforeach
            @else
                <div class="swiper-slide"><img src="{{ asset('assets/images/slide-01.png') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('assets/images/slide-02.jpg') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('assets/images/slide-03.jpg') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('assets/images/slide-04.jpg') }}" alt=""></div>
            @endif
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
                    <p class="text-sm font-semibold text-[#1b4552]">Introduction</p>
                    <h2 class="text-4xl font-bold text-stone-900 mb-6 relative">
                        LMS Dawat-e-Islami
                        <span class="absolute bottom-0 left-0 w-16 h-1 bg-[#1b4552] rounded-full"></span>
                    </h2>
                    <p class="text-gray-600 mb-2 leading-relaxed">
                        The Organizational Courses, an integral part of the Pakistan Mushawart Office Department, We are
                        pleased to introduce our new virtual training programs, which utilize an intuitive application
                        and an advanced Learning Management System.
                        <br><br> These courses are offered free of charge and are
                        designed to address the Religious (Shariah), Organizational, and Technical training needs of
                        preachers, personnel, and officials worldwide.

                    </p>
                    <div class="text-[#1b4552] mb-8 font-medium">Launching Date : September 2, 2024</div>
                    <div class="flex flex-wrap gap-4">
                        <a href="#"
                            class="bg-[#d1dbe4] border border-[#1b4552] text-stone-900 py-3 px-6 rounded-full flex items-center gap-2">
                            Learn More <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="#"
                            class="border border-[#1b4552] text-[#1b4552] font-medium py-3 px-6 rounded-full flex items-center gap-2">
                            Contact Us <i class="fa-solid fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-30 text-center relative bg-[#d1dbe4]/60 p-10 lg:p-20 rounded-2xl ">
                <h2 class="text-4xl  font-bold text-stone-900 mb-8 relative z-10">Our Impact at a Glance</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative z-10">
                    <div class="p-8 rounded-xl bg-white relative overflow-hidden">
                        <i class="fa-solid fa-user-graduate text-7xl text-[#1b4552] mb-4 relative z-10"></i>
                        <h4 class="text-5xl my-5 font-bold text-gray-900 mb-2 relative z-10 animate-count"
                            data-target="413">
                            +</h4>
                        <p class="text-gray-700 mt-5 relative z-10">Number of Enrollments</p>
                    </div>
                    <div class="p-8 rounded-xl bg-white relative overflow-hidden">
                        <i class="fa-solid fa-check-circle text-7xl text-teal-600 mb-4 relative z-10"></i>
                        <h4 class="text-5xl my-5 font-bold text-gray-900 mb-2 relative z-10 animate-count" data-target="53">
                            +
                        </h4>
                        <p class="text-gray-700 mt-5 relative z-10">Number of Completed</p>
                    </div>
                    <div class="p-8 rounded-xl bg-white relative overflow-hidden">
                        <i class="fa-solid fa-book-open text-7xl text-green-600 mb-4 relative z-10"></i>
                        <h4 class="text-5xl my-5 font-bold text-gray-900 mb-2 relative z-10 animate-count" data-target="5">
                            +
                        </h4>
                        <p class="text-gray-700 mt-5 relative z-10">Number of Courses</p>
                    </div>
                    <div class="p-8 rounded-xl bg-white relative overflow-hidden">
                        <i class="fa-solid fa-chalkboard-teacher text-7xl text-yellow-600 mb-4 relative z-10"></i>
                        <h4 class="text-5xl my-5 font-bold text-gray-900 mb-2 relative z-10 animate-count" data-target="4">
                            +
                        </h4>
                        <p class="text-gray-700 mt-5 relative z-10">Number of Tutors</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="pb-30">
        <div class="container mx-auto px-4">
            <p class="text-sm font-semibold text-[#1b4552]">LMS</p>
            <h2 class="text-4xl font-bold text-stone-900 mb-6 relative">
                Our Featured Courses
                <span class="absolute bottom-0 left-0 w-16 h-1 bg-[#1b4552] rounded-full"></span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden card-transition hover:shadow-lg hover:shadow-[#d1dbe4] hover:transform hover:-translate-y-2">
                    <img src="{{ asset('assets/images/post-01.jpg') }}" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">UC Nigran Course</h3>
                        <p class="text-gray-600 mb-4">Haji Muhammad Shahid Attari</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500"><i class="fa-solid fa-clock mr-1"></i> 12 Weeks</span>
                            <a href="#"
                                class="bg-[#d1dbe4] border border-[#1b4552] text-stone-900 py-2 px-4 text-sm rounded-full flex items-center gap-2">
                                Enroll now
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden card-transition hover:shadow-lg hover:shadow-[#d1dbe4] hover:transform hover:-translate-y-2">
                    <img src="{{ asset('assets/images/post-02.jpg') }}" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">12 Deeni Kaam Islamic Brother</h3>
                        <p class="text-gray-600 mb-4">Haji Muhammad Shahid Attari</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500"><i class="fa-solid fa-clock mr-1"></i> 8 Weeks</span>
                            <a href="#"
                                class="bg-[#d1dbe4] border border-[#1b4552] text-stone-900 py-2 px-4 text-sm rounded-full flex items-center gap-2">
                                Enroll now
                            </a>
                        </div>
                    </div>
                </div>


                <div
                    class="bg-white rounded-2xl shadow-md overflow-hidden card-transition hover:shadow-lg hover:shadow-[#d1dbe4] hover:transform hover:-translate-y-2">
                    <img src="{{ asset('assets/images/post-03.jpg') }}" alt="Course Image" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Itikaf Course</h3>
                        <p class="text-gray-600 mb-4">Haji Muhammad Shahid Attari</p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500"><i class="fa-solid fa-clock mr-1"></i> 10 Weeks</span>
                            <a href="#"
                                class="bg-[#d1dbe4] border border-[#1b4552] text-stone-900 py-2 px-4 text-sm rounded-full flex items-center gap-2">
                                Enroll now
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex justify-center pt-8 w-full">
                <a href="#"
                    class="bg-[#d1dbe4] border border-[#1b4552] text-stone-900 py-3 px-6 rounded-full flex items-center gap-2">
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 340 85" fill="none"
                        svg="animated" class="testi-arrow absolute top-0 -right-20 w-[80%] -z-10">
                        <path
                            d="M124.828 4.59888C169.229 9.92943 213.631 16.4339 226.361 37.5468C244.064 66.8985 104.053 89.9727 42.2616 68.2072C-118.59 11.5502 261.312 -12.1056 249.479 47.5269C240.224 94.1576 -7.80185 73.4384 28.2422 27.3184C35.7437 17.725 76.6543 7.90018 121.293 4.82427C171.88 -1.7839 284.375 5.075 328.375 81.875L299.875 79.6244L330.68 82.7494L337.43 57.6243"
                            stroke="#d1dbe4" stroke-width="4" stroke-miterlimit="10" class="path-2"
                            style="stroke-dashoffset: 0px; stroke-dasharray: 1300.05;"></path>
                    </svg>
                </div>
            </div>
            <ul class="space-y-4">

                <li class="event-item flex items-center justify-between">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#1b4552] mr-4" fill="none"
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
                                    class="mt-2 inline-block bg-[#1b4552] text-white py-2 px-4 rounded-full text-sm">Register
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




@endsection