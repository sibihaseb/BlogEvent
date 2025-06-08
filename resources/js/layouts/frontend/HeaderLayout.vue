<template>
  <header class="bg-white shadow-md fixed w-full z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center">
        <img
          src="https://readdy.ai/api/search-image?query=church%2520logo%2520with%2520cross%2520and%2520open%2520bible%2C%2520gold%2520and%2520navy%2520blue%2520colors%2C%2520circular%2520design%2C%2520professional%2C%2520minimalist%2C%2520clean%2520lines&width=150&height=150&seq=54321&orientation=squarish"
          alt="Shekinah Logo"
          class="h-16"
        />
        <div class="ml-4">
          <h1 class="text-primary font-bold text-2xl">SHEKINAH</h1>
          <p class="text-secondary text-sm">HAITIAN SEVENTH-DAY ADVENTIST CHURCH</p>
        </div>
      </div>
      <nav class="hidden lg:flex items-center space-x-8">
        <Link
          :href="route('home')"
          class="text-primary hover:text-secondary font-bold transition duration-300"
          >Home</Link
        >
        <Link
          :href="route('about.us')"
          class="text-primary hover:text-secondary font-bold transition whitespace-nowrap duration-300"
          >About Us</Link
        >
        <a
          href="#ministries"
          class="text-primary hover:text-secondary font-bold transition duration-300"
          >Ministries</a
        >
        <Link
          :href="route('church.event')"
          class="text-primary hover:text-secondary font-bold transition duration-300"
          >Events</Link
        >
        <Link
          :href="route('prayer.page')"
          class="text-primary hover:text-secondary font-bold transition whitespace-nowrap duration-300"
          >Prayer Requests</Link
        >
        <Link
          :href="route('event.blogs')"
          class="text-primary hover:text-secondary font-bold transition duration-300"
          >Blog</Link
        >
        <Link
          :href="route('contact.us')"
          class="text-primary hover:text-secondary font-bold transition duration-300"
          >Contact</Link
        >
        <Link
          v-if="$page.props.auth.user"
          :href="route('dashboard')"
          class="text-primary hover:text-secondary font-bold transition duration-300"
        >
          Dashboard
        </Link>
        <template v-else>
          <Link
            :href="route('login')"
            class="text-primary hover:text-secondary whitespace-nowrap font-bold transition duration-300"
          >
            Log in
          </Link>
          <Link
            :href="route('register')"
            class="text-primary hover:text-secondary font-bold transition duration-300"
          >
            Register
          </Link>
        </template>
      </nav>
      <div class="flex items-center space-x-4">
        <div class="hidden lg:flex items-center space-x-2 border-r pr-4 border-gray-200">
          <button class="text-sm text-primary font-bold">EN</button>
          <span class="text-gray-300">|</span>
          <button class="text-sm font-bold text-primary">HT</button>
        </div>
        <div class="flex text-primary justify-center items-center">
          <Video fill="red" :size="28" />
          <h1 class="ml-2 text-sm font-bold text-primary">Live Stream</h1>
        </div>
        <button class="lg:hidden text-primary w-10 h-10 flex items-center justify-center">
          <i class="ri-menu-line ri-lg"></i>
        </button>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Video } from "lucide-vue-next";
</script>

<style>
.rounded-button {
  border-radius: 8px;
}

.rounded-lg {
  border-radius: 8px;
}
</style>
