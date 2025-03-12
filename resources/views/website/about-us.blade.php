@extends('../layouts.website.app')

@section('content')
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
                    
                </div>
            </div>
        </div>
    </section>

@endsection