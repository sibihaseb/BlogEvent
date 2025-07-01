<template>
  <Head title="Subscriber Management" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-6 p-6 rounded-xl">
      <h1 class="text-xl font-bold">Subscriber Management</h1>

      <div class="flex justify-between mb-4">
        <input
          v-model="form.search"
          @input="searchSubscribers(subscribers.current_page)"
          type="text"
          placeholder="Search by email"
          class="border border-gray-300 rounded px-3 py-2 w-full max-w-md"
        />
      </div>

      <Datatable
        title="Subscriber List"
        :columns="columns"
        :rows="subscribers.data"
        :selectable="true"
        :actions="actions"
      />

      <div class="flex justify-between items-center mt-4">
        <span class="text-sm text-gray-500">
          Showing {{ subscribers.from }} to {{ subscribers.to }} of {{ subscribers.total }} results
        </span>

        <div class="space-x-2">
          <Button
            variant="outline"
            size="sm"
            :disabled="subscribers.current_page === 1"
            @click="handlePageChange(subscribers.current_page - 1)"
          >
            Prev
          </Button>
          <Button
            variant="outline"
            size="sm"
            :disabled="subscribers.current_page === subscribers.last_page"
            @click="handlePageChange(subscribers.current_page + 1)"
          >
            Next
          </Button>
        </div>
      </div>

      <DeleteModal
        v-if="deleteRecord"
        :id="deleteId"
        route="subscriber.destroy"
        :open="deleteRecord"
        @update:open="deleteRecord = $event"
      />
    </div>
    <BaseToast />
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import Datatable from "@/components/Datatable.vue";
import BaseToast from "@/components/BaseToast.vue";
import { Button } from "@/components/ui/button";
import { Trash2 } from "lucide-vue-next";
import DeleteModal from "@/components/DeleteModal.vue";
import { ref } from "vue";
import type { BreadcrumbItem } from "@/types";

const props = defineProps<{
  subscribers: any;
  filters: Record<string, any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
  { title: "Subscriber Management", href: "/subscriber" },
];

const deleteRecord = ref(false);
const deleteId = ref(0);

const form = useForm({
  search: props.filters.search || "",
});

let debounceTimeout: number = 0;
const searchSubscribers = (page: number) => {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(() => {
    router.get(
      route("subscriber.index"),
      { search: form.search, page },
      { preserveState: true, replace: true }
    );
  }, 400);
};

const handlePageChange = (page: number) => {
  router.get(
    route("subscriber.index"),
    { search: form.search, page },
    { preserveState: true, replace: true }
  );
};

const deleteData = (id: number) => {
  deleteId.value = id;
  deleteRecord.value = true;
};

const columns = [
  {
    header: "ID",
    cell: (row: any) => row.id,
  },
  {
    header: "Email",
    cell: (row: any) => row.email,
  },
];

const actions = [
  {
    label: "Delete",
    type: "delete",
    icon: Trash2,
    onClick: (row: any) => deleteData(row.id),
  },
];
</script>
