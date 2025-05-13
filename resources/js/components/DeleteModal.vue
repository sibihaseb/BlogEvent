<template>
  <div class="space-y-6">
    <HeadingSmall
      title="Delete account"
      description="Delete your account and all of its resources"
    />
    <div
      class="space-y-4 rounded-lg border border-red-100 bg-red-50 p-4 dark:border-red-200/10 dark:bg-red-700/10"
    >
      <div class="relative space-y-0.5 text-red-600 dark:text-red-100">
        <p class="font-medium">Warning</p>
        <p class="text-sm">Please proceed with caution, this cannot be undone.</p>
      </div>
      <Dialog>
        <DialogTrigger as-child>
          <Button variant="destructive">Delete Record</Button>
        </DialogTrigger>
        <DialogContent>
          <form class="space-y-6" @submit="deleteUser">
            <DialogHeader class="space-y-3">
              <DialogTitle>Are you sure you want to delete your account?</DialogTitle>
              <DialogDescription>
                Once your account is deleted, all of its resources and data will also be
                permanently deleted. Please enter your password to confirm you would like
                to permanently delete your account.
              </DialogDescription>
            </DialogHeader>

            <DialogFooter class="gap-2">
              <DialogClose as-child>
                <Button variant="secondary" @click="closeModal"> Cancel </Button>
              </DialogClose>

              <Button variant="destructive" :disabled="form.processing">
                <button type="submit">Delete Record</button>
              </Button>
            </DialogFooter>
          </form>
        </DialogContent>
      </Dialog>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

// Components
import HeadingSmall from "@/components/HeadingSmall.vue";
import { Button } from "@/components/ui/button";
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

const props = defineProps<{
  id: number;
  route: string;
}>();

const form = useForm({});

const deleteUser = (e: Event) => {
  e.preventDefault();

  form.delete(route(props.route, { id: props.id }), {
    preserveScroll: true,
    onSuccess: () => closeModal(),
    onFinish: () => form.reset(),
  });
};

const closeModal = () => {
  form.clearErrors();
  form.reset();
};
</script>
