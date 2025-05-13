<template>
  <Dialog v-model:open="localOpen">
    <DialogTrigger as-child>
      <span></span>
      <!-- Dummy trigger for programmatic control -->
    </DialogTrigger>
    <DialogContent>
      <form class="space-y-6" @submit="handleSubmit">
        <DialogHeader class="space-y-3">
          <DialogTitle>
            {{ mode === "edit" ? "Edit Record" : "Create New Record" }}
          </DialogTitle>
          <DialogDescription>
            {{
              mode === "edit"
                ? "Modify the fields and submit to update the record."
                : "Fill in the fields to create a new record."
            }}
          </DialogDescription>
        </DialogHeader>

        <div class="grid gap-4">
          <div v-for="column in columns" :key="column.key" class="space-y-1">
            <label :for="column.key" class="block text-sm font-medium">
              {{ column.label }}
            </label>
            <input
              v-model="form[column.key]"
              :id="column.key"
              type="text"
              class="w-full border rounded px-3 py-2"
            />
          </div>
        </div>

        <DialogFooter class="gap-2">
          <DialogClose as-child>
            <Button variant="secondary" @click="closeModal">Cancel</Button>
          </DialogClose>
          <Button :disabled="form.processing" type="submit">
            {{ mode === "edit" ? "Update" : "Create" }}
          </Button>
        </DialogFooter>
      </form>
    </DialogContent>
  </Dialog>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { ref, watch, onMounted, reactive } from "vue";
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";

// Props
const props = defineProps<{
  id?: number;
  route: string;
  columns: { label: string; key: string }[];
  open: boolean;
  mode: "create" | "edit";
  initialData?: Record<string, any>;
}>();

// Emits
const emit = defineEmits(["update:open"]);

// Local state
const localOpen = ref(props.open);
watch(
  () => props.open,
  (val) => (localOpen.value = val)
);

const initialFormData = reactive<Record<string, any>>({});
const editMode = ref(props.mode);
props.columns.forEach((col) => {
  initialFormData[col.key] =
    props.mode === "edit" && props.initialData ? props.initialData[col.key] || "" : "";
});

// Inertia form
const form = useForm(initialFormData);

// Populate form when component is mounted
onMounted(() => {
  props.columns.forEach((col) => {
    form[col.key] =
      props.mode === "edit" && props.initialData ? props.initialData[col.key] || "" : "";
  });
});

// Submit handler
const handleSubmit = (e: Event) => {
  e.preventDefault();

  if (editMode.value === "edit") {
    form.put(route(props.route, { id: props.id }), {
      preserveScroll: true,
      onSuccess: () => closeModal(),
      onFinish: () => form.reset(),
    });
  } else {
    form.post(route(props.route), {
      preserveScroll: true,
      onSuccess: () => closeModal(),
      onFinish: () => form.reset(),
    });
  }
};

// Close modal
const closeModal = () => {
  form.clearErrors();
  form.reset();
  emit("update:open", false);
};
</script>
