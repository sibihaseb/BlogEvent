<template>
  <footer class="bg-primary text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <div>
          <div class="flex items-center mb-6">
            <img
              src="https://readdy.ai/api/search-image?query=church%2520logo%2520with%2520cross%2520and%2520open%2520bible%2C%2520gold%2520and%2520navy%2520blue%2520colors%2C%2520circular%2520design%2C%2520professional%2C%2520minimalist%2C%2520clean%2520lines&width=150&height=150&seq=54321&orientation=squarish"
              alt="Shekinah Logo"
              class="h-16 bg-white rounded-full p-2"
            />
            <div class="ml-4">
              <h3 class="text-xl font-bold text-secondary">SHEKINAH</h3>
              <p class="text-xs text-gray-300">HAITIAN SEVENTH-DAY ADVENTIST CHURCH</p>
            </div>
          </div>
          <p class="text-gray-300 mb-6">
            A place where faith meets community. Join us as we worship, grow, and serve
            together in Christ.
          </p>
          <div class="flex space-x-4">
            <a
              href="#"
              class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-secondary hover:text-primary transition duration-300"
            >
              <i class="ri-facebook-fill"></i>
            </a>
            <a
              href="#"
              class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-secondary hover:text-primary transition duration-300"
            >
              <i class="ri-youtube-fill"></i>
            </a>
            <a
              href="#"
              class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-secondary hover:text-primary transition duration-300"
            >
              <i class="ri-instagram-line"></i>
            </a>
          </div>
        </div>
        <div>
          <h3 class="text-xl font-semibold mb-6">Quick Links</h3>
          <ul class="space-y-3">
            <li>
              <Link
                :href="route('home')"
                class="text-gray-300 hover:text-secondary transition duration-300"
                >Home</Link
              >
            </li>
            <li>
              <a
                href="#about"
                class="text-gray-300 hover:text-secondary transition duration-300"
                >About Us</a
              >
            </li>
            <li>
              <a
                href="#ministries"
                class="text-gray-300 hover:text-secondary transition duration-300"
                >Ministries</a
              >
            </li>
            <li>
              <Link
                :href="route('church.event')"
                class="text-gray-300 hover:text-secondary transition duration-300"
                >Events</Link
              >
            </li>
            <li>
              <a
                href="#sermons"
                class="text-gray-300 hover:text-secondary transition duration-300"
                >Prayer Requests</a
              >
            </li>
            <li>
              <Link
                :href="route('event.blogs')"
                class="text-gray-300 hover:text-secondary transition duration-300"
                >Blog</Link
              >
            </li>
            <li>
              <Link
                :href="route('contact.us')"
                class="text-gray-300 hover:text-secondary transition duration-300"
                >Contact</Link
              >
            </li>
          </ul>
        </div>
        <div>
          <h3 class="text-xl font-semibold mb-6">Service Times</h3>
          <ul class="space-y-3">
            <li class="flex items-start">
              <i class="ri-calendar-line mr-3 mt-1"></i>
              <div>
                <span class="block font-medium">Sabbath School</span>
                <span class="text-gray-300">Saturday 9:30 AM</span>
              </div>
            </li>
            <li class="flex items-start">
              <i class="ri-calendar-line mr-3 mt-1"></i>
              <div>
                <span class="block font-medium">Divine Service</span>
                <span class="text-gray-300">Saturday 11:00 AM</span>
              </div>
            </li>
            <li class="flex items-start">
              <i class="ri-calendar-line mr-3 mt-1"></i>
              <div>
                <span class="block font-medium">Prayer Meeting</span>
                <span class="text-gray-300">Wednesday 7:00 PM</span>
              </div>
            </li>
            <li class="flex items-start">
              <i class="ri-calendar-line mr-3 mt-1"></i>
              <div>
                <span class="block font-medium">Youth Meeting</span>
                <span class="text-gray-300">Friday 7:00 PM</span>
              </div>
            </li>
          </ul>
        </div>
        <div>
          <h3 class="text-xl font-semibold mb-6">Stay Connected</h3>
          <p class="text-gray-300 mb-4">
            Subscribe to our newsletter for updates and announcements.
          </p>
          <form class="mb-6">
            <div class="flex flex-col sm:flex-row gap-2">
              <input
                type="email"
                placeholder="Your email address"
                class="px-4 py-3 rounded-button bg-white bg-opacity-10 text-white placeholder-gray-400 border-none flex-grow"
              />
              <button
                type="submit"
                class="bg-secondary text-primary px-6 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 whitespace-nowrap !rounded-button"
              >
                Subscribe
              </button>
            </div>
          </form>
          <div class="flex items-center space-x-4">
            <div class="flex items-center">
              <i class="ri-map-pin-line mr-2"></i>
              <span class="text-gray-300">Miami, FL</span>
            </div>
            <div class="flex items-center">
              <i class="ri-phone-line mr-2"></i>
              <span class="text-gray-300">(305) 555-1234</span>
            </div>
          </div>
        </div>
      </div>
      <div class="pt-8 border-t border-gray-700 text-center text-gray-400 text-sm">
        <p>
          &copy; 2025 Shekinah Haitian Seventh-Day Adventist Church. All rights reserved.
        </p>
        <div class="flex justify-center space-x-4 mt-4">
          <a href="#" class="hover:text-secondary transition duration-300"
            >Privacy Policy</a
          >
          <span>|</span>
          <a href="#" class="hover:text-secondary transition duration-300"
            >Terms of Service</a
          >
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts"></script>

<style scoped></style>
