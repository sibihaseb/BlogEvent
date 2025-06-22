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
  question: "",
  answer: "",
  type: "about",
  is_active: "1",
});

const submit = (e: Event) => {
  e.preventDefault();

  form.post(route("frequently-questions.store"), {
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
      <Button variant="outline">Create Question</Button>
    </DialogTrigger>

    <DialogContent class="sm:max-w-[500px]">
      <form @submit="submit" class="space-y-6">
        <DialogHeader class="space-y-3">
          <DialogTitle>Create Question</DialogTitle>
          <DialogDescription>Enter new Question details and save.</DialogDescription>
        </DialogHeader>

        <div class="grid gap-4">
          <div class="space-y-1">
            <Label for="question">Question</Label>
            <Input id="question" type="text" v-model="form.question" />
            <InputError :message="form.errors.question" />
          </div>
          <div class="space-y-1">
            <Label for="answer">Answer</Label>
            <textarea class="border border-gray-300 rounded px-3 w-full py-2" id="answer"
              v-model="form.answer"></textarea>
            <Label class="text-xs text-gray-500 italic">Provide a detailed answer to the question.</Label>
            <InputError :message="form.errors.answer" />
          </div>
          <div class="space-y-1">
            <Label for="type">Type</Label>
            <Select name="type" class="border border-gray-300 rounded px-3 w-full py-2" id="type" v-model="form.type">
              <option value="about">About Us</option>
              <option value="home">Home</option>
              <option value="contact">Contact Us</option>
              <option value="prayer">Prayer Request</option>
            </Select>
          </div>
          <div class="space-y-1">
            <Label for="active">Active</Label>
            <Select name="active" class="border border-gray-300 rounded px-3 w-full py-2" id="active"
              v-model="form.is_active">
              <option value="1">Yes</option>
              <option value="0">No</option>
            </Select>
          </div>
        </div>

        <DialogFooter class="gap-2">
          <DialogClose as-child>
            <Button variant="secondary" type="button" @click="closeModal">Cancel</Button>
          </DialogClose>
          <Button type="submit" :disabled="form.processing">Create Question</Button>
        </DialogFooter>

        <DialogClose class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" aria-label="Close" />
      </form>
    </DialogContent>
  </Dialog>
</template>
