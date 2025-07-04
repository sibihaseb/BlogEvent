<template>
  <section id="blog" class="py-16">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-primary mb-2 dark:text-white">
          Latest Articles
        </h2>
        <p class="text-gray-600 max-w-2xl mx-auto dark:text-white">
          Insights, testimonies, and spiritual reflections from our church community.
        </p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="blog in props.blogs"
          :key="blog.id"
          class="bg-white rounded-lg overflow-hidden shadow-md transition duration-300 hover:shadow-lg"
        >
          <div class="h-80 bg-gray-200">
            <img
              :src="blog.image_url || 'https://placehold.co/600x400?text=Blog+image'"
              :alt="blog.name"
              class="w-full h-full object-cover object-top"
            />
          </div>
          <div class="p-6">
            <div class="flex items-center text-gray-500 text-sm mb-3">
              <i class="ri-calendar-line mr-2"></i>
              <span>{{ formateDate(blog.createdAt) }}</span>
              <span class="mx-2">•</span>
              <span>{{ blog.type }}</span>
            </div>
            <h3 class="text-xl font-semibold mb-3">
              {{ blog.name }}
            </h3>
            <p class="text-gray-600 mb-4">
              {{ blog.short_description || "No description available." }}
            </p>
            <Link
              :href="route('single.church.event.blog', blog.id)"
              class="text-primary font-medium hover:text-secondary"
              >Read More <i class="ri-arrow-right-line"></i
            ></Link>
          </div>
        </div>
      </div>
      <div class="text-center mt-10">
        <Link
          :href="route('event.blogs')"
          class="inline-block border-2 border-primary text-primary px-8 py-3 rounded-button font-semibold hover:bg-primary hover:text-white transition duration-300 !rounded-button whitespace-nowrap dark:text-white"
        >
          View All Articles
        </Link>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ChurchEvent, EventBlogs } from "@/client";
import { Link } from "@inertiajs/vue3";
import moment from "moment";

const props = defineProps<{
  blogs: EventBlogs[];
}>();
console.log("Blog page props:", props);
const formateDate = (date: Date | string) => moment(date).format("MMMM Do, YYYY");
</script>

<style scoped></style>
