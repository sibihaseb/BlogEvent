<template>
  <Dialog v-model:open="localOpen">
    <DialogTrigger as-child>
      <Button variant="outline">Edit Event blogEdit</Button>
    </DialogTrigger>

    <DialogContent class="sm:max-w-[500px]">
      <form @submit="submit" class="space-y-6">
        <DialogHeader class="space-y-3">
          <DialogTitle>Edit Event blogEdit</DialogTitle>
          <DialogDescription> Update Event BlogEdit details and save. </DialogDescription>
        </DialogHeader>
        <div class="grid gap-4">
          <div class="grid gap-4">
            <div class="space-y-1">
              <Label for="name">Name</Label>
              <Input id="name" type="text" v-model="form.name" />
              <InputError :message="form.errors.name" />
            </div>

            <div class="space-y-1">
              <Label for="description">Description</Label>
              <textarea class="border w-full p-2" id="description" v-model="form.description" />
              <InputError :message="form.errors.description" />
            </div>
            <div class="space-y-1">
              <Label for="icon">Icon</Label>
              <Input id="icon" type="file" @change="handleiconChange" />
              <InputError :message="form.errors.icon" />
            </div>
          </div>

          <DialogFooter class="gap-2">
            <DialogClose as-child>
              <Button variant="secondary" type="button" @click="closeModal">Cancel</Button>
            </DialogClose>
            <Button type="submit" :disabled="form.processing">Save Changes</Button>
          </DialogFooter>

          <DialogClose class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" aria-label="Close">
          </DialogClose>
        </div>
      </form>
    </DialogContent>
  </Dialog>
</template>
<script setup lang="ts">
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import type { Ministry } from "@/client";

import {
  Dialog,
  DialogTrigger,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogDescription,
  DialogFooter,
  DialogClose,
} from "@/components/ui/dialog";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import InputError from "@/components/InputError.vue";

const props = defineProps<{
  eventBlog: Ministry;
  open: boolean;
}>();

const emit = defineEmits<{
  (e: "update:open", value: boolean): void;
}>();

const localOpen = ref(props.open);

watch(
  () => props.open,
  (val) => {
    localOpen.value = val;
  }
);

watch(localOpen, (val) => {
  emit("update:open", val);

});

const form = useForm({
  name: props.eventBlog.name,
  description: props.eventBlog.description,
  icon: null,

});
// icon handle
function handleiconChange(event: any) {
  const file = event.target.files[0];
  if (file) {
    form.icon = file;
  }
}


const submit = (e: Event) => {
  e.preventDefault();
  form.transform((data: any) => ({
    ...data,
    _method: 'PUT',
  })).post(route('ministries.update', props.eventBlog.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      closeModal();
    },
  });
};

const closeModal = () => {
  form.clearErrors();
  form.reset();
  emit("update:open", false);
};
</script>
