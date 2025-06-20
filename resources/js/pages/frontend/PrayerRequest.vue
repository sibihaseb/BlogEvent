<template>

  <Head title="Prayer Request" />
  <FrontendLayout>
    <HeroSectionPage heading="Prayer Request" subheading="SHARE YOUR PRAYER REQUESTS WITH US"
      text="Our compassionate and experienced prayer warriors come from diverse backgrounds, united by a shared commitment to intercede on behalf of others." />
    <!-- <section class="py-16">
      <div class="container mx-auto px-4 max-w-6xl">
        <h1 class="text-center text-5xl font-bold">Church Location</h1>
        <div class="flex gap-4 flex-col md:flex-row mt-30">
          <div class="flex-1 grid gap-2">
            <h1>
              <span class="text-2xl font-semibold">Address:</span><br />
              <span class="text-lg text-gray-600 dark:text-white"
                >205 E Carver St Alvarado, Texas 76009</span
              >
            </h1>
            <h1>
              <span class="text-2xl font-semibold">Website:</span><br />
              <span class="text-lg text-gray-600 dark:text-white"
                ><Link :href="props.appUrl" class="text-primary dark:text-white"
                  >Shekinah Haitian Seventh-Day Adventist Church</Link
                ></span
              >
            </h1>
            <h1>
              <span class="text-2xl font-semibold">Email:</span><br />
              <span class="text-lg text-gray-600 dark:text-white"
                ><a
                  href="mailto:info@shekinahsda.org"
                  class="text-primary dark:text-white"
                  >info@shekinahsda.org</a
                ></span
              >
            </h1>
          </div>
          <div class="flex-1">
            <div class="relative w-full aspect-video rounded-lg overflow-hidden">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3368.619162376989!2d-97.21068012387472!3d32.402569103027055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864e5b96faea41df%3A0xb63ef95cc5029c8c!2s205%20E%20Carver%20St%2C%20Alvarado%2C%20TX%2076009%2C%20USA!5e0!3m2!1sen!2s!4v1748550604995!5m2!1sen!2s"
                class="absolute top-0 left-0 w-full h-full border-0"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <section class="bg-gradient-to-r from-primary to-blue-900 py-12">
      <div class="container mx-auto px-4 max-w-6xl">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
          <div class="w-full md:w-auto">
            <form @submit.prevent="submit" class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto">
              <h3 class="text-3xl font-semibold text-primary mb-4">
                Share your prayer request with us
              </h3>
              <h3 class="text-lg font-semibold text-primary mb-4">
                We'd love to pray for you
              </h3>
              <div class="space-y-4">
                <input type="text" required placeholder="Enter Your Name" v-model="form.name"
                  class="w-full px-4 text-black py-2 rounded-button border focus:border-secondary" />
                <InputError :message="form.errors.name" />
                <input required type="email" v-model="form.email" placeholder="Enter Your Email"
                  class="w-full px-4 py-2 text-black rounded-button border focus:border-secondary" />
                <textarea v-model="form.request" required
                  class="w-full px-4 py-2 text-black rounded-button border focus:border-secondary"
                  placeholder="Request Details"></textarea>
                <div class="flex">
                  <SwitchRoot id="airplane-mode" v-model="form.is_public"
                    class="w-[32px] h-[20px] shadow-sm flex data-[state=unchecked]:bg-[var(--muted)] data-[state=checked]:bg-[var(--secondary)] dark:data-[state=unchecked]:bg-[var(--muted)] dark:data-[state=checked]:bg-[var(--secondary)] border border-[var(--border)] data-[state=checked]:border-[var(--secondary)] dark:border-[var(--border)] rounded-full relative transition-[background] focus-within:outline-none focus-within:border-[var(--ring)] focus-within:shadow-[var(--ring)]">
                    <SwitchThumb
                      class="w-3.5 h-3.5 my-auto bg-[var(--foreground)] text-xs flex items-center justify-center shadow-xl rounded-full transition-transform translate-x-0.5 will-change-transform data-[state=checked]:translate-x-full" />
                  </SwitchRoot>
                  <Label class="text-primary ml-3" for="is_public">Public Request</Label>
                </div>
                <button :disabled="form.processing" type="submit"
                  class="w-full bg-secondary text-primary px-6 py-3 rounded-button font-semibold hover:bg-opacity-90 transition duration-300 !rounded-button whitespace-nowrap">
                  <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
                  Submit Now
                </button>
              </div>
              <p class="text-sm text-gray-500 mt-4 text-center">
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
import { Head, useForm } from "@inertiajs/vue3";
import FrontendLayout from "@/layouts/FrontendLayout.vue";
import HeroSectionPage from "@/components/frontend/HeroSectionPage.vue";
import Accordion from "@/components/Accordion.vue";
import { AccordionData } from "@/client";
import InputError from "@/components/InputError.vue";
import { LoaderCircle } from "lucide-vue-next";
import { SwitchRoot, SwitchThumb } from "reka-ui";
import { onMounted } from "vue";
import { Label } from "@/components/ui/label";

const props = defineProps<{
  fQuestions: AccordionData[];
}>();
const form = useForm({
  name: "",
  email: "",
  request: "",
  is_public: false,
});

const submit = () => {
  form.post(route("prayer.store"), {
    forceFormData: true,

    // Called when the request is successful
    onSuccess: () => {
      // Reset the form after a successful submission
      form.reset();
      console.log("Prayer request submitted successfully.");
    },

    // Called if there are validation errors
    onError: (errors) => {
      console.log("Validation errors:", errors);
    },

    // Called regardless of success or error (after request completes)
    onFinish: () => {
      console.log("Form TEST finished.");
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
