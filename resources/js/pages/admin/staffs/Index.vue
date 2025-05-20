<template>
  <Head title="Event Staff Management" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">Event Staff Management</h1>

      <div class="flex justify-between mb-4">
        <input
          v-model="form.search"
          @input="searchStaffs(staffs.current_page)"
          type="text"
          placeholder="Search by name or email"
          class="border border-gray-300 rounded px-3 py-2"
        />
        <Button @click="createRecord">Create staff</Button>
      </div>

      <Datatable
        :title="'Staff List'"
        :columns="columns"
        :rows="staffs.data"
        :selectable="true"
        :actions="actions"
      />

      <div class="flex justify-between items-center mt-4">
        <span class="text-sm text-gray-500">
          Showing {{ staffs.from }} to {{ staffs.to }} of {{ staffs.total }} results
        </span>

        <div class="space-x-2">
          <Button
            variant="outline"
            size="sm"
            :disabled="staffs.current_page === 1"
            @click="handlePageChange(staffs.current_page - 1)"
          >
            Prev
          </Button>
          <Button
            variant="outline"
            size="sm"
            :disabled="staffs.current_page === staffs.last_page"
            @click="handlePageChange(staffs.current_page + 1)"
          >
            Next
          </Button>
        </div>
      </div>
      <EditStaffModal v-if="editOpen" :staff="staffEdit" v-model:open="editOpen" />
      <CreateStaffModal v-if="createOpen" v-model:open="createOpen" />
      <DeleteModal
        v-if="deleteRecord"
        :id="deleteId"
        route="staffs.destroy"
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
import type { StaffTable, EventStaff } from "@/client";
import DeleteModal from "@/components/DeleteModal.vue";
import EditStaffModal from "./EditStaffModal.vue";
import CreateStaffModal from "./CreateStaffModal.vue";
import type { Ref } from "vue";

const props = defineProps<{
  staffs: StaffTable;
  filters: Record<string, any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: "Event Staff Management", href: "/staffs" }];
const createOpen = ref(false);
const deleteRecord: Ref<boolean> = ref(false);
const deleteId: Ref<number> = ref(0);
const editOpen = ref(false);
const staffEdit: Ref<EventStaff> = ref({});
const form = useForm({
  search: props.filters.search || "",
});

let debounceTimeout: number = 0;
const searchStaffs = (page) => {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(() => {
    router.get(
      route("staffs.index"),
      { search: form.search, page },
      { preserveState: true, replace: true }
    );
  }, 400);
};

const handlePageChange = (page: number) => {
  router.get(
    route("staffs.index"),
    { search: form.search, page },
    { preserveState: true, replace: true }
  );
};

const createRecord = () => {
  createOpen.value = true;
};

const columns = [
  {
    header: "ID",
    cell: (row: any) => row.id,
  },
   {
    header: "Image",
    cell: (row: any) => {
      return row.picture
        ? `<img src="${row.image}" alt="user avatar" class="w-10 h-10 rounded-full object-cover" />`
        : "";
    },
  },
  {
    header: "Name",
    cell: (row: any) => row.name,
  },
  {
    header: "Position",
    cell: (row: any) => row.position,
  },
];

const actions = [
  {
    label: "Edit",
    type: "edit",
    icon: Pencil,
    onClick: (row: any) => {
      staffEdit.value = row;
      editOpen.value = true;
    },
  },
  {
    label: "Delete",
    type: "delete",
    icon: Trash2,
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
