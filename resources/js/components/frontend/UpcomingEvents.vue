<template>
  <section id="events" class="py-16">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-primary mb-2">Upcoming Events</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Join us for these special gatherings and be part of our community.
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          class="bg-white rounded-lg overflow-hidden shadow-md event-card transition duration-300"
        >
          <div class="h-48 bg-gray-200 relative">
            <img
              src="https://readdy.ai/api/search-image?query=church%2520worship%2520service%2520with%2520diverse%2520congregation%2520singing%2520and%2520praising%2C%2520warm%2520lighting%2C%2520joyful%2520atmosphere%2C%2520professional%2520photography&width=600&height=400&seq=11111&orientation=landscape"
              alt="Worship Service"
              class="w-full h-full object-cover object-top"
            />
            <div
              class="absolute top-4 left-4 bg-secondary text-primary text-center p-2 rounded-md"
            >
              <span class="block font-bold">MAY</span>
              <span class="block text-xl font-bold">12</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">Special Worship Service</h3>
            <p class="text-gray-600 mb-4">
              Join us for a special worship service with guest speaker Pastor Emmanuel
              Joseph.
            </p>
            <div class="flex items-center text-gray-500 mb-4">
              <i class="ri-time-line mr-2"></i>
              <span>11:00 AM - 1:00 PM</span>
            </div>
            <div class="flex items-center text-gray-500 mb-6">
              <i class="ri-map-pin-line mr-2"></i>
              <span>Main Sanctuary</span>
            </div>
            <a
              href="#"
              class="inline-block bg-primary text-white px-6 py-2 rounded-button font-medium hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap"
              >RSVP Now</a
            >
          </div>
        </div>
        <div
          class="bg-white rounded-lg overflow-hidden shadow-md event-card transition duration-300"
        >
          <div class="h-48 bg-gray-200 relative">
            <img
              src="https://readdy.ai/api/search-image?query=youth%2520bible%2520study%2520group%2C%2520diverse%2520teenagers%2520discussing%2520scripture%2C%2520casual%2520setting%2C%2520warm%2520lighting%2C%2520engaged%2520expressions%2C%2520professional%2520photography&width=600&height=400&seq=22222&orientation=landscape"
              alt="Youth Bible Study"
              class="w-full h-full object-cover object-top"
            />
            <div
              class="absolute top-4 left-4 bg-secondary text-primary text-center p-2 rounded-md"
            >
              <span class="block font-bold">MAY</span>
              <span class="block text-xl font-bold">18</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">Youth Bible Study</h3>
            <p class="text-gray-600 mb-4">
              An engaging Bible study specifically designed for our youth and young
              adults.
            </p>
            <div class="flex items-center text-gray-500 mb-4">
              <i class="ri-time-line mr-2"></i>
              <span>4:00 PM - 6:00 PM</span>
            </div>
            <div class="flex items-center text-gray-500 mb-6">
              <i class="ri-map-pin-line mr-2"></i>
              <span>Youth Center</span>
            </div>
            <a
              href="#"
              class="inline-block bg-primary text-white px-6 py-2 rounded-button font-medium hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap"
              >RSVP Now</a
            >
          </div>
        </div>
        <div
          class="bg-white rounded-lg overflow-hidden shadow-md event-card transition duration-300"
        >
          <div class="h-48 bg-gray-200 relative">
            <img
              src="https://readdy.ai/api/search-image?query=community%2520outreach%2520event%2C%2520volunteers%2520distributing%2520food%2520and%2520supplies%2C%2520diverse%2520group%2520helping%2520others%2C%2520warm%2520atmosphere%2C%2520professional%2520photography&width=600&height=400&seq=33333&orientation=landscape"
              alt="Community Outreach"
              class="w-full h-full object-cover object-top"
            />
            <div
              class="absolute top-4 left-4 bg-secondary text-primary text-center p-2 rounded-md"
            >
              <span class="block font-bold">MAY</span>
              <span class="block text-xl font-bold">25</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">Community Outreach</h3>
            <p class="text-gray-600 mb-4">
              Join us as we serve our local community through food distribution and
              prayer.
            </p>
            <div class="flex items-center text-gray-500 mb-4">
              <i class="ri-time-line mr-2"></i>
              <span>9:00 AM - 1:00 PM</span>
            </div>
            <div class="flex items-center text-gray-500 mb-6">
              <i class="ri-map-pin-line mr-2"></i>
              <span>Community Center</span>
            </div>
            <a
              href="#"
              class="inline-block bg-primary text-white px-6 py-2 rounded-button font-medium hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap"
              >Volunteer Now</a
            >
          </div>
        </div>
      </div>
      <div class="text-center mt-10">
        <a
          href="#"
          class="inline-block border-2 border-primary text-primary px-8 py-3 rounded-button font-semibold hover:bg-primary hover:text-white transition duration-300 !rounded-button whitespace-nowrap"
        >
          View All Events
        </a>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts"></script>

<style scoped>
.event-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}
</style>
