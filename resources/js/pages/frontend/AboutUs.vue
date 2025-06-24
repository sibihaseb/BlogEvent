<template>
  <Head title="About Us" />
  <FrontendLayout>
    <HeroSectionPage
      heading="About Us"
      subheading="Connect with Shekinah Church: Join Our Spiritual Community"
      text=""
    />
    <section class="py-16">
      <div class="container mx-auto px-4 max-w-6xl">
        <!-- <h1 class="text-center text-5xl font-bold">Church Location</h1> -->
        <div class="flex gap-4 flex-col md:flex-row mt-10">
          <div class="flex-1 grid gap-2">
            <h1>
              <span class="text-3xl font-semibold">Shekinah Haitian SDA Church</span>
            </h1>
            <p>
              Welcome to Shekinah Haitian SDA Church, the first Haitian Seventh-Day
              Adventist church in Fort Worth, Texas. We are a warm and loving congregation
              dedicated to spreading the message of God's love through vibrant worship,
              inspiring preaching, uplifting music, engaging kid programs, dynamic youth
              activities, and delicious Haitian food. We invite you to join us on this
              incredible journey of faith and discovery.
            </p>
            <p>
              Our dedicated team is the heart and soul serving God and our community with
              integrity, compassion, and excellence under the direction of our pastor and
              with the help of passionate leaders and volunteers. With diverse gifts and
              talents, we work collaboratively to create an atmosphere that encourages
              spiritual growth, discipleship, and a deepening relationship with Jesus
              Christ.
            </p>
          </div>
          <div class="flex-1 ml-5">
            <div class="flex gap-2 items-start space-x-4 mb-4">
              <div class="flex-shrink-0">
                <div
                  class="h-10 w-10 rounded-full bg-[#e4a853] flex items-center justify-center"
                >
                  <Building class="text-black" />
                </div>
              </div>
              <div>
                <h3 class="text-xl font-semibold">Purpose and Goals</h3>
                <p class="mt-2">
                  Our goals include fostering spiritual growth, nurturing strong family
                  foundations, equipping the next generation, and promoting unity and
                  community service.
                </p>
              </div>
            </div>
            <div class="flex gap-2 items-start space-x-4 mb-4">
              <div class="flex-shrink-0">
                <div
                  class="h-10 w-10 rounded-full bg-[#e4a853] flex items-center justify-center"
                >
                  <Users class="text-black" />
                </div>
              </div>
              <div>
                <h3 class="text-xl font-semibold">Introduction to the Team</h3>
                <p class="mt-2">
                  With diverse gifts and talents, we work collaboratively to create an
                  atmosphere that encourages spiritual growth, discipleship, and a
                  deepening relationship with Jesus Christ.
                </p>
              </div>
            </div>
            <div class="flex gap-2 items-start space-x-4">
              <div class="flex-shrink-0">
                <div
                  class="h-10 w-10 rounded-full bg-[#e4a853] flex items-center justify-center"
                >
                  <Award class="text-black" />
                </div>
              </div>
              <div>
                <h3 class="text-xl font-semibold">Achievements</h3>
                <p class="mt-2">
                  Shekinah Haitian SDA Church has achieved several significant milestones,
                  including community outreach programs, youth mentorship, and
                  establishing the first Haitian Seventh-Day Adventist congregation in
                  Fort Worth.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-gradient-to-r from-primary to-blue-900 py-12">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
          <div class="w-full md:flex-1">
            <form
              @submit.prevent="submit"
              class="bg-white p-8 rounded-lg shadow-lg max-w-xl mx-auto"
            >
              <h3 class="text-3xl font-semibold text-primary mb-4">Get in touch today</h3>
              <h3 class="text-lg font-semibold text-primary mb-4">
                We'd love to hear from you
              </h3>
              <div class="space-y-5">
                <input
                  type="text"
                  required
                  placeholder="Enter Your Name"
                  v-model="form.name"
                  class="w-full px-4 text-black py-3 rounded-button border focus:border-secondary"
                />
                <InputError :message="form.errors.name" />
                <input
                  required
                  type="email"
                  v-model="form.email"
                  placeholder="Enter Your Email"
                  class="w-full px-4 py-3 text-black rounded-button border focus:border-secondary"
                />
                <input
                  required
                  v-model="form.subject"
                  type="text"
                  placeholder="Subject"
                  class="w-full px-4 py-3 text-black rounded-button border focus:border-secondary"
                />
                <textarea
                  v-model="form.message"
                  required
                  class="w-full px-4 py-3 text-black rounded-button border focus:border-secondary"
                  placeholder="Message"
                  rows="6"
                ></textarea>
                <button
                  :disabled="form.processing"
                  type="submit"
                  class="w-full bg-secondary text-primary px-6 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300"
                >
                  <LoaderCircle
                    v-if="form.processing"
                    class="mr-2 h-4 w-4 animate-spin"
                  />
                  Send Message
                </button>
              </div>
              <p class="text-sm text-gray-500 mt-6 text-center">
                Join 2,000+ members already in our community
              </p>
            </form>
          </div>

          <div class="text-white max-w-xl">
            <h2 class="text-4xl font-bold mb-4">
              Connect with Shekinah: Join Our Spiritual Family
            </h2>
            <Accordion :accordionItems="accordionItems" />
          </div>
        </div>
      </div>
    </section>
     <section id="events" class="py-16">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-primary mb-2">Our Team</h2>
          <p class="text-gray-600 max-w-2xl mx-auto">
            Join us for these special gatherings and be part of our community.
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
          <div
            v-for="staff in visibleEventstaff"
            :key="staff.id"
            class="bg-white rounded-lg overflow-hidden shadow-md event-card transition duration-300"
          >
            <div class="h-80 bg-gray-200 relative">
              <img
                :src="'storage/' + staff.image || defaultImage"
                :alt="staff.name"
                class="w-full h-full object-cover object-top"
              />
            </div>
            <div class="p-6">
              <h3 class="text-xl font-semibold mb-2">{{ staff.name }}</h3>
              <p class="text-gray-600 mb-4">{{ staff.position ?? "" }}</p>
              <div class="flex items-center text-gray-500 mb-4">
                <i class="ri-time-line mr-2"></i>
              
              </div>
             
             
            </div>
          </div>
        </div>

        <div class="text-center mt-10" v-if="props.eventstaff.length > 10">
          <button
            @click="loadMore"
            v-if="!allLoaded"
            :class="[
              'inline-block border-2 px-8 py-3 rounded-button font-semibold transition duration-300 whitespace-nowrap',
              allLoaded
                ? 'bg-gray-300 text-gray-600 cursor-not-allowed'
                : 'border-primary text-primary hover:bg-primary hover:text-white',
            ]"
          >
            {{ allLoaded ? "All Events Loaded" : "Load More Events" }}
          </button>
        </div>
      </div>
    </section>
  </FrontendLayout>
</template>
<script setup lang="ts">
import { Head, useForm } from "@inertiajs/vue3";
import FrontendLayout from "@/layouts/FrontendLayout.vue";
import HeroSectionPage from "@/components/frontend/HeroSectionPage.vue";
import Accordion from "@/components/Accordion.vue";
import { AccordionData } from "@/client";
import InputError from "@/components/InputError.vue";
import { LoaderCircle, Building, Users, Award } from "lucide-vue-next";
import { onMounted } from "vue";
import { ref, computed } from "vue";
import type { EventStaff } from "@/client";

const form = useForm({
  name: "",
  email: "",
  subject: "",
  message: "",
});

const submit = () => {
  form.post(route("contact.us.store"), {
    forceFormData: true,

    // Called when the request is successful
    onSuccess: () => {
      // Reset the form after a successful submission
      form.reset();
    },

    // Called if there are validation errors
    onError: (errors) => {
      console.log("Validation errors:", errors);
    },

    // Called regardless of success or error (after request completes)
    onFinish: () => {
      console.log("Form submission finished.");
    },
  });
};

onMounted(() => {
  window.scrollTo({
    top: 500,
    left: 200,
    behavior: "smooth",
  });
  console.log("Contact Us page mounted, scroll position set.");
});

const accordionItems: AccordionData[] = [
  {
    value: "item-1",
    title: "Is it accessible?",
    content: "Yes. It adheres to the WAI-ARIA design pattern.",
  },
  {
    value: "item-2",
    title: "Is it unstyled?",
    content: "Yes. It's unstyled by default, giving you freedom over the look and feel.",
  },
  {
    value: "item-3",
    title: "Can it be animated?",
    content: "Yes! You can use the transition prop to configure the animation.",
  },
];
// Default fallback image
const defaultImage = "https://via.placeholder.com/600x400?text=Event+Image";

// Props
const props = defineProps<{
  eventstaff: EventStaff[];
}>();

// Reactive data
const displayLimit = ref(9);

// Computed visible events
const visibleEventstaff = computed(() => props.eventstaff.slice(0, displayLimit.value));

// Load more function
const loadMore = () => {
  displayLimit.value += 9;
};

// Check if all events are loaded
const allLoaded = computed(() => displayLimit.value >= props.eventstaff.length);
</script>
