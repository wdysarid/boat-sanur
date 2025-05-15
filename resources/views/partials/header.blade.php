<header>
  @include('partials.navbar')
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- Hero Section -->
  <section class="bg-blue-100 px-6 py-20 mt-16">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-10">
      <div>
        <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
          Travel Fast <br> Across the Sea
        </h1>
        <p class="text-gray-700 mb-6 text-lg">
          Book your boat ticket online and enjoy a seamless experience exploring top destinations.
        </p>
        <a href="#booking" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
          Book Now
        </a>
      </div>
      <div class="hidden md:block">
        <img src="{{ asset('images/landing-illustration.svg') }}" alt="Boat Travel" class="w-full h-auto">
      </div>
    </div>
  </section>
</header>
