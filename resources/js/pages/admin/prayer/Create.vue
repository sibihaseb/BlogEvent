<script setup lang="ts">
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";

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
import { SwitchRoot, SwitchThumb } from "reka-ui";
const props = defineProps<{
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
  name: "",
  email: "",
  request: "",
  is_public: false,
});

const submit = (e: Event) => {
  e.preventDefault();

  form.post(route("prayers.store"), {
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

<template>
  <Dialog v-model:open="localOpen">
    <DialogTrigger as-child>
      <Button variant="outline">Create Prayer Request</Button>
    </DialogTrigger>

    <DialogContent class="sm:max-w-[500px]">
      <form @submit="submit" class="space-y-6">
        <DialogHeader class="space-y-3">
          <DialogTitle>Create Prayer Request</DialogTitle>
          <DialogDescription>Enter new details and save.</DialogDescription>
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
            <Label for="request">Request</Label>
            <textarea class="border w-full p-2" id="request" v-model="form.request" />
            <InputError :message="form.errors.request" />
          </div>

          <div class="space-y-1">
            <Label for="is_public">Is Public</Label>
            <SwitchRoot
              id="airplane-mode"
              v-model="form.is_public"
              class="w-[32px] h-[20px] shadow-sm flex data-[state=unchecked]:bg-[var(--muted)] data-[state=checked]:bg-[var(--secondary)] dark:data-[state=unchecked]:bg-[var(--muted)] dark:data-[state=checked]:bg-[var(--secondary)] border border-[var(--border)] data-[state=checked]:border-[var(--secondary)] dark:border-[var(--border)] rounded-full relative transition-[background] focus-within:outline-none focus-within:border-[var(--ring)] focus-within:shadow-[var(--ring)]"
            >
              <SwitchThumb
                class="w-3.5 h-3.5 my-auto bg-[var(--foreground)] text-xs flex items-center justify-center shadow-xl rounded-full transition-transform translate-x-0.5 will-change-transform data-[state=checked]:translate-x-full"
              />
            </SwitchRoot>

            <InputError :message="form.errors.is_public" />
          </div>
        </div>

        <DialogFooter class="gap-2">
          <DialogClose as-child>
            <Button variant="secondary" type="button" @click="closeModal">Cancel</Button>
          </DialogClose>
          <Button type="submit" :disabled="form.processing">Create Prayer Request</Button>
        </DialogFooter>

        <DialogClose
          class="absolute top-4 right-4 text-gray-500 hover:text-gray-700"
          aria-label="Close"
        />
      </form>
    </DialogContent>
  </Dialog>
</template>
