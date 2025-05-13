<script setup lang="ts">
import { ref, watch } from "vue";
import {
  ToastClose,
  ToastDescription,
  ToastProvider,
  ToastRoot,
  ToastTitle,
  ToastViewport,
} from "reka-ui";

interface ToastMessage {
  title: string;
  description?: string;
  type: "success" | "error" | "info";
}

const props = defineProps<{
  message: ToastMessage | null;
  open: boolean;
}>();

const emit = defineEmits<{
  (e: "update:open", value: boolean): void;
}>();

const toastData = ref<ToastMessage | null>(null);

watch(
  () => props.message,
  (newVal) => {
    if (newVal) toastData.value = newVal;
  },
  { immediate: true }
);

watch(
  () => props.open,
  (isOpen) => {
    if (isOpen) {
      setTimeout(() => {
        emit("update:open", false);
      }, 3000);
    }
  }
);
</script>

<template>
  <ToastProvider>
    <ToastRoot
      v-model:open="localOpen"
      class="rounded-lg shadow-sm border p-[15px] grid [grid-template-areas:'title_action''description_action'] grid-cols-[auto_max-content] gap-x-[15px] items-center data-[state=open]:animate-slideIn data-[state=closed]:animate-hide data-[swipe=move]:translate-x-[var(--reka-toast-swipe-move-x)] data-[swipe=cancel]:translate-x-0 data-[swipe=cancel]:transition-[transform_200ms_ease-out] data-[swipe=end]:animate-swipeOut"
    >
      <ToastTitle class="[grid-area:_title] mb-[5px] font-medium text-slate12 text-sm">
        {{ props.message?.title }}
      </ToastTitle>

      <ToastDescription
        v-if="props.message?.description"
        class="[grid-area:_description] m-0 text-slate11 text-xs leading-[1.3]"
      >
        {{ props.message.description }}
      </ToastDescription>

      <ToastClose
        class="[grid-area:_action] text-slate11 text-xs hover:text-slate12"
        aria-label="Close"
      >
        ✖
      </ToastClose>
    </ToastRoot>

    <ToastViewport
      class="[--viewport-padding:_25px] fixed bottom-0 right-0 flex flex-col p-[var(--viewport-padding)] gap-[10px] w-[390px] max-w-[100vw] m-0 list-none z-[2147483647] outline-none"
    />
  </ToastProvider>
</template>
