<template>
  <Head title="Ministry" />
  <AppLayout>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">Ministry Page Content</h1>
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
  ministriesPage: any;
}>();

const imagePreviews = ref<string | null>(null);

const form = useForm({
  heroheading: props.ministriesPage?.heroheading ? props.ministriesPage?.heroheading : "",
  herosubheading: props.ministriesPage?.herosubheading
    ? props.ministriesPage?.herosubheading
    : "",
  herotext: props.ministriesPage?.herotext ? props.ministriesPage?.herotext : "",
  heroimage: props.ministriesPage?.heroimage ? props.ministriesPage?.heroimage : "",
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
  form.post(route("website.ministries.update"), {
    forceFormData: true,
  });
};
</script>

<style scoped></style>
