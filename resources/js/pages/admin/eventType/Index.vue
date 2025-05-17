<template>

  <Head title="Event Types" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">Event Types</h1>

      <div class="flex justify-between mb-4">
        <input v-model="form.search" @input="searcheventTypes(eventTypes.current_page)" type="text"
          placeholder="Search by name " class="border border-gray-300 rounded px-3 py-2" />
        <Button @click="createRecord">Create Event Type</Button>
      </div>

      <Datatable :title="'Event Types List'" :columns="columns" :rows="eventTypes.data" :selectable="true"
        :actions="actions" />

      <div class="flex justify-between items-center mt-4">
        <span class="text-sm text-gray-500">
          Showing {{ eventTypes.from }} to {{ eventTypes.to }} of {{ eventTypes.total }} results
        </span>

        <div class="space-x-2">
          <Button variant="outline" size="sm" :disabled="eventTypes.current_page === 1"
            @click="handlePageChange(eventTypes.current_page - 1)">
            Prev
          </Button>
          <Button variant="outline" size="sm" :disabled="eventTypes.current_page === eventTypes.last_page"
            @click="handlePageChange(eventTypes.current_page + 1)">
            Next
          </Button>
        </div>
      </div>
      <EditEventTypeModal v-if="editOpen" :eventType="typeEdit" v-model:open="editOpen" />
      <CreateEventTypeModal v-if="createOpen" v-model:open="createOpen" />
      <DeleteModal v-if="deleteRecord" :id="deleteId" route="types.destroy" :open="deleteRecord"
        @update:open="deleteRecord = $event" />
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
import { ref } from "vue";
import { Trash2, Pencil } from "lucide-vue-next";
import type { BreadcrumbItem } from "@/types";
import type { EventType, EventTypeTable } from "@/client";
import DeleteModal from "@/components/DeleteModal.vue";
import EditEventTypeModal from "./EditEventTypeModal.vue";
import CreateEventTypeModal from "./CreateEventTypeModal.vue";
import type { Ref } from "vue";
const props = defineProps<{
  eventTypes: EventTypeTable;
  filters: Record<string, any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: "Event Types", href: "/eventTypes" }];
const createOpen = ref(false);
const deleteRecord: Ref<boolean> = ref(false);
const deleteId: Ref<number> = ref(0);
const editOpen = ref(false);
const typeEdit: Ref<EventType> = ref({ name: "", id: 0 });
const form = useForm({
  search: props.filters.search || "",
});

// debounce search input
let debounceTimeout: number = 0;
const searcheventTypes = (page: string) => {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(() => {
    router.get(
      route("types.index"),
      { search: form.search, page },
      { preserveState: true, replace: true }
    );
  }, 400);
};

const handlePageChange = (page: number) => {
  router.get(
    route("types.index"),
    { search: form.search, page },
    { preserveState: true, replace: true }
  );
};

const createRecord = () => {
  createOpen.value = true;
  console.log("Create user modal should open");
};

// Define columns
const columns = [
  {
    header: "ID",
    cell: (row: any) => row.id,
  },
  {
    header: "Name",
    cell: (row: any) => row.name,
  },

];

// Define actions with icons
const actions = [
  {
    label: "Edit",
    type: "edit",
    icon: "Pencil",
    onClick: (row: any) => {
      typeEdit.value = row;
      console.log("Edit user", typeEdit.value);
      editOpen.value = true;
    },
  },
  {
    label: "Delete",
    type: "delete",
    icon: "Trash2",
    onClick: (row: any) => {
      deleteData(row.id);
    },
  },
];

const deleteData = (id: number) => {
  deleteId.value = id;
  deleteRecord.value = true;
};
</script>
