<template>
  <Head title="Welcome" />
  <FrontendLayout>
    <HeroSectionPage
      :heading="props.eventPage?.heroheading ?? 'Church Events'"
      :subheading="props.eventPage?.herosubheading ?? 'Join Us'"
      :text="
        props.eventPage?.herotext ??
        'Experience a warm and welcoming community where faith and fellowship come together.'
      "
      :image="props.eventPage?.heroimage"
    />
    <section id="events" class="py-16">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-primary mb-2">All Events</h2>
          <p class="text-gray-600 max-w-2xl mx-auto">
            Join us for these special gatherings and be part of our community.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div
            v-for="event in visibleEvents"
            :key="event.id"
            class="bg-white rounded-lg overflow-hidden shadow-md event-card transition duration-300"
          >
            <div class="h-80 bg-gray-200 relative">
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
              <div class="flex items-center text-gray-500 mb-4">
                <i class="ri-time-line mr-2"></i>
                <span>
                  {{ formatTime(event.start_time) }} -
                  {{ formatTime(event.end_time) }}
                </span>
              </div>
              <div class="flex items-center text-gray-500 mb-6" v-if="event.location">
                <i class="ri-map-pin-line mr-2"></i>
                <span>{{ event.location }}</span>
              </div>
              <Link
                :href="route('single.church.event', event.id)"
                class="inline-block bg-primary text-white px-6 py-2 rounded-button font-medium hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap"
              >
                Details
              </Link>
            </div>
          </div>
        </div>

        <div class="text-center mt-10" v-if="props.churchevents.length > 10">
          <button
            @click="loadMore"
            v-if="!allLoaded"
            :class="[
              'inline-block border-2 px-8 py-3 rounded-button font-semibold transition duration-300 whitespace-nowrap',
              allLoaded
                ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                : 'border-primary text-primary hover:bg-primary hover:text-white',
            ]"
          >
            {{ allLoaded ? "All Events Loaded" : "Load More Events" }}
          </button>
        </div>
      </div>
    </section>
  </FrontendLayout>
</template>

<script setup lang="ts">
import { ref, computed } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import FrontendLayout from "@/layouts/FrontendLayout.vue";
import HeroSectionPage from "@/components/frontend/HeroSectionPage.vue";
import type { ChurchEvent } from "@/client";
import moment from "moment";

// Default fallback image
const defaultImage = "https://via.placeholder.com/600x400?text=Event+Image";

// Props
const props = defineProps<{
  churchevents: ChurchEvent[];
  eventPage: any;
}>();

// Reactive data
const displayLimit = ref(9);

// Computed visible events
const visibleEvents = computed(() => props.churchevents.slice(0, displayLimit.value));

// Load more function
const loadMore = () => {
  displayLimit.value += 9;
};

// Check if all events are loaded
const allLoaded = computed(() => displayLimit.value >= props.churchevents.length);

// Formatting functions
const formatMonth = (date: Date | string) => moment(date).format("MMM").toUpperCase();
const formatDay = (date: Date | string) => moment(date).format("D");
const formatTime = (date: Date | string) => moment(date).format("hh:mm A");
</script>
