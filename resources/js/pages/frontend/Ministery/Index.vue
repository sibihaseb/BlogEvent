<template>
  <Head title="Our Ministries" />
  <FrontendLayout>
    <HeroSectionPage
      :heading="props.ministryPage?.heroheading ?? 'Our Ministerys'"
      :subheading="props.ministryPage?.herosubheading ?? 'Join Us'"
      :text="
        props.ministryPage?.herotext ??
        'Experience a warm and welcoming community where faith and fellowship come together.'
      "
      :image="props.ministryPage?.heroimage"
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
            v-for="ministry in ministries"
            :key="ministry.id"
            class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
          >
            <div
              class="w-16 h-16 rounded-full mb-6 flex items-center justify-center"
              :class="getBackgroundClass(ministry.name)"
            >
              <component
                v-if="getIconComponent(ministry.name)"
                :is="getIconComponent(ministry.name)"
                class="text-white"
                :size="30"
              />
              <img
                v-else
                :src="'/storage/' + ministry.icon"
                alt="Ministry Icon"
                class="w-10 h-10 object-cover rounded-full"
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
            >
              Learn More <ArrowRight class="ml-2" :size="20" />
            </a>
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
  ministryPage: any;
}>();

const ministries = computed(() => props.allministries);

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

const getIconComponent = (name: string) => {
  return iconMap[name] || null;
};

const getBackgroundClass = (name: string) => {
  return bgColorMap[name] || "bg-gray-300";
};
</script>

<style scoped></style>
