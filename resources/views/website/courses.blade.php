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
            <span class="text-sm md:text-base font-medium">Showing 1 to {{count($courses)}} of {{count($courses)}} Results</span>
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
    <div id="results" class="mb-10 grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 p-4 max-w-7xl mx-auto">
    
    </div>


<!-- 
    <div class="container">
<h2>Example: Data Load While Page Scroll with jQuery PHP and MySQL</h2>
<div id="results">

</div>
<div id="loader" style="text-align:center;"><img src="{{ url('assets/web/loader.gif') }}" /></div>
</div> -->

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


            // scroll

         
        });



   $(window).scroll(function(){ 
                if ($(window).scrollTop() == $(document).height() - $(window).height()){
                    if($(".page_number:last").val() <= $(".total_record").val()) {
                    var pagenum = parseInt($(".page_number:last").val()) + 1;
                    loadRecord('{{ url("course-content") }}?page='+pagenum);
                    }
                }
            });



function loadRecord(url) {

    $.ajax({
    url: url,
    type: "GET",
    data: {total_record:$("#total_record").val()},
    dataType:'html',
    beforeSend: function(){
    $('#loader').show();
    },
    complete: function(){
    $('#loader').hide();
    },
    success: function(data){


        console.log(data);
    $("#results").append(data);
    console.log( $(".total_record").val());
    // alert();
    },
    error: function(){}
    });
}
 $('#loader').hide();

 loadRecord('{{ url("course-content") }}?page=1');
    </script>
@endsection
