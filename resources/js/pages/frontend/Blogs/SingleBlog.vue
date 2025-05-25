<template>

  <Head :title="churcheventBlog.name" />
  <FrontendLayout>
    <HeroSectionPage :heading="churcheventBlog.name" :subheading="churcheventBlog.short_description"
      :text="'Join us and be part of something meaningful and inspiring.'" />

    <section class="py-16">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
          <img :src="churcheventBlog.image_url || defaultImage" :alt="churcheventBlog.name"
            class="w-full h-120 object-cover object-top" />
          <div class="p-6">
            <h1 class="text-3xl font-bold text-primary mb-4">{{ churcheventBlog.name }}</h1>
            <p class="text-gray-600 text-lg mb-6">{{ churcheventBlog.short_description }}</p>

            <div class="grid md:grid-cols-2 gap-4 mb-6">
              <div class="flex items-start space-x-3">
                <i class="ri-time-line text-xl text-primary"></i>
                <div>
                  <h4 class="font-semibold text-gray-700">Date</h4>
                  <p class="text-gray-600">
                    {{ formateDate(churcheventBlog.createdAt) }}
                  </p>
                </div>
              </div>

              <div class="flex items-start space-x-3" v-if="churcheventBlog.location">
                <i class="ri-map-pin-line text-xl text-primary"></i>
                <div>
                  <h4 class="font-semibold text-gray-700">Location</h4>
                  <p class="text-gray-600">{{ churcheventBlog.location }}</p>
                </div>
              </div>
            </div>

            <div class="prose max-w-none">
              <p v-html="decodeAndStripQuotes(churcheventBlog.description)"></p>
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
import type { EventBlogs } from "@/client";
import moment from "moment";

// Props
const props = defineProps<{
  churcheventBlog: EventBlogs;
}>();

// Default fallback image
const defaultImage = "https://picsum.photos/200/300?grayscale";

// Formatting helpers
const formateDate = (date: Date | string) => moment(date).format("MMMM Do, YYYY");

// Extract the event data
const churcheventBlog = props.churcheventBlog;

function decodeAndStripQuotes(html: string) {
  return html.replace(/"/g, "");
}
</script>
