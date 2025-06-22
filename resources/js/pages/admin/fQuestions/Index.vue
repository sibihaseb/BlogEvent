<template>

  <Head title="Questions" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <h1 class="text-xl font-bold">Questions</h1>

      <div class="flex justify-between mb-4">
        <input v-model="form.search" @input="searchQuestions(String(Questions.current_page))" type="text"
          placeholder="Search by Question " class="border border-gray-300 rounded px-3 py-2" />
        <Button @click="createRecord">Create Question</Button>
      </div>

      <Datatable :title="'Questions List'" :columns="columns" :rows="Questions.data" :selectable="true"
        :actions="actions" />

      <div class="flex justify-between items-center mt-4">
        <span class="text-sm text-gray-500">
          Showing {{ Questions.from }} to {{ Questions.to }} of {{ Questions.total }} results
        </span>

        <div class="space-x-2">
          <Button variant="outline" size="sm" :disabled="Questions.current_page === 1"
            @click="handlePageChange(Questions.current_page - 1)">
            Prev
          </Button>
          <Button variant="outline" size="sm" :disabled="Questions.current_page === Questions.last_page"
            @click="handlePageChange(Questions.current_page + 1)">
            Next
          </Button>
        </div>
      </div>
      <EditQuestionModal v-if="editOpen" :question="typeEdit" v-model:open="editOpen" />
      <CreateQuestionModal v-if="createOpen" v-model:open="createOpen" />
      <DeleteModal v-if="deleteRecord" :id="deleteId" route="frequently-questions.destroy" :open="deleteRecord"
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
import EditEventTypeModal from "./EditQuestionModal.vue";
import CreateEventTypeModal from "./CreateQuestionModal.vue";
import type { Ref } from "vue";
import EditQuestionModal from "./EditQuestionModal.vue";
import CreateQuestionModal from "./CreateQuestionModal.vue";
import { FQuestion } from "@/client/models/FQuestion";
const props = defineProps<{
  Questions: EventTypeTable;
  filters: Record<string, any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: "Questions", href: "/questions" }];
const createOpen = ref(false);
const deleteRecord: Ref<boolean> = ref(false);
const deleteId: Ref<number> = ref(0);
const editOpen = ref(false);
const typeEdit: Ref<FQuestion> = ref({ id: 0, question: "", answer: "", type: "", is_active: "1" });
const form = useForm({
  search: props.filters.search || "",
});

// debounce search input
let debounceTimeout: number = 0;
const searchQuestions = (page: string) => {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(() => {
    router.get(
      route("frequently-questions.index"),
      { search: form.search, page },
      { preserveState: true, replace: true }
    );
  }, 400);
};

const handlePageChange = (page: number) => {
  router.get(
    route("frequently-questions.index"),
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
    header: "Question",
    cell: (row: any) => row.question,
  },
  {
    header: "Page",
    cell: (row: any) => row.type,
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
