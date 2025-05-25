<template>

  <Head title="Edit Event" />
  <AppLayout>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <form @submit.prevent="submit" class="space-y-6">
        <!-- image and Name -->
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="name">Name</Label>
            <Input id="name" v-model="form.name" placeholder="Enter name" />
            <InputError :message="form.errors.name" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="type">Type</Label>
            <Input id="type" type="text" placeholder="Enter Type" v-model="form.type" />
            <InputError :message="form.errors.type" />
          </div>
        </div>

        <!-- Times and Location -->
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid md:grid-cols-2 gap-4">
            <div class="grid gap-2">

              <Label for="image">Image</Label>
              <Input id="image" type="file" accept="image/*" @change="handleFileChange" />
              <InputError :message="form.errors.image" />
            </div>
            <div class="flex-1 grid gap-2">
              <Label for="short_description">Short Description</Label>
              <Input id="short_description" type="text" placeholder="Enter Type" v-model="form.short_description" />
              <InputError :message="form.errors.short_description" />
            </div>

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
            Update Blog
          </Button>
          <Button type="button" class="ml-4" @click="router.visit(route('blogs.index'))">
            Go Back
          </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { Head, router, useForm } from "@inertiajs/vue3";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import InputError from "@/components/InputError.vue";
import AppLayout from "@/layouts/AppLayout.vue";
import { LoaderCircle } from "lucide-vue-next";
import { onMounted, ref } from "vue";
import Quill from "quill";
import "quill/dist/quill.snow.css";
import { EventBlogs } from "@/client";

// Props from the controller
const props = defineProps<{
  blog: EventBlogs;
}>();

const editor = ref(null);
let quill: Quill | null = null;

const form = useForm({
  image: null as File | null,
  name: props.blog.name || "",
  description: props.blog.description || "",
  type: props.blog.type || "",
  short_description: props.blog.short_description || "",
});

onMounted(() => {
  if (editor.value) {
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
  }

  if (props.blog.description) {
    if (!quill) {
      return;
    }
    quill.root.innerHTML = JSON.parse(props.blog.description);
  }
});

const submit = () => {
  if (!quill) {
    return;
  }
  const html = quill.root.innerHTML;
  form.description = JSON.stringify(html);
  form.put(route("blogs.update", props.blog.id));
};

const handleFileChange = (e: Event) => {
  const target = e.target as HTMLInputElement;
  if (target.files?.length) {
    form.image = target.files[0];
  }
};
</script>

<style scoped>
.quill-editor {
  height: 300px;
}
</style>
