<template>
  <Head title="Create Contact us" />
  <AppLayout>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">ContactUs Page Content</h1>
      <form @submit.prevent="submit" class="space-y-6">
        <Label>Hero Section</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heroheading">Hero Section Heading</Label>
            <Input id="heroheading" type="text" v-model="form.heroheading" />
            <InputError :message="form.errors.heroheading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="herosubheading">Hero Section SubHeading</Label>
            <Input id="herosubheading" type="text" v-model="form.herosubheading" />
            <InputError :message="form.errors.herosubheading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="herotext">Hero Section Text</Label>
            <Input id="herotext" type="text" v-model="form.herotext" />
            <InputError :message="form.errors.herotext" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="picture">Hero Section Image</Label>
            <Input
              id="picture"
              type="file"
              accept="image/*"
              @change="handleFileChange('heroimage', $event)"
            />
            <InputError :message="form.errors.heroimage" />
          </div>
          <!-- <div class="flex-1 grid gap-2">
            <Label for="type">Image Style</Label>
            <select id="states" v-model="form.heroimage_style"
              class="text-sm rounded-[var(--radius)] max-h-9 border border-[var(--border)] focus:ring-[var(--ring)] focus:border-[var(--ring)] block w-full p-2 dark:bg-[var(--input)] dark:text-[var(--foreground)] dark:border-[var(--border)] dark:focus:ring-[var(--ring)] dark:focus:border-[var(--ring)]">
              <option selected value="">Choose a Image Style</option>
              <option value="1">1920x1080</option>
              <option value="2">1900x300</option>
            </select>

            <InputError :message="form.errors.type" />
          </div> -->
          <div class="flex-1 grid gap-2 justify-center">
            <Label for="heading">Preview</Label>
            <img
              v-if="imagePreviews || form.heroimage"
              :src="imagePreviews ? imagePreviews : '/storage/' + form.heroimage"
              alt="Passport Back Preview"
              class="rounded border border-gray-300 max-w-xs h-auto shadow"
            />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading_left_side">Address Heading</Label>
            <Input id="address_heading" type="text" v-model="form.address_heading" />
            <InputError :message="form.errors.address_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Address Text</Label>
            <textarea v-model="form.address_text"></textarea>
            <InputError :message="form.errors.address_text" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="website_heading">website Heading</Label>
            <Input id="website_heading" type="text" v-model="form.website_heading" />
            <InputError :message="form.errors.website_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="website_text">Website Text</Label>
            <textarea v-model="form.website_text"></textarea>
            <InputError :message="form.errors.website_text" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading_left_side">Email Heading</Label>
            <Input id="email_heading" type="text" v-model="form.email_heading" />
            <InputError :message="form.errors.email_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Email Text</Label>
            <textarea v-model="form.email_text"></textarea>
            <InputError :message="form.errors.email_text" />
          </div>
        </div>
        <div class="flex-1 grid gap-2">
          <Label for="name">Map Url</Label>
          <Input v-model="form.map_url" />
          <InputError :message="form.errors.map_url" />
        </div>
        <div class="flex-1 grid gap-2">
          <Label for="picture">General Image</Label>
          <Input
            id="picture"
            type="file"
            accept="image/*"
            @change="handleFileChange('genral_image', $event)"
          />
          <InputError :message="form.errors.genral_image" />
        </div>
        <div class="flex justify-end">
          <Button type="submit" class="text-end" :disabled="form.processing">
            <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
            Update ContactUs Page
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
  contactUsPage: any;
}>();

const imagePreviews = ref<string | null>(null);

const form = useForm({
  address_heading: props.contactUsPage?.address_heading
    ? props.contactUsPage?.address_heading
    : "",
  address_text: props.contactUsPage?.address_text
    ? props.contactUsPage?.address_text
    : "",
  website_heading: props.contactUsPage?.website_heading
    ? props.contactUsPage?.website_heading
    : "",
  website_text: props.contactUsPage?.website_text
    ? props.contactUsPage?.website_text
    : "",
  email_heading: props.contactUsPage?.email_heading
    ? props.contactUsPage?.email_heading
    : "",
  email_text: props.contactUsPage?.email_text ? props.contactUsPage?.email_text : "",
  map_url: props.contactUsPage?.map_url ? props.contactUsPage?.map_url : "",
  heroheading: props.contactUsPage?.heroheading ? props.contactUsPage?.heroheading : "",
  herosubheading: props.contactUsPage?.herosubheading
    ? props.contactUsPage?.herosubheading
    : "",
  herotext: props.contactUsPage?.herotext ? props.contactUsPage?.herotext : "",
  heroimage: props.contactUsPage?.heroimage ? props.contactUsPage?.heroimage : "",
  //   heroimage_style: "",
  genral_image: props.contactUsPage?.genral_image
    ? props.contactUsPage?.genral_image
    : "",
});

const handleFileChange = (key: string, e: Event) => {
  const target = e.target as HTMLInputElement;
  if (target.files?.length) {
    if (key == "heroimage") {
      form.heroimage = target.files[0];
      const reader = new FileReader();
      reader.onload = () => {
        imagePreviews.value = reader.result as string;
      };
      reader.readAsDataURL(target.files[0]);
    } else if (key === "genral_image") {
      form.genral_image = target.files[0];
    }
  }
};

const submit = () => {
  form.post(route("website.contactus.update"), {
    forceFormData: true,
  });
};
</script>

<style scoped></style>
