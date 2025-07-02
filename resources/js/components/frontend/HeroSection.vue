<template>
  <!-- Hero Section -->
  <section class="hero-section min-h-screen flex items-center pt-24">
    <div class="container mx-auto px-4 py-20 text-white">
      <div class="max-w-3xl">
        <h1 class="text-5xl font-bold mb-6">{{ props.homepage.hero_title || "Welcome to Our Church" }}</h1>
        <h2 class="text-2xl mb-8 text-secondary">{{ props.homepage.hero_subtitle || "Where Faith Meets Community" }}
        </h2>
        <p class="text-lg mb-10 max-w-2xl">
          {{ props.homepage.hero_description || "Join us for a transformative worship experience" }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 mb-12">
          <a href="#services"
            class="bg-secondary text-primary px-8 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 text-center !rounded-button whitespace-nowrap">
            Join Us This Sabbath
          </a>
          <a href="#about"
            class="bg-transparent border-2 border-white px-8 py-3 rounded-button font-semibold hover:bg-white hover:text-primary transition duration-300 text-center !rounded-button whitespace-nowrap">
            Learn More
          </a>
        </div>
        <div class="bg-opacity-10 backdrop-blur-sm p-6 rounded-lg max-w-md">
          <h3 class="text-xl font-semibold mb-4">{{ homepage.stay_heading || 'Stay Connected' }}</h3>
          <p class="mb-4">{{ homepage.stay_description || 'Subscribe to our newsletter for updates and announcements.'
          }}
          </p>
          <form class="flex flex-col sm:flex-row gap-2">
            <input type="email" placeholder="Your email address"
              class="px-4 py-3 rounded-button bg-white bg-opacity-20 text-black placeholder-black border-none flex-grow" />
            <button type="submit"
              class="bg-secondary text-primary px-6 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 whitespace-nowrap !rounded-button">
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { defineProps } from "vue";

const props = defineProps<{
  homepage: {
    hero_title?: string;
    hero_subtitle?: string;
    hero_description?: string;
    stay_heading?: string;
    stay_description?: string;
  };
}>();
</script>

<style scoped>
.hero-section {
  background-image: linear-gradient(rgba(27, 49, 71, 0.7), rgba(27, 49, 71, 0.7)),
    url("https://readdy.ai/api/search-image?query=diverse%2520congregation%2520in%2520a%2520modern%2520church%2520setting%2520with%2520warm%2520lighting%2C%2520people%2520worshipping%2520together%2C%2520hands%2520raised%2520in%2520praise%2C%2520joyful%2520expressions%2C%2520professional%2520photography%2C%2520high%2520quality%2C%2520inspirational%2520atmosphere&width=1920&height=1080&seq=12345&orientation=landscape");
  background-size: cover;
  background-position: center;
}
</style>
