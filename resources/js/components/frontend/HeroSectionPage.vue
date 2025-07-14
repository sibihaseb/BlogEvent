<template>
  <!-- Hero Section -->
  <section class="min-h-screen flex items-center pt-24" :style="backgroundStyle">
    <div class="container mx-auto px-4 py-20 text-white">
      <div class="max-w-3xl">
        <h1 class="text-5xl font-bold mb-6">{{ props.heading }}</h1>
        <h2 class="text-2xl mb-8 text-secondary">{{ props.subheading }}</h2>
        <p class="text-lg mb-10 max-w-2xl">
          {{ props.text }}
        </p>
        <!-- <div class="flex flex-col sm:flex-row gap-4 mb-12">
          <a
            href="#services"
            class="bg-secondary text-primary px-8 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 text-center !rounded-button whitespace-nowrap"
          >
            Join Us This Sabbath
          </a>
          <a
            href="#about"
            class="bg-transparent border-2 border-white px-8 py-3 rounded-button font-semibold hover:bg-white hover:text-primary transition duration-300 text-center !rounded-button whitespace-nowrap"
          >
            Learn More
          </a>
        </div> -->
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { computed } from "vue";
const props = defineProps<{
  heading: string;
  subheading: string;
  text: string;
  image: string | undefined;
}>();

const defaultImage =
  "https://readdy.ai/api/search-image?query=diverse%2520congregation%2520in%2520a%2520modern%2520church%2520setting%2520with%2520warm%2520lighting%2C%2520people%2520worshipping%2520together%2C%2520hands%2520raised%2520in%2520praise%2C%2520joyful%2520expressions%2C%2520professional%2520photography%2C%2520high%2520quality%2C%2520inspirational%2520atmosphere&width=1920&height=1080&seq=12345&orientation=landscape";

const backgroundStyle = computed(() => ({
  backgroundImage: `linear-gradient(rgba(27, 49, 71, 0.7), rgba(27, 49, 71, 0.7)), url('${
    props.image ? "/storage/" + props.image : defaultImage
  }')`,
  backgroundSize: "cover",
  backgroundPosition: "center",
  maxHeight: "450px",
}));
</script>
