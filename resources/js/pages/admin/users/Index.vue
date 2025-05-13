<template>
  <Head title="User Management" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <div class="mb-4">
        <input
          v-model="form.search"
          @input="searchUsers"
          type="text"
          placeholder="Search by name or email"
          class="border border-gray-300 rounded px-3 py-2 w-full"
        />
      </div>

      <Datatable
        :columns="columns"
        :rows="users.data"
        :total="users.total || 0"
        :items-per-page="users.per_page || 10"
        :current-page="users.current_page || 1"
        deleteroute="users.destroy"
        @update:page="handlePageChange"
      />
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import Datatable from "@/components/Datatable.vue";
import type { BreadcrumbItem } from "@/types";
import type { UserTable } from "@/client";
// import { ref, watch } from "vue";

const props = defineProps({
  users: {
    required: true,
    type: Object as () => UserTable,
  },
  filters: {
    required: true,
    type: Object,
  },
});
console.log(props.users.total);
const breadcrumbs: BreadcrumbItem[] = [{ title: "User Management", href: "/users" }];

const form = useForm({
  search: props.filters.search || "",
});

let debounceTimeout = 0;
const searchUsers = () => {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(() => {
    router.get(
      route("users.index"),
      { search: form.search },
      { preserveState: true, replace: true }
    );
  }, 500);
};

const handlePageChange = (newPage: number) => {
  router.get(
    route("users.index"),
    { search: form.search, page: newPage },
    { preserveState: true, replace: true }
  );
};

const columns = [
  { label: "Id", key: "id" },
  { label: "Name", key: "name" },
  { label: "Email", key: "email" },
  //   { label: "Role", key: "role" },
];
</script>

<style scoped>
input:focus {
  outline: none;
  border-color: #3182ce;
}
</style>
