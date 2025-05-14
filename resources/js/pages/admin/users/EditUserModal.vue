<script setup lang="ts">
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import { X } from "lucide-vue-next";
import type { User } from "@/client";
import {
  DialogRoot,
  DialogTrigger,
  DialogPortal,
  DialogOverlay,
  DialogContent,
  DialogTitle,
  DialogDescription,
  DialogClose,
} from "reka-ui";

const props = defineProps<{
  user: User;
  open: boolean;
}>();
console.log("TEST", props.user);
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
  <DialogRoot v-model:open="localOpen">
    <DialogTrigger
      class="text-grass11 font-semibold hover:bg-mauve3 inline-flex h-[35px] items-center justify-center rounded-md bg-white px-[15px] leading-none shadow-sm focus:shadow-[0_0_0_2px] focus:shadow-black dark:focus:shadow-green8 focus:outline-none border"
    >
      Edit User
    </DialogTrigger>

    <DialogPortal>
      <DialogOverlay
        class="bg-blackA9 data-[state=open]:animate-overlayShow fixed inset-0 z-30"
      />

      <DialogContent
        class="data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[480px] translate-x-[-50%] translate-y-[-50%] rounded-[6px] bg-white p-[25px] shadow-lg z-[100]"
      >
        <DialogTitle class="text-mauve12 m-0 text-[17px] font-semibold">
          Edit User
        </DialogTitle>
        <DialogDescription class="text-mauve11 mt-[10px] mb-5 text-sm leading-normal">
          Update user details and save.
        </DialogDescription>

        <form @submit="submit" class="space-y-4">
          <div class="space-y-1">
            <label for="name" class="text-sm text-grass11">Name</label>
            <input
              id="name"
              v-model="form.name"
              type="text"
              class="bg-stone-50 text-grass11 shadow-green7 focus:shadow-green8 inline-flex h-[35px] w-full rounded-lg px-[10px] text-sm shadow-[0_0_0_1px] outline-none focus:shadow-[0_0_0_2px]"
            />
            <p v-if="form.errors.name" class="text-sm text-red-600">
              {{ form.errors.name }}
            </p>
          </div>

          <div class="space-y-1">
            <label for="email" class="text-sm text-grass11">Email</label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              class="bg-stone-50 text-grass11 shadow-green7 focus:shadow-green8 inline-flex h-[35px] w-full rounded-lg px-[10px] text-sm shadow-[0_0_0_1px] outline-none focus:shadow-[0_0_0_2px]"
            />
            <p v-if="form.errors.email" class="text-sm text-red-600">
              {{ form.errors.email }}
            </p>
          </div>

          <div class="space-y-1">
            <label for="password" class="text-sm text-grass11">Password</label>
            <input
              id="password"
              v-model="form.password"
              type="password"
              autocomplete="new-password"
              class="bg-stone-50 text-grass11 shadow-green7 focus:shadow-green8 inline-flex h-[35px] w-full rounded-lg px-[10px] text-sm shadow-[0_0_0_1px] outline-none focus:shadow-[0_0_0_2px]"
            />
            <p v-if="form.errors.password" class="text-sm text-red-600">
              {{ form.errors.password }}
            </p>
          </div>

          <div class="space-y-1">
            <label for="password_confirmation" class="text-sm text-grass11"
              >Confirm Password</label
            >
            <input
              id="password_confirmation"
              v-model="form.password_confirmation"
              type="password"
              class="bg-stone-50 text-grass11 shadow-green7 focus:shadow-green8 inline-flex h-[35px] w-full rounded-lg px-[10px] text-sm shadow-[0_0_0_1px] outline-none focus:shadow-[0_0_0_2px]"
            />
            <p v-if="form.errors.password_confirmation" class="text-sm text-red-600">
              {{ form.errors.password_confirmation }}
            </p>
          </div>

          <div class="mt-6 flex justify-end gap-2">
            <DialogClose as-child>
              <button
                type="button"
                class="text-sm bg-gray-100 hover:bg-gray-200 rounded-lg px-4 py-2"
              >
                Cancel
              </button>
            </DialogClose>

            <button
              type="submit"
              :disabled="form.processing"
              class="bg-green4 text-green11 text-sm hover:bg-green5 inline-flex h-[35px] items-center justify-center rounded-lg px-[15px] font-semibold focus:outline-none"
            >
              Save Changes
            </button>
          </div>
        </form>

        <DialogClose
          class="text-grass11 hover:bg-green4 focus:shadow-green7 absolute top-[10px] right-[10px] inline-flex h-[25px] w-[25px] appearance-none items-center justify-center rounded-full focus:shadow-[0_0_0_2px] focus:outline-none"
          aria-label="Close"
        >
          <X />
        </DialogClose>
      </DialogContent>
    </DialogPortal>
  </DialogRoot>
</template>
