<template>
  <Head title="Our Ministries" />
  <FrontendLayout>
    <HeroSectionPage
      :heading="heroProps.heading"
      :subheading="heroProps.subheading"
      :text="heroProps.text"
    />
    <section id="ministries" class="py-16">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-primary dark:text-white mb-2">
            Our Ministries
          </h2>
          <p class="text-gray-600 max-w-2xl dark:text-white mx-auto">
            Discover the various ways you can connect, serve, and grow within our church
            community.
          </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          <div
            class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
          >
            <div
              class="w-16 h-16 bg-blue-900 rounded-full mb-6 flex items-center justify-center"
            >
              <User class="text-white" :size="30" />
            </div>
            <h3 class="text-xl dark:text-black font-semibold mb-3">Youth Ministry</h3>
            <p class="text-gray-600 mb-4">
              Empowering young people to grow in their faith through Bible study,
              mentorship, and community service.
            </p>
            <a
              href="#"
              class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
              >Learn More <ArrowRight class="ml-2" :size="20"
            /></a>
          </div>
          <div
            class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
          >
            <div
              class="w-16 h-16 bg-secondary rounded-full mb-6 flex items-center justify-center"
            >
              <Music2 class="text-primary" :size="30" />
              <i class="ri-music-line ri-xl text-primary"></i>
            </div>
            <h3 class="text-xl font-semibold dark:text-black mb-3">Music Ministry</h3>
            <p class="text-gray-600 mb-4">
              Using the gift of music to worship God and create an atmosphere for His
              presence in our services.
            </p>
            <a
              href="#"
              class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
              >Learn More <ArrowRight class="ml-2" :size="20"
            /></a>
          </div>
          <div
            class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
          >
            <div
              class="w-16 h-16 bg-green-900 rounded-full mb-6 flex items-center justify-center"
            >
              <BookOpen class="text-white" :size="30" />
            </div>
            <h3 class="text-xl dark:text-black font-semibold mb-3">Bible Study</h3>
            <p class="text-gray-600 mb-4">
              Deepening our understanding of God's Word through group studies,
              discussions, and personal application.
            </p>
            <a
              href="#"
              class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
              >Learn More <ArrowRight class="ml-2" :size="20"
            /></a>
          </div>
          <div
            class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
          >
            <div
              class="w-16 h-16 bg-red-700 rounded-full mb-6 flex items-center justify-center"
            >
              <HandHeart class="text-white" :size="30" />
              <i class="ri-hand-heart-line ri-xl text-white"></i>
            </div>
            <h3 class="text-xl dark:text-black font-semibold mb-3">Community Outreach</h3>
            <p class="text-gray-600 mb-4">
              Serving our local community through food drives, clothing distribution, and
              various support programs.
            </p>
            <a
              href="#"
              class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
              >Learn More <ArrowRight class="ml-2" :size="20"
            /></a>
          </div>
          <div
            class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
          >
            <div
              class="w-16 h-16 bg-primary rounded-full mb-6 flex items-center justify-center"
            >
              <HandHelping class="text-white" :size="30" />
            </div>
            <h3 class="text-xl dark:text-black font-semibold mb-3">Prayer Ministry</h3>
            <p class="text-gray-600 mb-4">
              Interceding for the needs of our church, community, and world through
              dedicated prayer groups.
            </p>
            <a
              href="#"
              class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
              >Learn More <ArrowRight class="ml-2" :size="20"
            /></a>
          </div>
          <div
            class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
          >
            <div
              class="w-16 h-16 bg-blue-900 rounded-full mb-6 flex items-center justify-center"
            >
              <Users class="text-white" :size="30" />
              <i class="ri-parent-line ri-xl text-white"></i>
            </div>
            <h3 class="text-xl dark:text-black font-semibold mb-3">Family Ministry</h3>
            <p class="text-gray-600 mb-4">
              Supporting and strengthening families through counseling, workshops, and
              fellowship activities.
            </p>
            <a
              href="#"
              class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
              >Learn More <ArrowRight class="ml-2" :size="20"
            /></a>
          </div>
          <div
            v-for="ministry in ministries"
            :key="ministry.id"
            class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
          >
            <div class="w-16 h-16 rounded-full mb-6 flex items-center justify-center">
              <img
                :src="'storage/' + ministry.icon"
                alt="Ministry Icon"
                class="w-46 h-46 object-cover"
              />
            </div>
            <h3 class="text-xl dark:text-black font-semibold mb-3">
              {{ ministry.name }}
            </h3>
            <p class="text-gray-600 mb-4">
              {{ ministry.description }}
            </p>
            <a
              href="#"
              class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
              >Learn More <ArrowRight class="ml-2" :size="20"
            /></a>
          </div>
        </div>
      </div>
    </section>
  </FrontendLayout>
</template>

<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import FrontendLayout from "@/layouts/FrontendLayout.vue";
import HeroSectionPage from "@/components/frontend/HeroSectionPage.vue";
import { Ministry } from "@/client";
import {
  User,
  Users,
  Music2,
  BookOpen,
  HandHeart,
  HandHelping,
  ArrowRight,
} from "lucide-vue-next";
import { computed } from "vue";

const props = defineProps<{
  allministries: Ministry[];
}>();

const ministries = computed(() => props.allministries);

const heroProps = {
  heading: "Our Ministerys",
  subheading: "Join Us",
  text:
    "Experience a warm and welcoming community where faith and fellowship come together.",
};
</script>

<style scoped></style>
