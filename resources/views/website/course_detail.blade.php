@extends('../layouts.website.app')


@section('content')



    <section class="pt-20">
        <div class="container mx-auto px-4">
      
            <h2 class="text-4xl font-bold text-stone-900 mb-6 relative">
                Course Detail
                <span class="absolute bottom-0 left-0 w-55 h-1 bg-[#1b4552] rounded-full"></span>
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

            </div>
           
        </div>
    </section>




@endsection