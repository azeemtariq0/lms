@extends('../layouts.website.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-[#1b4552]/20 via-white to-green-100 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 id="hero-title" class="text-5xl font-extrabold text-gray-900 opacity-0 -translate-y-5">
                {{ $data['course_name'] }}</h1>
            {{-- <p id="hero-sub" class="mt-3 text-lg text-gray-600 opacity-0 translate-y-5">{{$data['']}}</p> --}}
        </div>
    </section>

    <!-- Main Course Section -->
    <section class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Left: Main Content -->
        <div class="lg:col-span-3">
            <!-- Instructor -->
            <div class="flex items-center gap-4 mb-6">
                <img src="{{ asset('/uploads/users/' . $data->mollim['mollim_image']) }}"
                    class="w-14 h-14 rounded-full shadow-md" alt="Instructor">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $data->mollim['name'] }}</h2>
                    <p class="text-sm text-gray-500">{{ $data->mollim['mollim_designation'] }}</p>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="flex gap-6 text-sm font-medium text-gray-600">
                    <a href="#overview"
                        class="tab-link active-tab py-2 border-b-2 border-transparent hover:border-blue-500">Overview</a>
                    <a href="#curriculum"
                        class="tab-link py-2 border-b-2 border-transparent hover:border-blue-500">Curriculum</a>
                    <a href="#instructor"
                        class="tab-link py-2 border-b-2 border-transparent hover:border-blue-500">Instructor</a>
                    <a href="#attachment"
                        class="tab-link py-2 border-b-2 border-transparent hover:border-blue-500">Attachments</a>
                </nav>
            </div>

            <!-- Overview -->
            <div id="overview" class="tab-content space-y-6">
                <p class="text-gray-700 leading-relaxed">{{ $data['course_detail'] }}
                </p>
                <p class="text-sm text-blue-600 font-semibold">{{ $data['course_requirement'] }}</p>
            </div>
            <!-- Curriculum Section -->
            <div id="curriculum" class="tab-content hidden">
                <div class="space-y-4" x-data="{ open: null }">
                    @php
                        $lectures = [
                            ['title' => 'Masjid aur Fana-e-Masjid ke Ahkam', 'duration' => '16 minutes'],
                            ['title' => 'Chanda Jama Karne ki Shari Ihtiyatain', 'duration' => '21.5 minutes'],
                            ['title' => 'Mal Waqf ke Masail', 'duration' => '15 minutes'],
                            ['title' => 'Baghair niyat ke haath uthana', 'duration' => '4 minutes'],
                        ];
                    @endphp

                    @foreach ($lectures as $index => $lecture)
                        <div class="border border-gray-200 rounded-xl bg-white shadow hover:shadow-md transition overflow-hidden"
                            x-data="{ isOpen: false }">

                            <!-- Lecture Header -->
                            <button @click="isOpen = !isOpen"
                                class="flex items-center justify-between w-full px-5 py-4 text-left text-gray-800 font-medium hover:bg-gray-50 transition">

                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-[#1b4552]" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M4 6h16M4 12h8m-8 6h16" />
                                    </svg>
                                    <span>Lecture {{ $index + 1 }}: {{ $lecture['title'] }}</span>
                                </div>

                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <span>{{ $lecture['duration'] }}</span>
                                    <svg :class="isOpen ? 'rotate-180' : ''" class="w-5 h-5 transition-transform"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </button>

                            <!-- Hidden Content (Optional notes or video placeholder) -->
                            <div x-show="isOpen" x-collapse class="px-5 pb-4 text-sm text-gray-600 bg-gray-50">
                                <p>This lecture covers essential rulings and insights. Notes or video preview can be added
                                    here.</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <!-- Instructor -->
            <div id="instructor" class="tab-content hidden mt-6">
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                    <div class="flex items-center gap-4 mb-5">
                        <img src="{{ asset('/uploads/users/' . $data->mollim['mollim_image']) }}" alt="Instructor Photo"
                            class="w-16 h-16 rounded-full border-2 border-white shadow-md transition hover:scale-105 duration-300">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ $data->mollim['name'] }}</h3>
                            <p class="text-sm text-gray-500">{{ $data->mollim['mollim_designation'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 mb-3">
                        <a target="_blank" class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full"
                            href="{{ $data->mollim['facebook_link'] }}"><i
                                class="fa-brands fa-facebook-f text-sky-700"></i></a>
                        <a target="_blank" class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full"
                            href="{{ $data->mollim['twitter_link'] }}"><i
                                class="fa-brands fa-twitter text-sky-700"></i></a>
                        <a target="_blank" class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full"
                            href="{{ $data->mollim['google_link'] }}"><i
                                class="fa-brands fa-google text-orange-600"></i></a>
                        <a target="_blank" class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full"
                            href="{{ $data->mollim['instagram_link'] }}"><i
                                class="fa-brands fa-instagram text-pink-600"></i></a>
                    </div>
                    <p class="text-sm text-gray-500">{{ $data->mollim['mollim_details'] }}</p>

                    {{-- <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-cake-candles text-yellow-600 mt-1 w-5"></i>
                            <span><strong>Born:</strong> 17th May 1965, Nawabshah, Sindh</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-handshake-angle text-green-600 mt-1 w-5"></i>
                            <span><strong>Joined Dawat-e-Islami:</strong> 1982</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-map-location-dot text-blue-600 mt-1 w-5"></i>
                            <span><strong>Service Areas:</strong> Punjab, Kashmir, KPK, and more</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-users-gear text-indigo-600 mt-1 w-5"></i>
                            <span><strong>Majlis:</strong> Markazi Majlis-e-Shura (Since 2000)</span>
                        </li>
                    </ul> --}}


                </div>
            </div>


            <!-- Attachments Section -->
            <div id="attachment" class="tab-content hidden">
                <h2 class="text-2xl font-bold text-gray-800 mb-4"><i class="fa fa-paperclip -rotate-45"></i> Attachments
                </h2>

                <div class="grid gap-4">
                    @php
                        $attachments = [
                            ['name' => 'Course Outline.pdf', 'url' => '#', 'type' => 'pdf'],
                            ['name' => 'Weekly Planner.docx', 'url' => '#', 'type' => 'docx'],
                            ['name' => 'Class Slides.pptx', 'url' => '#', 'type' => 'pptx'],
                        ];
                    @endphp
                    @foreach ($attachments as $file)
                        <div
                            class="group flex justify-between items-center p-4 rounded-xl border border-gray-200 hover:shadow-lg transition duration-300 bg-white relative overflow-hidden">
                            <div class="flex items-center gap-4">
                                <!-- Animated Icon -->
                                <div
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 group-hover:scale-110 transition">
                                    @if ($file['type'] === 'pdf')
                                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <path d="M14 2v6h6" />
                                        </svg>
                                    @elseif($file['type'] === 'docx')
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <path d="M14 2v6h6" />
                                        </svg>
                                    @elseif($file['type'] === 'pptx')
                                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <path d="M14 2v6h6" />
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16c0 1.1.9 2 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <path d="M14 2v6h6" />
                                        </svg>
                                    @endif
                                </div>

                                <!-- File Info -->
                                <div>
                                    <div class="text-gray-800 font-medium">{{ $file['name'] }}</div>
                                    <div class="text-sm text-gray-500 flex gap-2 mt-1">
                                        <span
                                            class="bg-gray-100 px-2 py-0.5 rounded text-xs uppercase tracking-wide">{{ strtoupper($file['type']) }}</span>
                                        <span class="text-xs">{{ $file['size'] ?? '1.2MB' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-4">
                                <a href="{{ $file['url'] }}" target="_blank"
                                    class="text-sm text-blue-500 hover:underline transition">Preview</a>

                                <a href="{{ $file['url'] }}" download
                                    class="text-sm text-white bg-blue-600 px-4 py-1.5 rounded-lg hover:bg-blue-700 transition shadow">
                                    Download
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>


        </div>
        <!-- Right: Course Sidebar -->
        <div
            class="bg-white/80 backdrop-blur p-6 rounded-2xl shadow-xl border border-gray-100 sticky top-24 space-y-5 transition hover:shadow-2xl hover:scale-[1.01] duration-300">

            <!-- Title -->
            <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-6 h-6 text-[#1b4552]" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M9 12h6m-3 -3v6m7 4a9 9 0 1 0-18 0a9 9 0 0 0 18 0z" />
                </svg>
                Course Features
            </h3>

            <!-- Features List -->
            <ul class="space-y-3 text-gray-700 text-sm">
                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3" />
                        <path d="M12 19a7 7 0 1 0-7-7" />
                    </svg>
                    <span><span class="font-semibold text-gray-900">Duration:</span> {{$data['duration']}}</span>
                </li>

                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M4 6h16M4 10h16M4 14h10" />
                    </svg>
                    <span><span class="font-semibold text-gray-900">Lectures:</span> {{$data['lectures'] ?? "N/A"}}</span>
                </li>

                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 9v2m0 4h.01" />
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                    <span><span class="font-semibold text-gray-900">Test:</span> {{$data['test'] ?? "N/A"}}</span>
                </li>

                <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M17 21v-2a4 4 0 0 0-3-3.87M9 10a4 4 0 1 0-3 3.87v2.13a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4v-2.13A4 4 0 0 0 15 10" />
                        <path d="M15 10a4 4 0 1 0-6 0" />
                    </svg>
                    <span><span class="font-semibold text-gray-900">Users:</span> {{$data['users'] ?? "N/A"}}</span>
                </li>
            </ul>

            <!-- Enroll Button -->
            <a href="#"
                class="block w-full text-center bg-[#1b4552] hover:bg-[#16373f] text-white py-2.5 rounded-lg font-semibold text-sm tracking-wide transition transform hover:scale-105">
                Enroll Now
            </a>
        </div>

    </section>

    <script src="{{ asset('assets/admin/plugins/gsap-3.12.2/index.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/alpinejs@3.x.x/index.min.js') }}" defer></script>

    <script>
        // Animate Hero Text
        gsap.to("#hero-title", {
            opacity: 1,
            y: 0,
            duration: 0.8
        });
        gsap.to("#hero-sub", {
            opacity: 1,
            y: 0,
            duration: 0.8,
            delay: 0.1
        });

        // Tab Switching Logic
        const tabs = document.querySelectorAll('.tab-link');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach((tab, idx) => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                tabs.forEach(t => t.classList.remove('active-tab', 'text-blue-600'));
                contents.forEach(c => c.classList.add('hidden'));
                tab.classList.add('active-tab', 'text-blue-600');
                contents[idx].classList.remove('hidden');
            });
        });
    </script>

    <style>
        .active-tab {
            border-color: #3b82f6 !important;
        }
    </style>
@endsection
