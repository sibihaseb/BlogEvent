<template>
  <Head title="User Management" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">User Management</h1>

      <div class="flex justify-between mb-4">
        <input
          v-model="form.search"
          @input="searchUsers(users.current_page)"
          type="text"
          placeholder="Search by name or email"
          class="border border-gray-300 rounded px-3 py-2"
        />
        <Button @click="createRecord">Create user</Button>
      </div>

      <Datatable
        :title="'Users List'"
        :columns="columns"
        :rows="users.data"
        :selectable="true"
        :actions="actions"
      />

      <div class="flex justify-between items-center mt-4">
        <span class="text-sm text-gray-500">
          Showing {{ users.from }} to {{ users.to }} of {{ users.total }} results
        </span>

        <div class="space-x-2">
          <Button
            variant="outline"
            size="sm"
            :disabled="users.current_page === 1"
            @click="handlePageChange(users.current_page - 1)"
          >
            Prev
          </Button>
          <Button
            variant="outline"
            size="sm"
            :disabled="users.current_page === users.last_page"
            @click="handlePageChange(users.current_page + 1)"
          >
            Next
          </Button>
        </div>
      </div>
      <EditUserModal v-if="editOpen" :user="userEdit" v-model:open="editOpen" />
      <CreateUserModal v-if="createOpen" v-model:open="createOpen" />
      <DeleteModal
        v-if="deleteRecord"
        :id="deleteId"
        route="users.destroy"
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
import type { UserTable, User } from "@/client";
import DeleteModal from "@/components/DeleteModal.vue";
import EditUserModal from "./EditUserModal.vue";
import CreateUserModal from "./CreateUserModal.vue";
import type { Ref } from "vue";
const props = defineProps<{
  users: UserTable;
  filters: Record<string, any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: "User Management", href: "/users" }];
const createOpen = ref(false);
const deleteRecord: Ref<boolean> = ref(false);
const deleteId: Ref<number> = ref(0);
const editOpen = ref(false);
const userEdit: Ref<User> = ref({});
const form = useForm({
  search: props.filters.search || "",
});

// debounce search input
let debounceTimeout: number = 0;
const searchUsers = (page) => {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(() => {
    router.get(
      route("users.index"),
      { search: form.search, page },
      { preserveState: true, replace: true }
    );
  }, 400);
};

const handlePageChange = (page: number) => {
  router.get(
    route("users.index"),
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
  {
    header: "Email",
    cell: (row: any) => row.email,
  },
];

// Define actions with icons
const actions = [
  {
    label: "Edit",
    type: "edit",
    icon: Pencil,
    onClick: (row: any) => {
      userEdit.value = row;
      console.log("Edit user", userEdit.value);
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
