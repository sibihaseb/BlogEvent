<template>
  <Head title="Create Event" />
  <AppLayout>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">Home Page Content</h1>
      <form @submit.prevent="submit" class="space-y-6">
        <Label>Hero Section</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="title">Title</Label>
            <Input id="title" type="text" v-model="form.hero_title" />
            <InputError :message="form.errors.hero_title" />
          </div>
           <div class="flex-1 grid gap-2">
            <Label for="name">Sub-title</Label>
            <Input id="title" type="text" v-model="form.hero_subtitle" />
            <InputError :message="form.errors.hero_subtitle" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Description</Label>
            <textarea v-model="form.hero_description"></textarea>
            <InputError :message="form.errors.hero_description" />
          </div>
        </div>
        <hr />
        <Label>Stay Connected</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading_left_side">Heading</Label>
            <Input id="stay_heading" type="text" v-model="form.stay_heading" />
            <InputError :message="form.errors.stay_heading" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Description</Label>
            <textarea v-model="form.stay_description"></textarea>
            <InputError :message="form.errors.stay_description" />
          </div>
        </div>
        <hr />
        <Label>Welcome to Our Haitian Church Family</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="church_title">Title</Label>
            <Input id="church_title" type="text" v-model="form.church_title" />
            <InputError :message="form.errors.church_title" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="goal_text">Description</Label>
            <textarea v-model="form.church_description"></textarea>
            <InputError :message="form.errors.church_description" />
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

const props = defineProps<{
  data: any;
}>();

const form = useForm({
  //hero section
  hero_title: props.data?.hero_title ? props.data?.hero_title : "",
  hero_subtitle: props.data?.hero_subtitle ? props.data?.hero_subtitle : "",
  hero_description: props.data?.hero_description ? props.data?.hero_description : "",
  //stay connected
  stay_heading: props.data?.stay_heading ? props.data?.stay_heading : "",
  stay_description: props.data?.stay_description ? props.data?.stay_description : "",

  church_title: props.data?.church_title
    ? props.data?.church_title
    : "",
  church_description: props.data?.church_description
    ? props.data?.church_description
    : "",
  goal_heading_third: props.data?.goal_heading_third
    ? props.data?.goal_heading_third
    : "",
  goal_text_third: props.data?.goal_text_third
    ? props.data?.goal_text_third
    : "",
});

const submit = () => {
  form.post(route("website.home.update"), {
    forceFormData: true,
  });
};
</script>

<style scoped></style>
