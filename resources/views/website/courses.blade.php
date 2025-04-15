@extends('../layouts.website.app')


@section('content')
    <!-- Hero Heading -->
    <section class="py-10 px-4 max-w-7xl mx-auto text-center">
        <h1 id="hero-title"
            class="-translate-y-[50px] opacity-0 text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 mb-3">
            Explore Our Courses
        </h1>
        <p id="hero-sub" class="translate-y-[20px] opacity-0 text-lg text-gray-600">
            Unlock spiritual growth and leadership wisdom — handpicked just for you.
        </p>
    </section>

    <!-- Filter Bar -->
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div class="flex items-center gap-2 text-gray-700">
            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z" />
            </svg>
            <span class="text-sm md:text-base font-medium">Showing 1 to 4 of 4 Results</span>
        </div>
        <select
            class="bg-white border border-gray-300 text-sm rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <option selected>Filter Course</option>
            <option>UC Nigran Course</option>
            <option>Zeli Nigran Course</option>
            <option>12 Deeni Kaam Islamic</option>
            <option>Itikaf Course</option>
            <option>Fundraising Course</option>
        </select>
    </div>

    <!-- Course Cards Grid -->
    <div id="courses" class="h-screen grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 p-4 max-w-7xl mx-auto">
        {{-- Repeat for all courses --}}
        @php
            $courses = [
                [
                    'title' => 'Itikaf Course',
                    'img' => asset('assets/images/post-01.jpg'),
                    'teacher' => 'Maulana Ilyas Attar Qadri',
                    'avatar' => 'https://i.ibb.co/y6ZqL6Y/maulana.png',
                ],
                [
                    'title' => 'Zeli Nigran Course',
                    'img' => asset('assets/images/post-02.jpg'),
                    'teacher' => 'Haji Muhammad Shahid Attari',
                    'avatar' => 'https://i.ibb.co/XbFFqZK/shahid.png',
                ],
                [
                    'title' => 'UC Nigran Course',
                    'img' => asset('assets/images/post-03.jpg'),
                    'teacher' => 'Haji Muhammad Shahid Attari',
                    'avatar' => 'https://i.ibb.co/XbFFqZK/shahid.png',
                ],
            ];
        @endphp

        @foreach ($courses as $course)
            <div
                class="course-card translate-y-[20px] opacity-0 h-fit group relative  border border-gray-200 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition duration-300">

                <!-- Image with dark overlay -->
                <div class="relative">
                    <img src="{{ $course['img'] }}" alt="{{ $course['title'] }}" class="w-full h-48 object-cover">
                    <div class="absolute inset-0 group-hover:bg-black/10 transition duration-300"></div>

                    <!-- Floating Avatar -->
                    <div class="absolute -bottom-6 left-4 z-10">
                        <img src="{{ $course['avatar'] }}" class="w-12 h-12 border-2 border-white rounded-full shadow-md"
                            alt="Avatar">
                    </div>
                </div>

                <!-- Card Content -->
                <div class="pt-8 pb-4 px-4">
                    <h3 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition">
                        {{ $course['title'] }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $course['teacher'] }}</p>

                    <!-- Optional: Tag badges -->
                    <div class="flex flex-wrap gap-2 mt-3">
                        <span
                            class="bg-[#1b4552]/10 text-[#1b4552] text-xs font-semibold px-2.5 py-0.5 rounded-full">Spiritual</span>
                        <span
                            class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Leadership</span>
                    </div>

                    <!-- Button -->
                    <a href="{{ url('courses', $course['title']) }}"
                        class="inline-block mt-4 text-[#1b4552] text-sm font-medium hover:underline">View
                        Course →</a>
                </div>
            </div>
        @endforeach
    </div>

    <script src="{{ asset('assets/admin/plugins/gsap-3.12.2/index.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/gsap-3.12.2/scrolltrigger.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // Hero animation
            gsap.to("#hero-title", {
                opacity: 1,
                y: 0,
                duration: .7,

            });
            gsap.to("#hero-sub", {
                opacity: 1,
                y: 0,
                duration: .7,
                delay: 0.1,

            });
            // Animate cards when they come into view
            gsap.to(".course-card", {

                opacity: 1,
                y: 0,
                duration: .3,
            });

        });
    </script>
@endsection
