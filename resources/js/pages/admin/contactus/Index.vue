<template>
  <Head title="Contact Us" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">Contact Us</h1>

      <div class="flex justify-start mb-4">
        <input
          v-model="form.search"
          @input="searchUsers(allContacts.current_page)"
          type="text"
          placeholder="Search by name or email"
          class="border border-gray-300 rounded px-3 py-2"
        />
      </div>

      <Datatable
        :title="'Contact Us'"
        :columns="columns"
        :rows="allContacts.data"
        :selectable="true"
        :actions="actions"
      />

      <div class="flex justify-between items-center mt-4">
        <span class="text-sm text-gray-500">
          Showing {{ allContacts.from }} to {{ allContacts.to }} of
          {{ allContacts.total }} results
        </span>

        <div class="space-x-2">
          <Button
            variant="outline"
            size="sm"
            :disabled="allContacts.current_page === 1"
            @click="handlePageChange(allContacts.current_page - 1)"
          >
            Prev
          </Button>
          <Button
            variant="outline"
            size="sm"
            :disabled="allContacts.current_page === allContacts.last_page"
            @click="handlePageChange(allContacts.current_page + 1)"
          >
            Next
          </Button>
        </div>
      </div>
      <DeleteModal
        v-if="deleteRecord"
        :id="deleteId"
        route="contactus.destroy"
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
import { ref } from "vue";
import { Trash2 } from "lucide-vue-next";
import type { BreadcrumbItem } from "@/types";
import type { PaginatorObject, ContactUs } from "@/client";
import DeleteModal from "@/components/DeleteModal.vue";
import type { Ref } from "vue";
const props = defineProps<{
  allContacts: PaginatorObject<ContactUs>;
  filters: Record<string, any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: "Contact Us", href: "/users" }];
const deleteRecord: Ref<boolean> = ref(false);
const deleteId: Ref<number> = ref(0);
const form = useForm({
  search: props.filters.search || "",
});

// debounce search input
let debounceTimeout: number = 0;
const searchUsers = (page: number) => {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(() => {
    router.get(
      route("contactus.index"),
      { search: form.search, page },
      { preserveState: true, replace: true }
    );
  }, 400);
};

const handlePageChange = (page: number) => {
  router.get(
    route("contactus.index"),
    { search: form.search, page },
    { preserveState: true, replace: true }
  );
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
  {
    header: "Subject",
    cell: (row: any) => row.subject,
  },
  {
    header: "Message",
    cell: (row: any) => row.message,
  },
];

// Define actions with icons
const actions = [
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
