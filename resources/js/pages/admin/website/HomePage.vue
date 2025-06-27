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
            <textarea v-model="form.hero_description"
              class="w-full h-24 rounded-md p-2 border border-gray-300"></textarea>
            <InputError :message="form.errors.hero_description" />
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
            <textarea v-model="form.stay_description"
              class="w-full h-24 rounded-md p-2 border border-gray-300"></textarea>
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
            <textarea v-model="form.church_description"
              class="w-full h-24 rounded-md p-2 border border-gray-300"></textarea>
            <InputError :message="form.errors.church_description" />
          </div>
        </div>
        <hr />
        <!-- Info Cards Section -->
        <Label>Info Cards Section</Label>
        <div v-for="(card, index) in form.info_cards" :key="index"
          class="flex gap-4 flex-col md:flex-row border p-4 rounded-lg mb-4">
          <div class="flex-1 grid gap-2">
            <Label :for="`card_title_${index}`">Title</Label>
            <Input :id="`card_title_${index}`" type="text" v-model="card.title" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label :for="`card_description_${index}`">Description</Label>
            <textarea :id="`card_description_${index}`" v-model="card.description"
              class="w-full h-24 rounded-md p-2 border border-gray-300"></textarea>
          </div>
          <div class="flex-1 grid gap-2">
            <Label :for="`card_button_text_${index}`">Button Text</Label>
            <Input :id="`card_button_text_${index}`" type="text" v-model="card.button_text" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label :for="`card_button_url_${index}`">Button URL</Label>
            <Input :id="`card_button_url_${index}`" type="text" v-model="card.button_url" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label :for="`card_icon_${index}`">Icon</Label>
            <input :id="`card_icon_${index}`" type="file" accept="image/*" @change="handleFileUpload($event, index)"
              class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
            <div v-if="form.info_cards[index].icon_preview" class="mt-1">
              <img :src="form.info_cards[index].icon_preview" alt="Icon Preview"
                class="h-12 w-12 object-contain border rounded" />
            </div>
          </div>
        </div>
        <!-- Submit Button -->
        <div class="flex justify-end">
          <Button type="submit" class="text-end" :disabled="form.processing">
            <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" /> Update Page
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

  const props = defineProps<{
    data: any;
  }>();

  const form = useForm({
    // Hero section
    hero_title: props.data?.hero_title ?? "",
    hero_subtitle: props.data?.hero_subtitle ?? "",
    hero_description: props.data?.hero_description ?? "",

    // Stay connected
    stay_heading: props.data?.stay_heading ?? "",
    stay_description: props.data?.stay_description ?? "",

    // Church welcome
    church_title: props.data?.church_title ?? "",
    church_description: props.data?.church_description ?? "",

    // Info Cards section
    info_cards: props.data?.info_cards ?? [
      { title: '', description: '', button_text: '', button_url: '', icon: null, icon_preview: null },
      { title: '', description: '', button_text: '', button_url: '', icon: null, icon_preview: null },
      { title: '', description: '', button_text: '', button_url: '', icon: null, icon_preview: null },
      { title: '', description: '', button_text: '', button_url: '', icon: null, icon_preview: null },
    ],
  });
  const handleFileUpload = (event: Event, index: number) => {
    const target = event.target as HTMLInputElement;
    if (target.files && target.files[0]) {
      const file = target.files[0];
      form.info_cards[index].icon = file;

      // Preview for user
      const reader = new FileReader();
      reader.onload = (e) => {
        form.info_cards[index].icon_preview = e.target?.result;
      };
      reader.readAsDataURL(file);
    }
  };


  const submit = () => {
    form.post(route("website.home.update"), {
      forceFormData: true,
    });
  };

</script>
<style scoped></style>
