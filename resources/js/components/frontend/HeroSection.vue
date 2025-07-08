<template>
  <!-- Hero Section -->
  <section class="min-h-screen flex items-center pt-24" :style="backgroundStyle">
    <div class="container mx-auto px-4 py-20 text-white">
      <div class="max-w-3xl">
        <h1 class="text-5xl font-bold mb-6">
          {{ props.homepage.hero_title || "Welcome to Our Church" }}
        </h1>
        <h2 class="text-2xl mb-8 text-secondary">
          {{ props.homepage.hero_subtitle || "Where Faith Meets Community" }}
        </h2>
        <p class="text-lg mb-10 max-w-2xl">
          {{
            props.homepage.hero_description ||
            "Join us for a transformative worship experience"
          }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 mb-12">
          <Link
            :href="route('contact.us')"
            class="bg-secondary text-primary px-8 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 text-center !rounded-button whitespace-nowrap"
          >
            Join Us This Sabbath
          </Link>
          <Link
            :href="route('about.us')"
            class="bg-transparent border-2 border-white px-8 py-3 rounded-button font-semibold hover:bg-white hover:text-primary transition duration-300 text-center !rounded-button whitespace-nowrap"
          >
            Learn More
          </Link>
        </div>
        <div class="bg-opacity-10 backdrop-blur-sm p-6 rounded-lg max-w-md">
          <h3 class="text-xl font-semibold mb-4">
            {{ homepage.stay_heading || "Stay Connected" }}
          </h3>
          <p class="mb-4">
            {{
              homepage.stay_description ||
              "Subscribe to our newsletter for updates and announcements."
            }}
          </p>

          <form
            @submit.prevent="submit"
            class="flex flex-col sm:flex-row gap-2 w-full max-w-md"
          >
            <div class="flex flex-col flex-grow">
              <input
                type="email"
                v-model="form.email"
                placeholder="Your email address"
                class="px-4 py-3 rounded-button bg-white bg-opacity-20 text-black placeholder-black border-none w-full"
              />
              <div v-if="form.errors.email" class="text-red-600 text-sm mt-1">
                {{ form.errors.email }}
              </div>
              <div
                v-else-if="form.recentlySuccessful"
                class="text-green-600 text-sm mt-1"
              >
                Subscription successful!
              </div>
            </div>

            <button
              type="submit"
              :disabled="form.processing"
              class="bg-secondary text-primary px-6 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 whitespace-nowrap h-[48px]"
            >
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps<{
  homepage: {
    hero_title?: string;
    hero_subtitle?: string;
    hero_description?: string;
    stay_heading?: string;
    stay_description?: string;
    heroimage: string | undefined;
  };
}>();
console.log(props);
const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("subscriber.subscribe"), {
    onSuccess: () => {
      form.reset();
    },
  });
};

const defaultImage =
  "https://readdy.ai/api/search-image?query=diverse%2520congregation%2520in%2520a%2520modern%2520church%2520setting%2520with%2520warm%2520lighting%2C%2520people%2520worshipping%2520together%2C%2520hands%2520raised%2520in%2520praise%2C%2520joyful%2520expressions%2C%2520professional%2520photography%2C%2520high%2520quality%2C%2520inspirational%2520atmosphere&width=1920&height=1080&seq=12345&orientation=landscape";

const backgroundStyle = computed(() => ({
  backgroundImage: `linear-gradient(rgba(27, 49, 71, 0.7), rgba(27, 49, 71, 0.7)), url('${
    props.homepage.heroimage ? "/storage/" + props.homepage.heroimage : defaultImage
  }')`,
  backgroundSize: "cover",
  backgroundPosition: "center",
  maxHeight: "450px",
}));
</script>

<style scoped></style>
