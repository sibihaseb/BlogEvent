<template>
  <header class="bg-white shadow-md fixed w-full z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center">
        <img src="/images/logo.png" alt="Shekinah Logo" class="h-16" />
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
          >About</Link
        >
        <a
          :href="route('our.sponsers')"
          class="text-primary hover:text-secondary font-bold transition duration-300"
          >Ministries</a
        >
        <Link
          :href="route('prayer.page')"
          class="text-primary hover:text-secondary font-bold transition whitespace-nowrap duration-300"
          >Prayer Requests</Link
        >
        <Link
          :href="route('contact.us')"
          class="text-primary hover:text-secondary font-bold transition duration-300"
          >Contact</Link
        >
        <a
          href="https://adventistgiving.org/donate/ANWB24"
          target="_blank"
          class="text-primary hover:text-secondary font-bold transition duration-300"
          >Give</a
        >
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
        <!-- Hamburger button using Lucide Menu -->
        <button
          @click="toggleSidebar"
          class="lg:hidden text-primary w-10 h-10 flex items-center justify-center"
        >
          <Menu :size="28" />
        </button>
      </div>
    </div>

    <!-- Mobile Sidebar -->
    <transition name="slide">
      <div v-if="isSidebarOpen" class="fixed inset-0 z-50 bg-opacity-50 flex lg:hidden">
        <div class="w-64 bg-white h-full shadow-lg p-6">
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-primary">Menu</h2>
            <button @click="toggleSidebar" class="text-gray-600 text-2xl font-bold">
              &times;
            </button>
          </div>
          <nav class="flex flex-col space-y-4">
            <Link
              @click="toggleSidebar"
              :href="route('home')"
              class="text-primary font-bold"
              >Home</Link
            >
            <Link
              @click="toggleSidebar"
              :href="route('about.us')"
              class="text-primary font-bold"
              >About Us</Link
            >
            <a
              @click="toggleSidebar"
              :href="route('our.sponsers')"
              class="text-primary font-bold"
              >Ministries</a
            >
            <Link
              @click="toggleSidebar"
              :href="route('prayer.page')"
              class="text-primary font-bold"
              >Prayer Requests</Link
            >
            <Link
              @click="toggleSidebar"
              :href="route('contact.us')"
              class="text-primary font-bold"
              >Contact</Link
            >
            <a
              @click="toggleSidebar"
              href="https://www.zeffy.com/donation-form/shekinah-sda-church"
              target="_blank"
              class="text-primary font-bold"
              >Give</a
            >
          </nav>
        </div>
        <div class="flex-1" @click="toggleSidebar"></div>
      </div>
    </transition>
  </header>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { Video, Menu } from "lucide-vue-next";

const isSidebarOpen = ref(false);
const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<style scoped>
.rounded-button {
  border-radius: 8px;
}

.rounded-lg {
  border-radius: 8px;
}

/* Transition for mobile sidebar */
.slide-enter-active,
.slide-leave-active {
  transition: all 0.3s ease;
}
.slide-enter-from {
  transform: translateX(-100%);
  opacity: 0;
}
.slide-enter-to {
  transform: translateX(0%);
  opacity: 1;
}
.slide-leave-from {
  transform: translateX(0%);
  opacity: 1;
}
.slide-leave-to {
  transform: translateX(-100%);
  opacity: 0;
}
</style>
