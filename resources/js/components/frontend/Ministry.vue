<template>
  <section class="bg-gradient-to-r from-primary to-blue-900 py-12">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="text-white max-w-xl">
          <h2 class="text-2xl font-bold mb-4">
            {{ homepage.stay_connect_heading || "Stay Connected" }}
          </h2>
          <p class="mb-4">
            {{
              homepage.stay_connect_description ||
              "Join our mailing list to receive the latest updates, "
            }}
          </p>
          <ul class="mb-6">
            <li class="flex items-center mb-2">
              <i class="ri-checkbox-circle-line mr-2"></i>
              {{ homepage.stay_connect_item_1 || "Weekly Devotionals" }}
            </li>
            <li class="flex items-center mb-2">
              <i class="ri-checkbox-circle-line mr-2"></i>
              {{ homepage.stay_connect_item_2 || "Event Reminders" }}
            </li>
            <li class="flex items-center">
              <i class="ri-checkbox-circle-line mr-2"></i>
              {{ homepage.stay_connect_item_3 || "Prayer Request Updates" }}
            </li>
          </ul>
        </div>
        <div class="w-full md:w-auto">
          <form class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto">
            <h3 class="text-xl font-semibold text-primary mb-4">Join Our Community</h3>
            <div class="space-y-4">
              <input
                type="text"
                placeholder="Your Name"
                class="w-full px-4 py-2 rounded-button border focus:border-secondary"
              />
              <input
                type="email"
                placeholder="Your Email"
                class="w-full px-4 py-2 rounded-button border focus:border-secondary"
              />
              <button
                type="submit"
                class="w-full bg-secondary text-primary px-6 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap"
              >
                Subscribe Now
              </button>
            </div>
            <p class="text-sm text-gray-500 mt-4 text-center">
              Join 2,000+ members already in our community
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
  <section id="ministries" class="py-16">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-primary mb-2 dark:text-white">
          Our Ministries
        </h2>
        <p class="text-gray-600 max-w-2xl mx-auto dark:text-white">
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
          <h3 class="text-xl font-semibold mb-3 dark:text-black">Youth Ministry</h3>
          <p class="text-gray-600 mb-4">
            Empowering young people to grow in their faith through Bible study,
            mentorship, and community service.
          </p>
          <a
            href="#"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
            >Learn More
            <ArrowRight class="ml-2" :size="20" />
          </a>
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
          <h3 class="text-xl font-semibold mb-3 dark:text-black">Music Ministry</h3>
          <p class="text-gray-600 mb-4">
            Using the gift of music to worship God and create an atmosphere for His
            presence in our services.
          </p>
          <a
            href="#"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
            >Learn More
            <ArrowRight class="ml-2" :size="20" />
          </a>
        </div>
        <div
          class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
        >
          <div
            class="w-16 h-16 bg-green-900 rounded-full mb-6 flex items-center justify-center"
          >
            <BookOpen class="text-white" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-3 dark:text-black">Bible Study</h3>
          <p class="text-gray-600 mb-4">
            Deepening our understanding of God's Word through group studies, discussions,
            and personal application.
          </p>
          <a
            href="#"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
            >Learn More
            <ArrowRight class="ml-2" :size="20" />
          </a>
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
          <h3 class="text-xl font-semibold mb-3 dark:text-black">Community Outreach</h3>
          <p class="text-gray-600 mb-4">
            Serving our local community through food drives, clothing distribution, and
            various support programs.
          </p>
          <a
            href="#"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
            >Learn More
            <ArrowRight class="ml-2" :size="20" />
          </a>
        </div>
        <div
          class="bg-white p-8 rounded-lg shadow-md ministry-card transition duration-300"
        >
          <div
            class="w-16 h-16 bg-primary rounded-full mb-6 flex items-center justify-center"
          >
            <HandHelping class="text-white" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-3 dark:text-black">Prayer Ministry</h3>
          <p class="text-gray-600 mb-4">
            Interceding for the needs of our church, community, and world through
            dedicated prayer groups.
          </p>
          <a
            href="#"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
            >Learn More
            <ArrowRight class="ml-2" :size="20" />
          </a>
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
          <h3 class="text-xl font-semibold mb-3 dark:text-black">Family Ministry</h3>
          <p class="text-gray-600 mb-4">
            Supporting and strengthening families through counseling, workshops, and
            fellowship activities.
          </p>
          <a
            href="#"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
            >Learn More
            <ArrowRight class="ml-2" :size="20" />
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import {
  User,
  Users,
  Music2,
  BookOpen,
  HandHeart,
  HandHelping,
  ArrowRight,
} from "lucide-vue-next";

defineProps<{
  homepage: {
    stay_connect_heading?: string;
    stay_connect_description?: string;
    stay_connect_item_1?: string;
    stay_connect_item_2?: string;
    stay_connect_item_3?: string;
  };
}>();
</script>

<style scoped></style>
