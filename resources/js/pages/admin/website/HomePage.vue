<template>
  <Head title="Create Event" />
  <AppLayout>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">Home Page Content</h1>
      <form @submit.prevent="submit" class="space-y-6">
        <!-- Hero Section -->
        <Label>Hero Section</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="title">Title</Label>
            <Input id="title" type="text" v-model="form.hero_title" />
            <InputError :message="form.errors.hero_title" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="subtitle">Sub-title</Label>
            <Input id="subtitle" type="text" v-model="form.hero_subtitle" />
            <InputError :message="form.errors.hero_subtitle" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="description">Description</Label>
            <textarea
              v-model="form.hero_description"
              class="w-full h-24 rounded-md p-2 border border-gray-300"
            ></textarea>
            <InputError :message="form.errors.hero_description" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="picture">Hero Section Image</Label>
            <Input
              id="picture"
              type="file"
              accept="image/*"
              @change="handleHeroFileChange"
            />
          </div>
          <!-- <div class="flex-1 grid gap-2">
            <Label for="type">Image Style</Label>
            <select
              id="states"
              v-model="form.heroimage_style"
              class="text-sm rounded-[var(--radius)] max-h-9 border border-[var(--border)] focus:ring-[var(--ring)] focus:border-[var(--ring)] block w-full p-2 dark:bg-[var(--input)] dark:text-[var(--foreground)] dark:border-[var(--border)] dark:focus:ring-[var(--ring)] dark:focus:border-[var(--ring)]"
            >
              <option selected value="">Choose a Image Style</option>
              <option value="1">1920x1080</option>
              <option value="2">1900x300</option>
            </select>
          </div> -->
          <div class="flex-1 grid gap-2 justify-center">
            <Label for="heading">Preview</Label>
            <img
              :src="
                imagePreviews
                  ? imagePreviews
                  : form.heroimage
                  ? '/storage/' + form.heroimage
                  : 'https://readdy.ai/api/search-image?query=diverse%2520congregation%2520in%2520a%2520modern%2520church%2520setting%2520with%2520warm%2520lighting%2C%2520people%2520worshipping%2520together%2C%2520hands%2520raised%2520in%2520praise%2C%2520joyful%2520expressions%2C%2520professional%2520photography%2C%2520high%2520quality%2C%2520inspirational%2520atmosphere&width=1920&height=1080&seq=12345&orientation=landscape'
              "
              alt="Hero Image Preview"
              class="rounded border border-gray-300 max-w-xs h-auto shadow"
            />
          </div>
        </div>
        <hr />
        <!-- Stay Connected Section -->
        <Label>Stay Connected</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="stay_heading">Heading</Label>
            <Input id="stay_heading" type="text" v-model="form.stay_heading" />
            <InputError :message="form.errors.stay_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="stay_description">Description</Label>
            <textarea
              v-model="form.stay_description"
              class="w-full h-24 rounded-md p-2 border border-gray-300"
            ></textarea>
            <InputError :message="form.errors.stay_description" />
          </div>
        </div>
        <hr />
        <!-- Church Welcome Section -->
        <Label>Welcome to Our Haitian Church Family</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="church_title">Title</Label>
            <Input id="church_title" type="text" v-model="form.church_title" />
            <InputError :message="form.errors.church_title" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="church_description">Description</Label>
            <textarea
              v-model="form.church_description"
              class="w-full h-24 rounded-md p-2 border border-gray-300"
            ></textarea>
            <InputError :message="form.errors.church_description" />
          </div>
          <div class="flex-1 grid">
            <Label for="side_img">Side Poster</Label>

            <input
              id="side_img"
              type="file"
              accept="image/*"
              @change="handleSideImgChange"
              class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
            />

            <InputError :message="form.errors.side_img" />

            <div v-if="previewSideImg" class="mt-1">
              <img
                :src="previewSideImg"
                alt="Side Image Preview"
                class="h-12 w-12 object-contain border rounded"
              />
            </div>
          </div>
        </div>
        <Label>Sabbath Service Times:</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="service_times">Service Time</Label>
            <Input id="service_times" type="text" v-model="form.service_times" />
            <InputError :message="form.errors.church_title" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="school_time">Sabbath School</Label>
            <Input id="school_time" type="text" v-model="form.school_time" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="devine_time">Divine Service</Label>
            <Input id="devine_time" type="text" v-model="form.devine_time" />
          </div>
          <div class="flex-1 grid">
            <Label for="side_img">Flag Icon</Label>
            <input
              id="flag_icon"
              type="file"
              accept="image/*"
              @change="handleflagiconChange"
              class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
            />
            <InputError :message="form.errors.flag_icon" />

            <div v-if="flag_icon_preview" class="mt-1">
              <img
                :src="flag_icon_preview"
                alt="Side Image Preview"
                class="h-12 w-12 object-contain border rounded"
              />
            </div>
          </div>
        </div>
        <hr />
        <!-- Info Cards Section -->
        <Label>Info Cards Section</Label>
        <div
          v-for="(card, index) in form.info_cards"
          :key="index"
          class="flex gap-4 flex-col md:flex-row border p-4 rounded-lg mb-4"
        >
          <div class="flex-1 grid gap-2">
            <Label :for="`card_title_${index}`">Title</Label>
            <Input :id="`card_title_${index}`" type="text" v-model="card.title" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label :for="`card_description_${index}`">Description</Label>
            <textarea
              :id="`card_description_${index}`"
              v-model="card.description"
              class="w-full h-24 rounded-md p-2 border border-gray-300"
            ></textarea>
          </div>
          <div class="flex-1 grid gap-2">
            <Label :for="`card_button_text_${index}`">Button Text</Label>
            <Input
              :id="`card_button_text_${index}`"
              type="text"
              v-model="card.button_text"
            />
          </div>
          <div class="flex-1 grid gap-2">
            <Label :for="`card_button_url_${index}`">Button URL</Label>
            <Input
              :id="`card_button_url_${index}`"
              type="text"
              v-model="card.button_url"
            />
          </div>
        </div>

        <!-- Recurring Events -->
        <Label>Recurring Events</Label>
        <Label for="recurring_event_title">Title</Label>
        <Input
          id="recurring_event_title"
          type="text"
          v-model="form.recurring_event_title"
        />
        <InputError :message="form.errors.recurring_event_title" />
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="text_1">Text 1</Label>
            <Input id="text_1" type="text" v-model="form.text_1" />
            <InputError :message="form.errors.text_1" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="text_2">Text 2</Label>
            <Input id="text_2" type="text" v-model="form.text_2" />
            <InputError :message="form.errors.text_2" />
          </div>

          <div class="flex-1 grid gap-2">
            <Label for="text_3">Text 3</Label>
            <Input id="text_3" type="text" v-model="form.text_3" />
            <InputError :message="form.errors.text_3" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="text_4">Text 4</Label>
            <Input id="text_4" type="text" v-model="form.text_4" />
            <InputError :message="form.errors.text_4" />
          </div>
        </div>
        <hr />
        <!-- stay connected -->
        <Label>Stay Connected</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="stay_heading">Heading</Label>
            <Input id="stay_heading" type="text" v-model="form.stay_connect_heading" />
            <InputError :message="form.errors.stay_connect_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="stay_connect_description">Description</Label>
            <textarea
              v-model="form.stay_connect_description"
              class="w-full h-24 rounded-md p-2 border border-gray-300"
            ></textarea>
            <InputError :message="form.errors.stay_connect_description" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="stay_connect_item_1">Stay Connect Item 1</Label>
            <Input
              id="stay_connect_item_1"
              type="text"
              v-model="form.stay_connect_item_1"
            />
            <InputError :message="form.errors.stay_connect_item_1" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="stay_connect_item_2">Stay Connect Item 2</Label>
            <Input
              id="stay_connect_item_2"
              type="text"
              v-model="form.stay_connect_item_2"
            />
            <InputError :message="form.errors.stay_connect_item_2" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="stay_connect_item_3">Stay Connect Item 3</Label>
            <Input
              id="stay_connect_item_3"
              type="text"
              v-model="form.stay_connect_item_3"
            />
            <InputError :message="form.errors.stay_connect_item_3" />
          </div>
        </div>
        <hr />
        <!-- About Shekinah Haitian SDA Church -->
        <Label>About Section</Label>

        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading">Heading</Label>
            <Input id="heading" type="text" v-model="form.about_heading" />
            <InputError :message="form.errors.about_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Paragraph First</Label>
            <textarea v-model="form.about_para_first"></textarea>
            <InputError :message="form.errors.about_para_first" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Paragraph Second</Label>
            <textarea v-model="form.about_para_second"></textarea>
            <InputError :message="form.errors.about_para_second" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading">Our Mission Heading</Label>
            <Input id="heading" type="text" v-model="form.mission_heading" />
            <InputError :message="form.errors.mission_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Our Mission Description</Label>
            <textarea v-model="form.mission_description"></textarea>
            <InputError :message="form.errors.mission_description" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading">Our Vision Heading</Label>
            <Input id="heading" type="text" v-model="form.vision_heading" />
            <InputError :message="form.errors.vision_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Our Vision Description</Label>
            <textarea v-model="form.vision_description"></textarea>
            <InputError :message="form.errors.vision_description" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading">About Image 1</Label>
            <Input id="about_image_1" type="file" @change="handleFileChange" />
            <InputError :message="form.errors.about_image_1" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="heading">About Image 2</Label>
            <Input id="about_image_2" type="file" @change="handleFileChange" />
            <InputError :message="form.errors.about_image_2" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="heading">About Image 3</Label>
            <Input id="about_image_3" type="file" @change="handleFileChange" />
            <InputError :message="form.errors.about_image_3" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="heading">About Image 4</Label>
            <Input id="about_image_4" type="file" @change="handleFileChange" />
            <InputError :message="form.errors.about_image_4" />
          </div>
        </div>
        <hr />
        <!-- Submit Button -->
        <div class="flex justify-end">
          <Button type="submit" class="text-end" :disabled="form.processing">
            <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
            Update Page
          </Button>
        </div>
      </form>
      <BaseToast />
    </div>
  </AppLayout>
</template>
<script setup lang="ts">
import { Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/layouts/AppLayout.vue";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import InputError from "@/components/InputError.vue";
import { LoaderCircle } from "lucide-vue-next";
import BaseToast from "@/components/BaseToast.vue";
import { ref } from "vue";

const props = defineProps<{
  homepage: any;
}>();
// Initialize preview with old image if exists
const previewSideImg = ref(
  props.homepage?.side_img ? `/storage/${props.homepage.side_img}` : null
);
// Initialize preview with old image if exists
const flag_icon_preview = ref(
  props.homepage?.flag_icon ? `/storage/${props.homepage.flag_icon}` : null
);

const imagePreviews = ref<string | null>(null);

const form = useForm({
  // Hero section
  hero_title: props.homepage?.hero_title ?? "",
  hero_subtitle: props.homepage?.hero_subtitle ?? "",
  hero_description: props.homepage?.hero_description ?? "",

  // Stay connected
  stay_heading: props.homepage?.stay_heading ?? "",
  stay_description: props.homepage?.stay_description ?? "",

  // Church welcome
  church_title: props.homepage?.church_title ?? "",
  church_description: props.homepage?.church_description ?? "",
  side_img: props.homepage?.side_img ?? "",
  service_times: props.homepage?.service_times ?? "",
  school_time: props.homepage?.school_time ?? "",
  devine_time: props.homepage?.devine_time ?? "",
  flag_icon: props.homepage?.flag_icon ?? "",

  // Info Cards section
  info_cards: props.homepage?.info_cards ?? [
    { title: "", description: "", button_text: "", button_url: "" },
    { title: "", description: "", button_text: "", button_url: "" },
    { title: "", description: "", button_text: "", button_url: "" },
    { title: "", description: "", button_text: "", button_url: "" },
  ],

  // Recurring events
  recurring_event_title: props.homepage?.recurring_event_title ?? "",
  text_1: props.homepage?.text_1 ?? "",
  text_2: props.homepage?.text_2 ?? "",
  text_3: props.homepage?.text_3 ?? "",
  text_4: props.homepage?.text_4 ?? "",
  // Stay connected items
  stay_connect_heading: props.homepage?.stay_connect_heading ?? "",
  stay_connect_description: props.homepage?.stay_connect_description ?? "",
  stay_connect_item_1: props.homepage?.stay_connect_item_1 ?? "",
  stay_connect_item_2: props.homepage?.stay_connect_item_2 ?? "",
  stay_connect_item_3: props.homepage?.stay_connect_item_3 ?? "",
  // about shekinah
  about_heading: props.homepage?.about_heading ?? "",
  about_para_first: props.homepage?.about_para_first ?? "",
  about_para_second: props.homepage?.about_para_second ?? "",
  // mission and vision
  mission_heading: props.homepage?.mission_heading ?? "",
  mission_description: props.homepage?.mission_description ?? "",
  vision_heading: props.homepage?.vision_heading ?? "",
  vision_description: props.homepage?.vision_description ?? "",
  // about images
  about_image_1: props.homepage?.about_image_1 ?? "",
  about_image_2: props.homepage?.about_image_2 ?? "",
  about_image_3: props.homepage?.about_image_3 ?? "",
  about_image_4: props.homepage?.about_image_4 ?? "",

  heroimage: props.homepage?.heroimage ? props.homepage?.heroimage : "",
  //   heroimage_style: "",
});

// Handle file change
const handleSideImgChange = (e: Event) => {
  const file = (e.target as HTMLInputElement).files?.[0];
  if (file) {
    form.side_img = file;
    previewSideImg.value = URL.createObjectURL(file);
  }
};
const handleflagiconChange = (e: Event) => {
  const file = (e.target as HTMLInputElement).files?.[0];
  if (file) {
    form.flag_icon = file;
    flag_icon_preview.value = URL.createObjectURL(form.flag_icon);
    // console.log("flag icon changed", form.flag_icon);
  }
};

// Handles file changes for about images
const handleFileChange = (e: Event) => {
  const input = e.target as HTMLInputElement;
  const file = input.files?.[0];

  if (!file) return;
  switch (input.id) {
    case "about_image_1":
      form.about_image_1 = file;
      break;
    case "about_image_2":
      form.about_image_2 = file;
      break;
    case "about_image_3":
      form.about_image_3 = file;
      break;
    case "about_image_4":
      form.about_image_4 = file;
      break;
  }
};

const handleHeroFileChange = (e: Event) => {
  const target = e.target as HTMLInputElement;
  if (target.files?.length) {
    form.heroimage = target.files[0];
    const reader = new FileReader();
    reader.onload = () => {
      imagePreviews.value = reader.result as string;
    };
    reader.readAsDataURL(target.files[0]);
  }
};

const submit = () => {
  form.post(route("website.home.update"), {
    forceFormData: true,
  });
};
</script>
<style scoped></style>
