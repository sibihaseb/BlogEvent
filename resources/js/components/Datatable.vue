<template>
  <div class="p-4 space-y-4">
    <!-- Table -->
    <div class="overflow-x-auto rounded border border-gray-200">
      <table class="min-w-full table-auto border-collapse">
        <thead class="bg-gray-100 text-gray-700 text-left">
          <tr>
            <th v-for="(col, i) in columns" :key="i" class="px-4 py-2 font-semibold">
              {{ col.label }}
            </th>
            <th class="px-4 py-2 font-semibold text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(row, rowIndex) in rows" :key="rowIndex" class="border-t">
            <td v-for="(col, colIndex) in columns" :key="colIndex" class="px-4 py-2">
              {{ row[col.key] }}
            </td>
            <td class="px-4 py-2 flex justify-center">
              <Trash2 @click="deleteData(row.id)" />
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <PaginationRoot
      class="flex justify-center pt-2"
      :total="props.total"
      :page="page"
      :items-per-page="itemsPerPage"
      :sibling-count="1"
      @update:page="(val) => (page = val)"
    >
      <PaginationList v-slot="{ items }" class="flex gap-1">
        <template v-for="(item, index) in items" :key="index">
          <PaginationListItem
            v-if="item.type === 'page'"
            :value="item.value"
            :class="[
              'px-3 py-1 border rounded text-sm',
              page === item.value
                ? 'bg-blue-600 text-white'
                : 'hover:bg-blue-100 text-gray-700',
            ]"
          >
            {{ item.value }}
          </PaginationListItem>
          <PaginationEllipsis v-else :index="index" class="px-2 text-gray-500">
            &hellip;
          </PaginationEllipsis>
        </template>
      </PaginationList>
    </PaginationRoot>
    <DeleteModal v-if="deleteRecord" :route="props.deleteroute" :id="deleteId" />
  </div>
</template>

<script setup lang="ts">
import {
  PaginationRoot,
  PaginationList,
  PaginationListItem,
  PaginationEllipsis,
} from "reka-ui";
import { ref, watch } from "vue";
import DeleteModal from "./DeleteModal.vue";
import { Trash2 } from "lucide-vue-next";
import type { Ref } from "vue";
const deleteRecord: Ref<boolean> = ref(false);
const deleteId: Ref<number> = ref(0);

interface Column {
  label: string;
  key: string;
}

const props = defineProps<{
  columns: Column[];
  rows: Record<string, any>[];
  total: number;
  currentPage?: number;
  itemsPerPage?: number;
  deleteroute: string;
}>();

const emit = defineEmits<{
  (e: "update:page", value: number): void;
}>();

const page = ref(props.currentPage || 1);
const itemsPerPage = ref(props.itemsPerPage || 20);

// Watch local `page` and emit change
watch(page, (val) => {
  emit("update:page", val);
});

const deleteData = (id: number) => {
  deleteId.value = id;
  deleteRecord.value = true;
};
</script>
