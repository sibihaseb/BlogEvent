<template>

  <Head title="Create Event" />
  <AppLayout>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <form @submit.prevent="submit" class="space-y-6">
        <!-- Picture and Name -->
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="picture">Event Picture</Label>
            <Input id="picture" type="file" accept="image/*" @change="handleFileChange" />
            <InputError :message="form.errors.picture" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Event Name</Label>
            <Input id="name" v-model="form.name" required placeholder="Enter event name" />
            <InputError :message="form.errors.name" />
          </div>
        </div>

        <!-- Times and Location -->
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid md:grid-cols-2 gap-4">
            <div class="grid gap-2">
              <Label for="start_time">Start Time</Label>
              <Input id="start_time" type="datetime-local" v-model="form.start_time" required />
              <InputError :message="form.errors.start_time" />
            </div>
            <div class="grid gap-2">
              <Label for="end_time">End Time</Label>
              <Input id="end_time" type="datetime-local" v-model="form.end_time" required />
              <InputError :message="form.errors.end_time" />
            </div>
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="location">Location</Label>
            <Input id="location" v-model="form.location" placeholder="Where is the event?" />
            <InputError :message="form.errors.location" />
          </div>
          <!-- Type -->
          <div class="flex-1 grid gap-2">
            <Label for="type">Type</Label>
            <select id="states" v-model="form.type"
              class="text-sm rounded-[var(--radius)] border border-[var(--border)] focus:ring-[var(--ring)] focus:border-[var(--ring)] block w-full p-2 dark:bg-[var(--input)] dark:text-[var(--foreground)] dark:border-[var(--border)] dark:focus:ring-[var(--ring)] dark:focus:border-[var(--ring)]">
              <option selected value="">Choose a Type</option>
              <option value="recurring">recurring</option>
              <option value="one_day">one day</option>
            </select>

            <InputError :message="form.errors.type" />
          </div>
        </div>
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="name">Event Short Description</Label>
            <Input id="name" v-model="form.short_description" required placeholder="Enter Short Description" />
            <InputError :message="form.errors.short_description" />
          </div>
        </div>

        <!-- Description -->
        <div class="grid gap-2">
          <Label for="description">Description</Label>
          <div ref="editor" class="quill-editor"></div>
          <InputError :message="form.errors.description" />
        </div>
        <!-- Submit -->
        <div class="flex justify-end">
          <Button type="submit" class="text-end" :disabled="form.processing">
            <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
            Create Event
          </Button>
          <Button type="button" class="ml-4" @click="router.visit(route('churchevents.index'))">
            Go Back
          </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { Head, useForm, router } from "@inertiajs/vue3";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import InputError from "@/components/InputError.vue";
import AppLayout from "@/layouts/AppLayout.vue";
import { LoaderCircle } from "lucide-vue-next";
import { onMounted, ref } from "vue";
import Quill from "quill";
import "quill/dist/quill.snow.css";

const editor = ref(null);
let quill: any = null;

onMounted(() => {
  if (!editor.value) {
    return;
  }
  quill = new Quill(editor.value, {
    theme: "snow",
    placeholder: "Compose an epic...",
    modules: {
      toolbar: [
        [{ header: [1, 2, 3, false] }],
        ["bold", "italic", "underline", "strike"],
        [{ list: "ordered" }, { list: "bullet" }],
        [{ script: "sub" }, { script: "super" }],
        [{ indent: "-1" }, { indent: "+1" }],
        [{ direction: "rtl" }],
        [{ size: ["small", false, "large", "huge"] }],
        [{ color: [] }, { background: [] }],
        [{ font: [] }],
        [{ align: [] }],
        ["link"],
        ["clean"],
      ],
    },
  });
});

const form = useForm({
  picture: null as File | null,
  name: "",
  short_description: "",
  description: "",
  start_time: "",
  end_time: "",
  location: "",
  type: "",
});

const submit = () => {
  const html = quill.root.innerHTML;
  form.description = JSON.stringify(html);
  form.post(route("churchevents.store"), {
    forceFormData: true,
  });
};

const handleFileChange = (e: Event) => {
  const target = e.target as HTMLInputElement;
  if (target.files?.length) {
    form.picture = target.files[0];
  }
};
</script>
<style scoped>
.quill-editor {
  height: 300px;
}
</style>
