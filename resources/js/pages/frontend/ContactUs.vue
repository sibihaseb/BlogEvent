<template>

  <Head title="Contact Us" />
  <FrontendLayout>
    <HeroSectionPage heading="Contact Us" subheading="Connect with Shekinah Church: Join Our Spiritual Community"
      text="" />
    <section class="py-16">
      <div class="container mx-auto px-4 max-w-6xl">
        <h1 class="text-center text-5xl font-bold">Church Location</h1>
        <div class="flex gap-4 flex-col md:flex-row mt-30">
          <div class="flex-1 grid gap-2">
            <h1>
              <span class="text-2xl font-semibold">{{ contactUsPage.address_heading }}:</span><br />
              <span class="text-lg text-gray-600 dark:text-white">{{ contactUsPage.address_text }}</span>
            </h1>
            <h1>
              <span class="text-2xl font-semibold">{{ contactUsPage.website_heading }}:</span><br />
              <span class="text-lg text-gray-600 dark:text-white">
                <Link :href="props.appUrl" class="text-primary dark:text-white">{{ contactUsPage.website_text }}</Link>
              </span>
            </h1>
            <h1>
              <span class="text-2xl font-semibold">{{ contactUsPage.email_heading }}:</span><br />
              <span class="text-lg text-gray-600 dark:text-white"><a href="mailto:info@shekinahsda.org"
                  class="text-primary dark:text-white">{{ contactUsPage.email_text }}</a></span>
            </h1>
          </div>
          <div class="flex-1">
            <div class="relative w-full aspect-video rounded-lg overflow-hidden">
              <iframe :src="contactUsPage.map_url" class="absolute top-0 left-0 w-full h-full border-0" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-gradient-to-r from-primary to-blue-900 py-12">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
          <div class="w-full md:flex-1">
            <form @submit.prevent="submit" class="bg-white p-8 rounded-lg shadow-lg max-w-xl mx-auto">
              <h3 class="text-3xl font-semibold text-primary mb-4">Get in touch today</h3>
              <h3 class="text-lg font-semibold text-primary mb-4">
                We'd love to hear from you
              </h3>
              <div class="space-y-5">
                <input type="text" required placeholder="Enter Your Name" v-model="form.name"
                  class="w-full px-4 text-black py-3 rounded-button border focus:border-secondary" />
                <InputError :message="form.errors.name" />
                <input required type="email" v-model="form.email" placeholder="Enter Your Email"
                  class="w-full px-4 py-3 text-black rounded-button border focus:border-secondary" />
                <input required v-model="form.subject" type="text" placeholder="Subject"
                  class="w-full px-4 py-3 text-black rounded-button border focus:border-secondary" />
                <textarea v-model="form.message" required
                  class="w-full px-4 py-3 text-black rounded-button border focus:border-secondary" placeholder="Message"
                  rows="6"></textarea>
                <button :disabled="form.processing" type="submit"
                  class="w-full bg-secondary text-primary px-6 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300">
                  <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
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
            <Accordion :accordionItems="fQuestions" />
          </div>
        </div>
      </div>
    </section>
  </FrontendLayout>
</template>
<script setup lang="ts">
import { Head, Link, useForm } from "@inertiajs/vue3";
import FrontendLayout from "@/layouts/FrontendLayout.vue";
import HeroSectionPage from "@/components/frontend/HeroSectionPage.vue";
import Accordion from "@/components/Accordion.vue";
import { AccordionData } from "@/client";
import InputError from "@/components/InputError.vue";
import { LoaderCircle } from "lucide-vue-next";
import { onMounted } from "vue";
const props = defineProps<{
  appUrl: string;
  fQuestions: AccordionData[];
  contactUsPage: {
    address_heading: string;
    address_text: string;
    website_heading: string;
    website_text: string;
    email_heading: string;
    email_text: string;
    map_url: string
  };
}>();
console.log(props);

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
</script>
