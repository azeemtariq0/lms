
@extends('../layouts.website.app')



@section('content')

<section>
 <div class="max-w-4xl mx-auto p-8 bg-white shadow-md rounded-lg mt-10">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Contact Us</h2>
    
    <form id="contactForm" action="">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="name" class="block text-gray-700 font-semibold">Full Name</label>
          <input type="text" id="name" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your name" required>
        </div>

        <div>
          <label for="email" class="block text-gray-700 font-semibold">Email Address</label>
          <input type="email" id="email" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
        </div>
      </div>

      <div class="mt-6">
        <label for="subject" class="block text-gray-700 font-semibold">Subject</label>
        <input type="text" id="subject" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter the subject" required>
      </div>

      <div class="mt-6">
        <label for="message" class="block text-gray-700 font-semibold">Message</label>
        <textarea id="message" class="mt-2 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Enter your message" required></textarea>
      </div>

      <div class="mt-6 text-center">
        <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300">Send Message</button>
      </div>
    </form>

    <div id="successMessage" class="mt-6 text-center text-green-600 font-semibold" style="display: none;">
      Your message has been sent successfully!
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#contactForm").on("submit", function(event) {
        event.preventDefault();
        
        // Show success message (you would normally send the form data here via AJAX)
        $("#successMessage").fadeIn();
        setTimeout(function() {
          $("#successMessage").fadeOut();
        }, 3000); // Hide success message after 3 seconds
      });
    });
  </script>


</section>




@endsection