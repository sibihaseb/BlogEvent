<script setup lang="ts">
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import type { User } from "@/client";

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
  user: User;
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
  name: props.user.name,
  email: props.user.email,
  password: "",
  password_confirmation: "",
});

const submit = (e: Event) => {
  e.preventDefault();

  form.put(route("users.update", props.user.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset("password", "password_confirmation");
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
      <Button variant="outline">Edit User</Button>
    </DialogTrigger>

    <DialogContent class="sm:max-w-[500px]">
      <form @submit="submit" class="space-y-6">
        <DialogHeader class="space-y-3">
          <DialogTitle>Edit User</DialogTitle>
          <DialogDescription> Update user details and save. </DialogDescription>
        </DialogHeader>

        <div class="grid gap-4">
          <div class="space-y-1">
            <Label for="name">Name</Label>
            <Input id="name" type="text" v-model="form.name" />
            <InputError :message="form.errors.name" />
          </div>

          <div class="space-y-1">
            <Label for="email">Email</Label>
            <Input id="email" type="email" v-model="form.email" />
            <InputError :message="form.errors.email" />
          </div>

          <div class="space-y-1">
            <Label for="password">Password</Label>
            <Input
              id="password"
              type="password"
              v-model="form.password"
              autocomplete="new-password"
            />
            <InputError :message="form.errors.password" />
          </div>

          <div class="space-y-1">
            <Label for="password_confirmation">Confirm Password</Label>
            <Input
              id="password_confirmation"
              type="password"
              v-model="form.password_confirmation"
            />
            <InputError :message="form.errors.password_confirmation" />
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
        >
        </DialogClose>
      </form>
    </DialogContent>
  </Dialog>
</template>
