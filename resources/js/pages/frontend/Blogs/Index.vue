<template>

    <Head title="Welcome" />
    <FrontendLayout>
        <HeroSectionPage :heading="heroProps.heading" :subheading="heroProps.subheading" :text="heroProps.text" />
        <section id="events" class="py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-primary mb-2">All Blogs</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Join us for these special gatherings and be part of our community.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="blog in visibleBlogs" :key="blog.id"
                        class="bg-white rounded-lg overflow-hidden shadow-md blog-card transition duration-300">
                        <div class="h-48 bg-gray-200 relative">

                            <img :src="blog.image_url || defaultImage" :alt="blog.name"
                                class="w-full h-full object-cover object-top" />

                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-gray-500 mb-4">
                                <i class="ri-time-line mr-2"></i>
                                <span>{{ fomateDate(blog.createdAt) }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ blog.type }}</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2">{{ blog.name }}</h3>
                            <p class="text-gray-600 mb-4">{{ blog.short_description ?? "" }}</p>


                            <Link :href="route('single.church.event.blog', blog.id)"
                                class="inline-block bg-primary text-white px-6 py-2 rounded-button font-medium hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap">
                            Details
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-10" v-if="props.churcheventBlogs.length > 10">
                    <button @click="loadMore" v-if="!allLoaded" :class="[
                        'inline-block border-2 px-8 py-3 rounded-button font-semibold transition duration-300 whitespace-nowrap',
                        allLoaded
                            ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                            : 'border-primary text-primary hover:bg-primary hover:text-white',
                    ]">
                        {{ allLoaded ? "All Blogs Loaded" : "Load More Blogs" }}
                    </button>
                </div>
            </div>
        </section>
    </FrontendLayout>
</template>

<script setup lang="ts">
import { ref, computed } from "vue";
import { Head, Link } from "@inertiajs/vue3";
// Update the path below to the correct location of FrontendLayout.vue
import FrontendLayout from "../../../Layouts/FrontendLayout.vue";
import HeroSectionPage from "@/components/frontend/HeroSectionPage.vue";
import type { ChurchEvent, EventBlogs } from "@/client";
import moment from "moment";

// Default fallback image
const defaultImage = "https://via.placeholder.com/600x400?text=Event+Image";

// Props
const props = defineProps<{
    churcheventBlogs: EventBlogs[];
}>();

// Reactive data
const displayLimit = ref(9);

// Computed visible events blogs
const visibleBlogs = computed(() => props.churcheventBlogs.slice(0, displayLimit.value));

// Load more function
const loadMore = () => {
    displayLimit.value += 9;
};

// Check if all events are loaded
const allLoaded = computed(() => displayLimit.value >= props.churcheventBlogs.length);

// Formatting functions
const formatMonth = (date: Date | string) => moment(date).format("MMM").toUpperCase();
const formatDay = (date: Date | string) => moment(date).format("D");
const formateYear = (date: Date | string) => moment(date).format("YYYY");
const fomateDate = (date: Date | string) => moment(date).format("MMM D, YYYY");


// Hero section content
const heroProps = {
    heading: "Event Blogs",
    subheading: "Join Us",
    text:
        "Experience a warm and welcoming community where faith and fellowship come together.",
};
</script>
