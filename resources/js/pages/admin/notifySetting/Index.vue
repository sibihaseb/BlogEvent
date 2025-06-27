<template>
  <Head title="Notification Setting" />
  <AppLayout>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">Notification Setting</h1>
      <form @submit.prevent="submit" class="space-y-6">
        <Label>Notification Email Setting</Label>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="heading">Contact Us Email's</Label>
            <textarea
              class="dark:border-white dark:border-1 rounded-md"
              rows="10"
              v-model="form.contactus"
            ></textarea>
            <InputError :message="form.errors.contactus" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Prayer Request Email's</Label>
            <textarea
              class="dark:border-white dark:border-1 rounded-md"
              rows="10"
              v-model="form.prayerrequest"
            ></textarea>
            <InputError :message="form.errors.prayerrequest" />
          </div>
        </div>
        <div class="flex justify-end">
          <Button type="submit" class="text-end" :disabled="form.processing">
            <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
            Update Notification Settings
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
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import InputError from "@/components/InputError.vue";
import { LoaderCircle } from "lucide-vue-next";
import BaseToast from "@/components/BaseToast.vue";

const props = defineProps<{
  contactus: any;
  prayerrequest: any;
}>();

const form = useForm({
  contactus: props.contactus ? props.contactus : "",
  prayerrequest: props.prayerrequest ? props.prayerrequest : "",
});

const submit = () => {
  form.post(route("notify.settings.update"), {
    forceFormData: true,
  });
};
</script>

<style scoped></style>
