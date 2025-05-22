<script setup lang="ts">
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import type { EventStaff } from "@/client"; // You may rename this according to your actual type

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
  staff: EventStaff;
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

// `image` is null by default since it's optional in edit
const form = useForm({
  name: props.staff.name,
  position: props.staff.position,
  image: null as File | null,
});

const submit = (e: Event) => {
  e.preventDefault();
form.put(route("staffs.update", props.staff.id), {
  preserveScroll: true,
  forceFormData: true, // Required for file uploads
  onSuccess: () => {
    form.reset("image");
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
<template>
  <Dialog v-model:open="localOpen">
    <DialogTrigger as-child>
      <Button variant="outline">Edit Staff</Button>
    </DialogTrigger>

    <DialogContent class="sm:max-w-[500px]">
      <form @submit="submit" class="space-y-6" enctype="multipart/form-data">
        <DialogHeader class="space-y-3">
          <DialogTitle>Edit Staff</DialogTitle>
          <DialogDescription>Update staff details and save.</DialogDescription>
        </DialogHeader>

        <div class="grid gap-4">
          <div class="space-y-1">
            <Label for="name">Name</Label>
            <Input id="name" type="text" v-model="form.name" />
            <InputError :message="form.errors.name" />
          </div>

          <div class="space-y-1">
            <Label for="position">Position</Label>
            <Input id="position" type="text" v-model="form.position" />
            <InputError :message="form.errors.position" />
          </div>

          <div class="space-y-1">
            <Label for="image">Image</Label>
            <Input
              id="image"
              type="file"
              accept="image/*"
              @change="(e: any) => form.image = e.target.files[0]"
            />
            <InputError :message="form.errors.image" />
          </div>
        </div>

        <DialogFooter class="gap-2">
          <DialogClose as-child>
            <Button variant="secondary" type="button" @click="closeModal">Cancel</Button>
          </DialogClose>
          <Button type="submit" :disabled="form.processing">Save Changes</Button>
        </DialogFooter>

        <DialogClose
          class="absolute top-4 right-4 text-gray-500 hover:text-gray-700"
          aria-label="Close"
        />
      </form>
    </DialogContent>
  </Dialog>
</template>
