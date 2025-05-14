<template>
  <section id="contact" class="py-16">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-primary mb-2">Contact Us</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          We'd love to hear from you. Reach out with any questions or prayer requests.
        </p>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div>
          <div class="bg-gray-50 p-8 rounded-lg shadow-md mb-8">
            <h3 class="text-xl font-semibold mb-6">Send Us a Message</h3>
            <form>
              <div class="mb-4">
                <label for="name" class="block text-gray-700 mb-2">Your Name</label>
                <input
                  type="text"
                  id="name"
                  class="w-full px-4 py-3 rounded-button bg-white border border-gray-300 focus:border-secondary"
                  placeholder="John Doe"
                />
              </div>
              <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email Address</label>
                <input
                  type="email"
                  id="email"
                  class="w-full px-4 py-3 rounded-button bg-white border border-gray-300 focus:border-secondary"
                  placeholder="john@example.com"
                />
              </div>
              <div class="mb-4">
                <label for="phone" class="block text-gray-700 mb-2">Phone Number</label>
                <input
                  type="tel"
                  id="phone"
                  class="w-full px-4 py-3 rounded-button bg-white border border-gray-300 focus:border-secondary"
                  placeholder="(123) 456-7890"
                />
              </div>
              <div class="mb-6">
                <label for="message" class="block text-gray-700 mb-2">Message</label>
                <textarea
                  id="message"
                  rows="5"
                  class="w-full px-4 py-3 rounded-button bg-white border border-gray-300 focus:border-secondary"
                  placeholder="Your message here..."
                ></textarea>
              </div>
              <button
                type="submit"
                class="w-full bg-primary text-white px-6 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap"
              >
                Send Message
              </button>
            </form>
          </div>
          <div class="bg-gray-50 p-8 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-6">Prayer Request</h3>
            <form>
              <div class="mb-4">
                <label for="prayer-name" class="block text-gray-700 mb-2"
                  >Your Name</label
                >
                <input
                  type="text"
                  id="prayer-name"
                  class="w-full px-4 py-3 rounded-button bg-white border border-gray-300 focus:border-secondary"
                  placeholder="John Doe"
                />
              </div>
              <div class="mb-6">
                <label for="prayer-request" class="block text-gray-700 mb-2"
                  >Prayer Request</label
                >
                <textarea
                  id="prayer-request"
                  rows="4"
                  class="w-full px-4 py-3 rounded-button bg-white border border-gray-300 focus:border-secondary"
                  placeholder="Share your prayer request..."
                ></textarea>
              </div>
              <div class="mb-6 flex items-center">
                <div class="relative inline-block w-10 mr-2 align-middle select-none">
                  <input
                    type="checkbox"
                    id="confidential"
                    class="opacity-0 absolute block w-6 h-6 cursor-pointer"
                  />
                  <div class="block bg-gray-300 w-10 h-6 rounded-full"></div>
                  <div
                    class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"
                  ></div>
                </div>
                <label for="confidential" class="text-gray-700"
                  >Keep my request confidential</label
                >
              </div>
              <button
                type="submit"
                class="w-full bg-green text-white px-6 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap"
              >
                Submit Prayer Request
              </button>
            </form>
          </div>
        </div>
        <div>
          <div class="bg-gray-50 p-8 rounded-lg shadow-md mb-8">
            <h3 class="text-xl font-semibold mb-6">Church Information</h3>
            <div class="flex items-start mb-6">
              <div
                class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-4 mt-1"
              >
                <i class="ri-map-pin-line text-white"></i>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800 mb-1">Address</h4>
                <p class="text-gray-600">123 Faith Avenue</p>
                <p class="text-gray-600">Miami, FL 33125</p>
              </div>
            </div>
            <div class="flex items-start mb-6">
              <div
                class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-4 mt-1"
              >
                <i class="ri-time-line text-white"></i>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800 mb-1">Service Times</h4>
                <p class="text-gray-600">Sabbath School: 9:30 AM</p>
                <p class="text-gray-600">Divine Service: 11:00 AM</p>
                <p class="text-gray-600">Prayer Meeting: Wednesday 7:00 PM</p>
              </div>
            </div>
            <div class="flex items-start mb-6">
              <div
                class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-4 mt-1"
              >
                <i class="ri-phone-line text-white"></i>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800 mb-1">Phone</h4>
                <p class="text-gray-600">(305) 555-1234</p>
              </div>
            </div>
            <div class="flex items-start">
              <div
                class="w-10 h-10 bg-primary rounded-full flex items-center justify-center mr-4 mt-1"
              >
                <i class="ri-mail-line text-white"></i>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800 mb-1">Email</h4>
                <p class="text-gray-600">info@shekinahsda.org</p>
              </div>
            </div>
          </div>
          <div class="bg-gray-200 rounded-lg overflow-hidden h-80">
            <!-- Map placeholder -->
            <div
              class="w-full h-full bg-cover bg-center"
              style="
                background-image: url('https://public.readdy.ai/gen_page/map_placeholder_1280x720.png');
              "
            ></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts"></script>

<style scoped></style>
