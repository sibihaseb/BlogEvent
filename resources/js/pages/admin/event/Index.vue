<template>
  <Head title="Event Management" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">Event Management</h1>

      <div class="flex justify-between mb-4">
        <input
          v-model="form.search"
          @input="searchEvents(churchevents.current_page)"
          type="text"
          placeholder="Search by name"
          class="border border-gray-300 rounded px-3 py-2"
        />
        <Button @click="createRecord">Create event</Button>
      </div>

      <Datatable
        :title="'Event'"
        :columns="columns"
        :rows="churchevents.data"
        :selectable="true"
        :actions="actions"
      />

      <div class="flex justify-between items-center mt-4">
        <span class="text-sm text-gray-500">
          Showing {{ churchevents.from }} to {{ churchevents.to }} of
          {{ churchevents.total }} results
        </span>

        <div class="space-x-2">
          <Button
            variant="outline"
            size="sm"
            :disabled="churchevents.current_page === 1"
            @click="handlePageChange(churchevents.current_page - 1)"
          >
            Prev
          </Button>
          <Button
            variant="outline"
            size="sm"
            :disabled="churchevents.current_page === churchevents.last_page"
            @click="handlePageChange(churchevents.current_page + 1)"
          >
            Next
          </Button>
        </div>
      </div>
      <DeleteModal
        v-if="deleteRecord"
        :id="deleteId"
        route="churchevents.destroy"
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
import BaseToast from "@/Components/BaseToast.vue";
import { Button } from "@/components/ui/button";
import { ref } from "vue";
import { Trash2, Pencil } from "lucide-vue-next";
import type { BreadcrumbItem } from "@/types";
import type { ChurchEventTable, ChurchEvent } from "@/client";
import DeleteModal from "@/components/DeleteModal.vue";
import type { Ref } from "vue";
import truncate from "html-truncate";

const props = defineProps<{
  churchevents: ChurchEventTable;
  filters: Record<string, any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: "Event Management", href: "/users" }];
const deleteRecord: Ref<boolean> = ref(false);
const deleteId: Ref<number> = ref(0);
const form = useForm({
  search: props.filters.search || "",
});

// debounce search input
let debounceTimeout: number = 0;
const searchEvents = (page) => {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(() => {
    router.get(
      route("churchevents.index"),
      { search: form.search, page },
      { preserveState: true, replace: true }
    );
  }, 400);
};

const handlePageChange = (page: number) => {
  router.get(
    route("churchevents.index"),
    { search: form.search, page },
    { preserveState: true, replace: true }
  );
};

const createRecord = () => {
  router.visit(route("churchevents.create"));
};

// Define columns
const columns = [
  {
    header: "Banner",
    cell: (row: ChurchEvent) => {
      return row.picture
        ? `<img src="storage/${row.picture}" alt="user avatar" class="w-10 h-10 rounded-full object-cover" />`
        : "";
    },
  },
  {
    header: "ID",
    cell: (row: ChurchEvent) => row.id,
  },
  {
    header: "Name",
    cell: (row: ChurchEvent) => row.name,
  },
  {
    header: "Description",
    cell: (row: ChurchEvent) => {
      let desc = row.description;
      if (desc.startsWith('"') && desc.endsWith('"')) {
        desc = desc.slice(1, -1);
      }
      return truncate(desc, 300); // keeps HTML tags intact
    },
  },
  {
    header: "Type",
    cell: (row: ChurchEvent) => row.type,
  },
];

// Define actions with icons
const actions = [
  {
    label: "Edit",
    type: "edit",
    icon: Pencil,
    onClick: (row: ChurchEvent) => {
      router.visit(route("churchevents.edit", { id: row.id }));
    },
  },
  {
    label: "Delete",
    type: "delete",
    icon: Trash2,
    onClick: (row: ChurchEvent) => {
      deleteData(row.id);
    },
  },
];

const deleteData = (id: number) => {
  deleteId.value = id;
  deleteRecord.value = true;
};
</script>
