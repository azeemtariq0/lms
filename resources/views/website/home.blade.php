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
                        <a  href="{{ url('/contact-us') }}"
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
            <!-- Course Cards Grid -->
            <div id="courses" class="mb-10 grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 p-4 max-w-7xl mx-auto">

                @foreach ($courses as $course)
                    <div
                        class="course-card translate-y-[20px] opacity-0 h-fit group relative  border border-gray-200 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">

                        <!-- Image with dark overlay -->
                        <div class="relative">
                            <img src="{{ asset('/uploads/courses/' . $course['image']) }}"
                                alt="{{ $course['course_name'] }}" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 group-hover:bg-black/10 transition duration-300"></div>

                            <!-- Floating Avatar -->
                            <div class="absolute -bottom-6 left-4 z-10">
                                <!-- <img src="{{ asset('/uploads/users/' . $course->mollim['mollim_image']) }}" -->
                                    <!-- class="w-12 h-12 border-2 border-white rounded-full shadow-md" alt="Avatar"> -->
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="pt-8 pb-4 px-4">
                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition">
                                {{ $course['course_name'] }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $course->mollim['name'] }}</p>

                            <!-- Optional: Tag badges -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span
                                    class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">23
                                    lectures</span>
                                <span
                                    class="bg-[#1b4552]/10 text-[#1b4552] text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $course['duration'] }}</span>

                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-600">{{ $course->created_at->diffForHumans() }}</p>
                                <!-- Button -->
                                <a href="{{ url('course-detail', $course['slug']) }}"
                                    class="inline-block float-end mb-4 border border-[#1b4552] bg-[#1b4552] text-white  py-2 px-4 text-sm rounded-full">
                                    Enroll now
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-center pt-8 w-full">
                <a href="{{ url('courses') }}"
                    class="animated-button  text-stone-900 py-3 px-6 rounded-full flex items-center gap-2">
                    Show All Courses <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
    <section id="upcoming-events"
        class="relative py-10 px-6 sm:px-10 lg:px-24 bg-gradient-to-b from-white via-[#f9fafb] to-white">
        <div class="container mx-auto text-center">
            <div class="relative inline-block mb-16">
                <h2
                    class="text-4xl sm:text-5xl font-extrabold bg-gradient-to-r from-[#1b4552] to-[wheat]  text-transparent bg-clip-text ">
                    Upcoming Events
                </h2>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 85" fill="none"
                    class="absolute top-12 left-1/2 -translate-x-1/2 w-[70%] -z-10 opacity-20">
                    <path
                        d="M124.828 4.59888C169.229 9.92943 213.631 16.4339 226.361 37.5468C244.064 66.8985 104.053 89.9727 42.2616 68.2072C-118.59 11.5502 261.312 -12.1056 249.479 47.5269C240.224 94.1576 -7.80185 73.4384 28.2422 27.3184C35.7437 17.725 76.6543 7.90018 121.293 4.82427C171.88 -1.7839 284.375 5.075 328.375 81.875L299.875 79.6244L330.68 82.7494L337.43 57.6243"
                        stroke="#1b4552" stroke-width="4" stroke-miterlimit="10" />
                </svg>
            </div>

            <div class="grid gap-10 md:grid-cols-2">
                <!-- Event Card -->
                @foreach ($events as $course)
                    <div
                        class="bg-white/80 backdrop-blur-md border border-gray-200 shadow-lg rounded-2xl p-6 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div class="shrink-0">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#1b4552]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg> -->

                                <img class="blog-img" src="https://snipboard.io/nGrtLT.jpg">
                            </div>
                            <div class="text-left">
                                <h3 class="text-xl font-bold text-gray-900">{{ $course->course_name }}</h3>
                                <p class="text-sm text-gray-600">14 February, 2025 - Online</p>
                                <p class="mt-2 text-gray-500 text-sm">{{ $course->course_detail }}</p>
                                {{-- <a href="#"
                                    class="inline-block mt-3 px-5 py-2 text-sm font-medium text-white bg-[#1b4552] hover:bg-[#16363f] rounded-full transition">Register
                                    Now</a> --}}
                            </div>
                        </div>
                        <p class="mt-4 text-right text-xs text-gray-500">2 weeks left</p>
                    </div>
                @endforeach

                <!-- Event Card -->
                {{-- <div class="bg-white/80 backdrop-blur-md border border-gray-200 shadow-lg rounded-2xl p-6 hover:shadow-xl transition-all duration-300">
              <div class="flex items-start gap-4">
                <div class="shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6.042A8.967 8.967 0 006 11c0 5.108 3.825 9.436 8.718 9.958.834.086 1.668.172 2.5.172 2.175 0 4.153-1.593 4.749-3.905A5.972 5.972 0 0018 11a8.963 8.963 0 00-6-4.958z" />
                  </svg>
                </div>
                <div class="text-left">
                  <h3 class="text-xl font-bold text-gray-900">Fundraising Course</h3>
                  <p class="text-sm text-gray-600">20 February, 2025 - Physical, City Hall</p>
                  <p class="mt-2 text-gray-500 text-sm">Explore the world of data science and learn how to analyze and visualize data.</p>
                  <a href="#" class="inline-block mt-3 px-5 py-2 text-sm font-medium text-white bg-green-500 hover:bg-green-600 rounded-full transition">Learn More</a>
                </div>
              </div>
              <p class="mt-4 text-right text-xs text-gray-500">Fundraising Course (Batch 1)</p>
            </div> --}}
            </div>
        </div>
    </section>




    <script src="{{ asset('assets/admin/plugins/gsap-3.12.2/index.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/gsap-3.12.2/scrolltrigger.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // Animate cards when they come into view
            gsap.to(".course-card", {

                scrollTrigger: {
                    trigger: "#courses",
                    start: "top 80%"
                },
                opacity: 1,
                y: 0,
                duration: .3,
            });

        });
    </script>

@endsection
