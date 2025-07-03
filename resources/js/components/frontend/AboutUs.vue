<template>
  <section id="about" class="py-16">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <h2 class="text-3xl font-bold text-primary mb-6">
            {{ homepage.about_heading || "About Us" }}
          </h2>
          <p class="text-gray-600 mb-6">
            {{
              homepage.about_para_first ||
              "Welcome to the Haitian Heritage Church, a place where faith, culture,"
            }}
          </p>
          <p class="text-gray-600 mb-6">
            {{
              homepage.about_para_second ||
              "We are dedicated to serving our congregation and the wider "
            }}
          </p>
          <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">
              {{ homepage.mission_heading || "Our Mission" }}
            </h3>
            <p class="text-gray-600">
              {{
                homepage.mission_description ||
                "To glorify God through worship, service, and community "
              }}
            </p>
          </div>
          <div class="mb-8">
            <h3 class="text-xl font-semibold mb-4">
              {{ homepage.vision_heading || "Our Vision" }}
            </h3>
            <p class="text-gray-600">
              {{
                homepage.vision_description ||
                "To be a beacon of hope, healing, and spiritual growth, reflecting "
              }}
            </p>
          </div>
          <a
            href="#"
            class="inline-block bg-primary text-white px-8 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap"
          >
            Learn More About Us
          </a>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div class="rounded-lg overflow-hidden h-64">
            <img
              :src="
                homepage.about_image_1
                  ? `storage/${homepage.about_image_1}`
                  : 'https://readdy.ai/api/search-image?query=haitian%2520church%2520congregation%2520singing%2520and%2520worshipping%2C%2520joyful%2520expressions%2C%2520colorful%2520traditional%2520elements%2C%2520warm%2520lighting%2C%2520professional%2520photography&width=600&height=800&seq=77777&orientation=portrait'
              "
              alt="Church Worship"
              class="w-full h-full object-cover object-top"
            />
          </div>
          <div class="rounded-lg overflow-hidden h-64">
            <img
              :src="
                homepage.about_image_2
                  ? `storage/${homepage.about_image_2}`
                  : 'https://readdy.ai/api/search-image?query=church%2520pastor%2520greeting%2520congregation%2520members%2C%2520warm%2520welcoming%2520atmosphere%2C%2520diverse%2520group%2C%2520church%2520interior%2C%2520professional%2520photography&width=600&height=800&seq=88888&orientation=portrait'
              "
              alt="Pastor Greeting"
              class="w-full h-full object-cover object-top"
            />
          </div>
          <div class="rounded-lg overflow-hidden h-64">
            <img
              :src="
                homepage.about_image_3
                  ? `storage/${homepage.about_image_3}`
                  : 'https://readdy.ai/api/search-image?query=church%2520choir%2520in%2520blue%2520and%2520white%2520robes%2C%2520singing%2520passionately%2C%2520church%2520setting%2C%2520professional%2520lighting%2C%2520joyful%2520expressions&width=600&height=800&seq=99999&orientation=portrait'
              "
              alt="Church Choir"
              class="w-full h-full object-cover object-top"
            />
          </div>
          <div class="rounded-lg overflow-hidden h-64">
            <img
              :src="
                homepage.about_image_4
                  ? `storage/${homepage.about_image_4}`
                  : 'https://readdy.ai/api/search-image?query=community%2520service%2520event%2C%2520church%2520members%2520helping%2520others%2C%2520diverse%2520group%2C%2520warm%2520atmosphere%2C%2520professional%2520photography&width=600&height=800&seq=10101&orientation=portrait'
              "
              alt="Community Service"
              class="w-full h-full object-cover object-top"
            />
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
    about_us_heading: string;
    about_us_description: string;
    about_heading?: string;
    about_para_first?: string;
    about_para_second?: string;
    mission_heading?: string;
    mission_description?: string;
    vision_heading?: string;
    vision_description?: string;
    about_image_1?: string;
    about_image_2?: string;
    about_image_3?: string;
    about_image_4?: string;
  };
}>();
</script>

<style scoped></style>
