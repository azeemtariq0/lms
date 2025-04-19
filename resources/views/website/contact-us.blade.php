@extends('../layouts.website.app')

@section('content')
    <section class="py-16 px-4 bg-gradient-to-br from-white to-blue-50">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-xl p-8 md:p-12 relative overflow-hidden">
            <!-- Decorative Circle -->
            <div class="absolute -top-10 -left-10 w-32 h-32 bg-blue-100 rounded-full opacity-30"></div>

            <h2 id="contact-heading" class="text-4xl font-bold text-center text-gray-800 mb-10 opacity-0 -translate-y-10">
                Get In Touch
            </h2>

            <form id="contactForm" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold">Full Name</label>
                        <input type="text" id="name"
                            class="mt-2 p-3 w-full border border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-[#1B4552] focus:outline-none"
                            placeholder="Your Name" required>
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-semibold">Email</label>
                        <input type="email" id="email"
                            class="mt-2 p-3 w-full border border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-[#1B4552] focus:outline-none"
                            placeholder="you@example.com" required>
                    </div>
                </div>

                <div>
                    <label for="subject" class="block text-gray-700 font-semibold">Subject</label>
                    <input type="text" id="subject"
                        class="mt-2 p-3 w-full border border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-[#1B4552] focus:outline-none"
                        placeholder="Write your subject..." required>
                </div>

                <div>
                    <label for="message" class="block text-gray-700 font-semibold">Message</label>
                    <textarea id="message"
                        class="mt-2 p-3 w-full border border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-[#1B4552] focus:outline-none"
                        rows="5" placeholder="Write your message here..." required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="inline-flex items-center gap-2  px-6 py-3 bg-[#1b4552] text-white font-medium cursor-pointer rounded-lg hover:bg-[#163840] transition">
                        <i class="fa-solid fa-envelope"></i>
                        Send Message
                    </button>
                </div>

                <div id="successMessage"
                    class="text-center py-5 bg-green-200/40 h-15  rounded-lg mx-auto text-green-600 font-semibold mt-4 hidden">
                    ✅ Your message has been sent!
                </div>

            </form>
            <div class="mt-12">
                <h3 class="text-2xl font-semibold text-center text-gray-800 mb-6">Our Location</h3>
                <div class="rounded-3xl overflow-hidden shadow-lg border border-gray-200">
                    <iframe class="w-full h-[400px]"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.9836233182564!2d67.03210827524122!3d24.79865817798743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e831ed7d6cb%3A0xe22dd9fdf4424c1d!2sDawat-e-Islami%20Head%20Office%20(Markaz%20Faizan-e-Madina)!5e0!3m2!1sen!2s!4v1713184301876!5m2!1sen!2s"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </section>

    <!-- GSAP & jQuery -->
    <script src="{{ asset('assets/admin/plugins/gsap-3.12.2/index.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/gsap-3.12.2/scrolltrigger.min.js') }}"></script>
    {{-- <script>
        $(document).ready(function() {
            // Contact form animation
            gsap.to("#contact-heading", {
                opacity: 1,
                y: 0,
                duration: 0.7,
                ease: "power2.out",
            });

            // Submit behavior
            $("#contactForm").on("submit", function(event) {
                event.preventDefault();
                $("#successMessage").fadeIn();
                setTimeout(function() {
                    $("#successMessage").fadeOut();
                }, 200000);
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Animate heading
            gsap.to("#contact-heading", {
                opacity: 1,
                y: 0,
                duration: 0.7,
                ease: "power2.out",
            });

            // AJAX form submission
            $("#contactForm").on("submit", function(event) {
                event.preventDefault();

                const formData = {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    subject: $("#subject").val(),
                    message: $("#message").val(),
                    _token: "{{ csrf_token() }}",
                };

                $.ajax({
                    url: "{{ url('contact-us') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        $("#successMessage").fadeIn().text("✅ Your message has been sent!")
                            .addClass("flex");
                        setTimeout(() => $("#successMessage").fadeOut(), 4000);
                        $('#contactForm')[0].reset();
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = Object.values(errors).join('\n');
                        alert("Error:\n" + errorMsg);
                    }
                });
            });
        });
    </script>
@endsection
