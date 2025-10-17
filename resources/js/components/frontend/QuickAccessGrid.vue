<template>
  <section class="py-16">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Service Times -->
        <div
          class="p-8 rounded-lg text-center transition duration-300 bg-gray-50 dark:bg-neutral-900 hover:shadow-lg dark:hover:shadow-xl dark:shadow-black/30"
        >
          <div
            class="w-16 h-16 bg-primary rounded-full mx-auto mb-4 flex items-center justify-center"
          >
            <Clock3 class="text-white" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
            {{ props.homepage.info_cards[0].title || "Service Times" }}
          </h3>
          <p
            v-html="props.homepage.info_cards?.[0]?.description ?? ' '"
            class="text-gray-600 dark:text-gray-300"
          ></p>
        </div>

        <!-- Watch Online -->
        <div
          class="p-8 rounded-lg text-center transition duration-300 bg-gray-50 dark:bg-neutral-900 hover:shadow-lg dark:hover:shadow-xl dark:shadow-black/30"
        >
          <div
            class="w-16 h-16 bg-secondary rounded-full mx-auto mb-4 flex items-center justify-center"
          >
            <SquarePlay class="text-primary" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
            {{ props.homepage.info_cards[1].title || "Watch Online" }}
          </h3>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            {{
              props.homepage.info_cards[1].description ||
              "Join our services live or watch past sermons."
            }}
          </p>
          <a
            :href="props.homepage.info_cards[1].button_url"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
          >
            {{ props.homepage.info_cards[1].button_text || "View Livestream" }}
            <ArrowRight class="ml-2" :size="20" />
          </a>
        </div>

        <!-- Give Online -->
        <div
          class="p-8 rounded-lg text-center transition duration-300 bg-gray-50 dark:bg-neutral-900 hover:shadow-lg dark:hover:shadow-xl dark:shadow-black/30"
        >
          <div
            class="w-16 h-16 bg-green-900 rounded-full mx-auto mb-4 flex items-center justify-center"
          >
            <HandHeart class="text-white" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
            {{ props.homepage.info_cards[2].title || "Give Online" }}
          </h3>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            {{
              props.homepage.info_cards[2].description ||
              "Support our mission and ministries through online giving."
            }}
          </p>
          <a
            :href="props.homepage.info_cards[2].button_url"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
          >
            {{ props.homepage.info_cards[2].button_text || "Donate Now" }}
            <ArrowRight class="ml-2" :size="20" />
          </a>
        </div>

        <!-- New Here -->
        <!-- <div
          class="p-8 rounded-lg text-center transition duration-300 bg-gray-50 dark:bg-neutral-900 hover:shadow-lg dark:hover:shadow-xl dark:shadow-black/30"
        >
          <div
            class="w-16 h-16 bg-red-700 rounded-full mx-auto mb-4 flex items-center justify-center"
          >
            <UserRoundPlus class="text-white" :size="30" />
          </div>
          <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">
            {{ props.homepage.info_cards[3].title || "New Here?" }}
          </h3>
          <p class="text-gray-600 dark:text-gray-300 mb-4">
            {{
              props.homepage.info_cards[3].description ||
              "We'd love to welcome you to our church family."
            }}
          </p>
          <Link
            :href="route('login')"
            class="text-primary font-medium hover:text-secondary inline-flex items-center dark:hover:text-white"
          >
            {{ props.homepage.info_cards[3].button_text || "Get Started" }}
            <ArrowRight class="ml-2" :size="20" />
          </Link>
        </div> -->
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { Clock3, SquarePlay, HandHeart, ArrowRight } from "lucide-vue-next";

const props = defineProps<{
  homepage: {
    info_cards: {
      title: string;
      description: string;
      button_text: string;
      button_url: string;
    }[];
  };
}>();
</script>

<style scoped></style>
