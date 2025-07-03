<template>
  <section class="py-12">
    <div class="container mx-auto px-4">
      <div class="bg-gradient-to-r from-blue-900 to-red-900 rounded-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center">
          <div class="p-8 md:p-12">
            <h2 class="text-3xl font-bold text-white mb-4">
              {{ homepage.church_title || "Haitian Heritage Church" }}
            </h2>
            <p class="text-white text-lg mb-6">
              {{ homepage.church_description || "Celebrating Faith, Culture, and Community" }}
            </p>
            <div class="flex items-center space-x-4">
              <img
                :src="`storage/${homepage.flag_icon}` || 'https://readdy.ai/api/search-image?query=haitian%2520flag%2520waving%2520in%2520sunlight%2C%2520professional%2520photography%2C%2520clear%2520blue%2520sky&width=100&height=100&seq=12121&orientation=squarish'"
                alt="Haitian Flag" class="w-12 h-12 rounded-full object-cover" />
              <div class="text-white">
                <p class="font-semibold">{{ homepage.service_times || "Sabbath Service Times:" }}</p>
                <p>{{ homepage.school_time || "9:30 AM - Sabbath School" }}</p>
                <p>{{ homepage.devine_time || "11:00 AM - Divine Service" }}</p>
              </div>
            </div>
          </div>
          <div class="p-8 md:p-12">
            <!-- {{ homepage.side_side_img }} -->
            <img
              :src="`storage/${homepage.side_img}` || 'https://readdy.ai/api/search-image?query=haitian%2520church%2520choir%2520in%2520traditional%2520dress%2C%2520joyful%2520worship%2C%2520professional%2520photography%2C%2520warm%2520lighting&width=600&height=400&seq=12122&orientation=landscape'"
              alt="Haitian Worship" class="rounded-lg shadow-lg w-full" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { defineProps } from "vue";
const props = defineProps<{
  homepage: {
    church_title?: string;
    church_description?: string;
    side_img?: string;
    flag_icon?: string;
    service_times?: string;
    school_time?: string;
    devine_time?: string;
  };
}>();
</script>

<style scoped></style>
