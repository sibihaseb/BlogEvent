<template>
  <section class="py-16">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Service Times -->
        <div
          class="p-8 rounded-lg text-center transition duration-300 bg-gray-50 dark:bg-neutral-900 hover:shadow-lg dark:hover:shadow-xl dark:shadow-black/30"
        >
          <div
            class="w-16 h-16 bg-primary rounded-full mx-auto mb-4 flex items-center justify-center"
          >
            <Clock3 class="text-white" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
            Service Times
          </h3>
          <p class="text-gray-600 dark:text-gray-300">Sabbath School: 9:30 AM</p>
          <p class="text-gray-600 dark:text-gray-300">Divine Service: 11:00 AM</p>
          <p class="text-gray-600 dark:text-gray-300">Prayer Meeting: Wed 7:00 PM</p>
        </div>

        <!-- Watch Online -->
        <div
          class="p-8 rounded-lg text-center transition duration-300 bg-gray-50 dark:bg-neutral-900 hover:shadow-lg dark:hover:shadow-xl dark:shadow-black/30"
        >
          <div
            class="w-16 h-16 bg-secondary rounded-full mx-auto mb-4 flex items-center justify-center"
          >
            <SquarePlay class="text-primary" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
            Watch Online
          </h3>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            Join our services live or watch past sermons.
          </p>
          <a
            href="#"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
          >
            View Livestream <ArrowRight class="ml-2" :size="20" />
          </a>
        </div>

        <!-- Give Online -->
        <div
          class="p-8 rounded-lg text-center transition duration-300 bg-gray-50 dark:bg-neutral-900 hover:shadow-lg dark:hover:shadow-xl dark:shadow-black/30"
        >
          <div
            class="w-16 h-16 bg-green-900 rounded-full mx-auto mb-4 flex items-center justify-center"
          >
            <HandHeart class="text-white" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
            Give Online
          </h3>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            Support our mission and ministries securely online.
          </p>
          <a
            href="#"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
          >
            Donate Now <ArrowRight class="ml-2" :size="20" />
          </a>
        </div>

        <!-- New Here -->
        <div
          class="p-8 rounded-lg text-center transition duration-300 bg-gray-50 dark:bg-neutral-900 hover:shadow-lg dark:hover:shadow-xl dark:shadow-black/30"
        >
          <div
            class="w-16 h-16 bg-red-700 rounded-full mx-auto mb-4 flex items-center justify-center"
          >
            <UserRoundPlus class="text-white" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
            New Here?
          </h3>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            We'd love to welcome you to our church family.
          </p>
          <Link
            :href="route('register')"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
          >
            Learn More <ArrowRight class="ml-2" :size="20" />
          </Link>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import {
  Clock3,
  SquarePlay,
  HandHeart,
  UserRoundPlus,
  ArrowRight,
} from "lucide-vue-next";
</script>

<style scoped></style>
