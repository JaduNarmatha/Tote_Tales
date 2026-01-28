@extends('layouts.app')

@section('content')

<section class="bg-green-50 py-16">
  <div class="container mx-auto px-6 text-center">

    <h2 class="text-3xl font-bold mb-4">Get In Touch</h2>
    <p class="text-gray-700 max-w-xl mx-auto mb-12">
      Have questions about our totes or want to share your Tote_Tales story?
      We’d love to hear from you!
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">

      <!-- Contact Form -->
      <div class="bg-white shadow-md rounded-xl p-6 text-left">
        <h3 class="font-semibold text-lg mb-4">Send us a message</h3>

        <form class="space-y-4">
          <div>
            <label class="block text-sm font-medium">Name</label>
            <input type="text" placeholder="Your name"
                   class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400">
          </div>

          <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" placeholder="you@email.com"
                   class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400">
          </div>

          <div>
            <label class="block text-sm font-medium">Message</label>
            <textarea rows="4" placeholder="Tell us your story..."
                      class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-400"></textarea>
          </div>

          <button type="submit"
                  class="w-full bg-orange-500 hover:bg-orange-600 text-white py-3 rounded-lg transition">
            Send Message
          </button>

          <p class="text-xs text-gray-500 mt-2">
            Disclaimer: This is a sample contact form, not connected to an email service.
          </p>
        </form>
      </div>

      <!-- Contact Info -->
      <div class="space-y-6">
        <div class="bg-white shadow-md rounded-xl p-6">
          <h3 class="font-semibold mb-2">Connect With Us</h3>
          <p class="text-gray-700">📧 hello@totetales.com</p>
          <p class="text-gray-700">💬 WhatsApp Us</p>
        </div>

        <div class="bg-white shadow-md rounded-xl p-6">
          <h3 class="font-semibold mb-2">Follow Our Journey</h3>
          <p class="text-gray-700 mb-3">
            Stay updated with new designs, eco-tips, and behind-the-scenes stories.
          </p>
          <div class="flex space-x-3 justify-center">
            <a href="#" class="text-2xl hover:text-green-600">🌐</a>
            <a href="#" class="text-2xl hover:text-green-600">📷</a>
            <a href="#" class="text-2xl hover:text-green-600">🐦</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script>
  gsap.from("h2", { y: -50, opacity: 0, duration: 1 });
  gsap.from(".grid > div", { opacity: 0, y: 50, duration: 1, stagger: 0.3 });
  gsap.from("form input, form textarea, form button", {
    opacity: 0,
    x: -30,
    duration: 1,
    stagger: 0.2
  });
</script>
@endpush
