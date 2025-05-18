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
          v-for="event in props.churchevents"
          :key="event.id"
          class="bg-white rounded-lg overflow-hidden shadow-md event-card transition duration-300"
        >
          <div class="h-48 bg-gray-200 relative">
            <img
              :src="'storage/' + event.picture || defaultImage"
              :alt="event.name"
              class="w-full h-full object-cover object-top"
            />
            <div
              class="absolute top-4 left-4 bg-secondary text-primary text-center p-2 rounded-md"
            >
              <span class="block font-bold">{{ formatMonth(event.start_time) }}</span>
              <span class="block text-xl font-bold">{{
                formatDay(event.start_time)
              }}</span>
            </div>
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-2">{{ event.name }}</h3>
            <p class="text-gray-600 mb-4">{{ event.short_description ?? "" }}</p>
            <!-- <div
                v-html="decodeAndStripQuotes(event.short_description)"
                class="text-gray-600 mb-4"
              ></div> -->
            <div class="flex items-center text-gray-500 mb-4">
              <i class="ri-time-line mr-2"></i>
              <span
                >{{ formatTime(event.start_time) }} -
                {{ formatTime(event.end_time) }}</span
              >
            </div>
            <div class="flex items-center text-gray-500 mb-6" v-if="event.location">
              <i class="ri-map-pin-line mr-2"></i>
              <span>{{ event.location }}</span>
            </div>
            <a
              href="#"
              class="inline-block bg-primary text-white px-6 py-2 rounded-button font-medium hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap"
              >RSVP Now</a
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

<script setup lang="ts">
import type { ChurchEvent } from "@/client";
import moment from "moment";

const props = defineProps<{
  churchevents: ChurchEvent[];
}>();

const defaultImage = "https://via.placeholder.com/600x400?text=Event+Image";

// Format helpers
const formatMonth = (date: Date | string) => moment(date).format("MMM").toUpperCase();
const formatDay = (date: Date | string) => moment(date).format("D");
const formatTime = (date: Date | string) => moment(date).format("hh:mm A");

// function decodeAndStripQuotes(html: string): string {
//   const txt = document.createElement("textarea");
//   txt.innerHTML = html;
//   return txt.value.replace(/"/g, "");
// }
</script>

<style scoped>
.event-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}
</style>
