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
        <a
          href="#"
          class="text-primary hover:text-secondary font-medium transition duration-300"
          >Home</a
        >
        <a
          href="#about"
          class="text-primary hover:text-secondary font-medium transition duration-300"
          >About Us</a
        >
        <a
          href="#ministries"
          class="text-primary hover:text-secondary font-medium transition duration-300"
          >Ministries</a
        >
        <a
          href="#events"
          class="text-primary hover:text-secondary font-medium transition duration-300"
          >Events</a
        >
        <a
          href="#sermons"
          class="text-primary hover:text-secondary font-medium transition duration-300"
          >Sermons</a
        >
        <a
          href="#blog"
          class="text-primary hover:text-secondary font-medium transition duration-300"
          >Blog</a
        >
        <a
          href="#contact"
          class="text-primary hover:text-secondary font-medium transition duration-300"
          >Contact</a
        >
        <Link
          v-if="$page.props.auth.user"
          :href="route('dashboard')"
          class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
        >
          Dashboard
        </Link>
        <template v-else>
          <Link
            :href="route('login')"
            class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
          >
            Log in
          </Link>
          <Link
            :href="route('register')"
            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
          >
            Register
          </Link>
        </template>
      </nav>
      <div class="flex items-center space-x-4">
        <div class="hidden lg:flex items-center space-x-2 border-r pr-4 border-gray-200">
          <button class="text-sm font-medium">EN</button>
          <span class="text-gray-300">|</span>
          <button class="text-sm font-medium text-gray-500">HT</button>
        </div>
        <a
          href="#live"
          class="hidden lg:inline-block bg-red text-white px-4 py-2 rounded-button font-medium hover:bg-opacity-90 transition duration-300 whitespace-nowrap"
        >
          <i class="ri-live-line mr-1"></i> Live Stream
        </a>
        <button class="lg:hidden text-primary w-10 h-10 flex items-center justify-center">
          <i class="ri-menu-line ri-lg"></i>
        </button>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
</script>

<style scoped></style>
