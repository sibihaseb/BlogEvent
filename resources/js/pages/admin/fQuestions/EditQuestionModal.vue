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
// import { Select } from "@/components/ui/select"; // Ensure Select is imported
import InputError from "@/components/InputError.vue";
import { FQuestion } from "@/client/models/FQuestion";


const props = defineProps<{
  open: boolean;
  question: FQuestion;
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

// Initialize form with question data
const form = useForm({
  question: props.question?.question ?? "",
  answer: props.question?.answer ?? "",
  type: props.question?.type ?? "about",
  is_active: props.question?.is_active ?? true,
});

// Watch for prop changes and update form
watch(
  () => props.question,
  (q) => {
    if (q) {
      form.question = q.question;
      form.answer = q.answer;
      form.type = q.type ?? "about";
      form.is_active = q.is_active ?? true;
    }
    form.clearErrors();
  },
  { immediate: true }
);

const submit = (e: Event) => {
  e.preventDefault();
  form.put(route("frequently-questions.update", props.question.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      closeModal();
    },
  });
};

const closeModal = () => {
  form.clearErrors();
  emit("update:open", false);
};
</script>

<template>
  <Dialog v-model:open="localOpen">
    <DialogTrigger as-child>
      <Button variant="outline">Edit Question</Button>
    </DialogTrigger>
    <DialogContent class="sm:max-w-[500px]">
      <form @submit="submit" class="space-y-6">
        <DialogHeader class="space-y-3">
          <DialogTitle>Edit Question</DialogTitle>
          <DialogDescription>Update the question details and save.</DialogDescription>
        </DialogHeader>

        <div class="grid gap-4">
          <div class="space-y-1">
            <Label for="question">Question</Label>
            <Input id="question" type="text" v-model="form.question" aria-label="Question" />
            <InputError :message="form.errors.question" />
          </div>
          <div class="space-y-1">
            <Label for="answer">Answer</Label>
            <textarea class="border border-gray-300 rounded px-3 w-full py-2" id="answer" v-model="form.answer"
              aria-label="Answer"></textarea>
            <Label class="text-xs text-gray-500 italic">Provide a detailed answer to the question.</Label>
            <InputError :message="form.errors.answer" />
          </div>
          <div class="space-y-1">
            <Label for="type">Type</Label>
            <select name="type" id="type" v-model="form.type" class="border border-gray-300 rounded px-3 w-full py-2"
              aria-label="Type">
              <option value="about">About Us</option>
              <option value="home">Home</option>
              <option value="contact">Contact Us</option>
              <option value="prayer">Prayer Request</option>
            </Select>
            <InputError :message="form.errors.type" />
          </div>
          <div class="space-y-1">
            <Label for="active">Active</Label>
            <select name="active" id="active" v-model="form.is_active"
              class="border border-gray-300 rounded px-3 w-full py-2" aria-label="Active status">
              <option :value="true">Yes</option>
              <option :value="false">No</option>
            </Select>
            <InputError :message="form.errors.is_active" />
          </div>
        </div>

        <DialogFooter class="gap-2">
          <DialogClose as-child>
            <Button variant="secondary" type="button" @click="closeModal">Cancel</Button>
          </DialogClose>
          <Button type="submit" :disabled="form.processing">Update Question</Button>
        </DialogFooter>

        <DialogClose class="absolute top-4 right-4 text-gray-500 hover:text-gray-700" aria-label="Close" />
      </form>
    </DialogContent>
  </Dialog>
</template>