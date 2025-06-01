<template>
  <Head :title="churchevent.name" />
  <FrontendLayout>
    <HeroSectionPage
      :heading="churchevent.name"
      :subheading="churchevent.short_description"
      :text="'Join us and be part of something meaningful and inspiring.'"
    />

    <section class="py-16">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="bg-white dark:bg-black rounded-lg shadow-lg overflow-hidden">
          <img
            :src="'/storage/' + churchevent.picture || defaultImage"
            :alt="churchevent.name"
            class="w-full h-120 object-cover object-top"
          />
          <div class="p-6">
            <h1 class="text-3xl font-bold text-primary dark:text-white mb-4">
              {{ churchevent.name }}
            </h1>
            <p class="text-gray-600 dark:text-white text-lg mb-6">
              {{ churchevent.short_description }}
            </p>

            <div class="grid md:grid-cols-2 gap-4 mb-6">
              <div class="flex items-start space-x-3">
                <i class="ri-time-line text-xl text-primary"></i>
                <div>
                  <h4 class="font-semibold text-gray-700 dark:text-white">Time</h4>
                  <p class="text-gray-600 dark:text-white">
                    {{ formatTime(churchevent.start_time) }} -
                    {{ formatTime(churchevent.end_time) }}
                  </p>
                </div>
              </div>

              <div class="flex items-start space-x-3" v-if="churchevent.location">
                <i class="ri-map-pin-line text-xl text-primary"></i>
                <div>
                  <h4 class="font-semibold text-gray-700 dark:text-white">Location</h4>
                  <p class="text-gray-600 dark:text-white">{{ churchevent.location }}</p>
                </div>
              </div>
            </div>

            <div class="prose max-w-none">
              <p v-html="decodeAndStripQuotes(churchevent.description)"></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </FrontendLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import FrontendLayout from "@/layouts/FrontendLayout.vue";
import HeroSectionPage from "@/components/frontend/HeroSectionPage.vue";
import type { ChurchEvent } from "@/client";
import moment from "moment";

// Props
const props = defineProps<{
  churchevent: ChurchEvent;
}>();

// Default fallback image
const defaultImage = "https://via.placeholder.com/800x400?text=Event+Image";

// Formatting helpers
const formatTime = (date: Date | string) => moment(date).format("hh:mm A");

// Extract the event data
const churchevent = props.churchevent;

function decodeAndStripQuotes(html: string) {
  return html.replace(/"/g, "");
}
</script>
