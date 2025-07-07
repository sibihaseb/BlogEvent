<template>
  <Head :title="ministry.name" />
  <FrontendLayout>
    <HeroSectionPage
      :heading="ministry.name"
      :subheading="ministry.description"
      text=""
      image=""
    />

    <section class="py-16">
      <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white dark:bg-black rounded-lg shadow-lg overflow-hidden">
          <!-- Icon / Image -->
          <div class="flex justify-center pt-6">
            <div
              class="w-20 h-20 rounded-full flex items-center justify-center"
              :class="getBackgroundClass(ministry.name)"
            >
              <component
                v-if="getIconComponent(ministry.name)"
                :is="getIconComponent(ministry.name)"
                class="text-white"
                :size="28"
              />
              <img
                v-else-if="ministry.icon !== null"
                :src="'/storage/' + ministry.icon"
                :alt="ministry.name"
                class="w-10 h-10 object-cover rounded-full"
              />
            </div>
          </div>
          <div class="p-6">
            <h1 class="text-3xl font-bold text-primary dark:text-white mb-4 text-center">
              {{ ministry.name }}
            </h1>
            <p class="text-gray-600 dark:text-white text-lg mb-6 text-center">
              {{ ministry.short_description }}
            </p>

            <div class="grid md:grid-cols-2 gap-4 mb-6">
              <div class="flex items-start space-x-3" v-if="ministry.location">
                <i class="ri-map-pin-line text-xl text-primary"></i>
                <div>
                  <h4 class="font-semibold text-gray-700 dark:text-white">Location</h4>
                  <p class="text-gray-600 dark:text-white">{{ ministry.location }}</p>
                </div>
              </div>
            </div>

            <div class="prose max-w-none dark:prose-invert">
              <p v-html="decodeAndStripQuotes(ministry.description)"></p>
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
import { User, Users, Music2, BookOpen, HandHeart, HandHelping } from "lucide-vue-next";

// Props
defineProps<{
  ministry: any;
}>();
function decodeAndStripQuotes(html: string) {
  return html.replace(/"/g, "");
}

// Dynamic icon mapping
const iconMap: Record<string, any> = {
  "Youth Ministry": User,
  "Music Ministry": Music2,
  "Bible Study": BookOpen,
  "Community Outreach": HandHeart,
  "Prayer Ministry": HandHelping,
  "Family Ministry": Users,
};

const bgColorMap: Record<string, string> = {
  "Youth Ministry": "bg-blue-900",
  "Music Ministry": "bg-secondary",
  "Bible Study": "bg-green-900",
  "Community Outreach": "bg-red-700",
  "Prayer Ministry": "bg-primary",
  "Family Ministry": "bg-blue-900",
};

// Icon resolver
const getIconComponent = (name: string) => {
  return iconMap[name] || null;
};

// Background color resolver
const getBackgroundClass = (name: string) => {
  return bgColorMap[name] || "bg-gray-300";
};
</script>

<style scoped></style>
