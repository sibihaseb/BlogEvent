<template>
  <Head title="Create Event" />
  <AppLayout>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">AboutUs Page Content</h1>
      <form @submit.prevent="submit" class="space-y-6">
        <Label>Section One</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="picture">Hero Section Image</Label>
            <Input id="picture" type="file" accept="image/*" @change="handleFileChange" />
            <InputError :message="form.errors.heading" />
          </div>
          <div class="flex-1 grid gap-2">
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

            <InputError :message="form.errors.type" />
          </div>
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
            <Label for="heading">Heading</Label>
            <Input id="heading" type="text" v-model="form.heading" />
            <InputError :message="form.errors.heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Paragraph First</Label>
            <textarea v-model="form.para_first"></textarea>
            <InputError :message="form.errors.para_first" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Paragraph Second</Label>
            <textarea v-model="form.para_second"></textarea>
            <InputError :message="form.errors.para_second" />
          </div>
        </div>
        <hr />
        <Label>Goals</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading_left_side">Goal Heading First</Label>
            <Input id="goal_heading" type="text" v-model="form.goal_heading" />
            <InputError :message="form.errors.goal_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Goal Heading Text</Label>
            <textarea v-model="form.goal_text"></textarea>
            <InputError :message="form.errors.goal_text" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="goal_heading">Goal Heading Second</Label>
            <Input id="goal_heading" type="text" v-model="form.goal_heading_second" />
            <InputError :message="form.errors.goal_heading_second" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="goal_text">Goal Heading Text</Label>
            <textarea v-model="form.goal_text_second"></textarea>
            <InputError :message="form.errors.goal_text_second" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading_left_side">Goal Heading Third</Label>
            <Input
              id="goal_heading_third_third"
              type="text"
              v-model="form.goal_heading_third"
            />
            <InputError :message="form.errors.goal_heading_third" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Goal Heading Text</Label>
            <textarea v-model="form.goal_text_third"></textarea>
            <InputError :message="form.errors.goal_text_third" />
          </div>
        </div>
        <div class="flex justify-end">
          <Button type="submit" class="text-end" :disabled="form.processing">
            <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
            Update AboutUs Page
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
  aboutUsPage: any;
}>();

const imagePreviews = ref<string | null>(null);

const form = useForm({
  heading: props.aboutUsPage?.heading ? props.aboutUsPage?.heading : "",
  para_first: props.aboutUsPage?.para_first ? props.aboutUsPage?.para_first : "",
  para_second: props.aboutUsPage?.para_second ? props.aboutUsPage?.para_second : "",
  goal_heading: props.aboutUsPage?.goal_heading ? props.aboutUsPage?.goal_heading : "",
  goal_text: props.aboutUsPage?.goal_text ? props.aboutUsPage?.goal_text : "",
  goal_heading_second: props.aboutUsPage?.goal_heading_second
    ? props.aboutUsPage?.goal_heading_second
    : "",
  goal_text_second: props.aboutUsPage?.goal_text_second
    ? props.aboutUsPage?.goal_text_second
    : "",
  goal_heading_third: props.aboutUsPage?.goal_heading_third
    ? props.aboutUsPage?.goal_heading_third
    : "",
  goal_text_third: props.aboutUsPage?.goal_text_third
    ? props.aboutUsPage?.goal_text_third
    : "",
  heroimage: props.aboutUsPage?.heroimage ? props.aboutUsPage?.heroimage : "",
  heroimage_style: "",
});

const handleFileChange = (e: Event) => {
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
  form.post(route("website.aboutus.update"), {
    forceFormData: true,
  });
};
</script>

<style scoped></style>
