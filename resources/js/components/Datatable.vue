<script setup lang="ts">
import { computed, ref } from "vue";
// import { router, usePage } from "@inertiajs/vue3";
import { Button } from "@/components/ui/button";
import { Trash2, Pencil } from "lucide-vue-next";

type Column<T> = {
  accessorKey?: string;
  header: string;
  cell: (row: T) => string | number | JSX.Element;
  sortable?: boolean;
  searchable?: boolean;
  width?: string;
};

type Action<T> = {
  label: string;
  icon?: string;
  onClick: (row: T) => void;
  permission?: string;
};

const props = defineProps<{
  columns: Column<any>[];
  rows: any[];
  pagination?: boolean;
  actions?: Action<any>[];
  selectable?: boolean;
  title?: string;
}>();

const selectedRows = ref<any[]>([]);

const toggleSelectAll = () => {
  if (allSelected.value) {
    selectedRows.value = [];
  } else {
    selectedRows.value = [...props.rows];
  }
};

const toggleRow = (row: any) => {
  const index = selectedRows.value.findIndex((r) => r.id === row.id);
  if (index !== -1) {
    selectedRows.value.splice(index, 1);
  } else {
    selectedRows.value.push(row);
  }
};

const allSelected = computed(() => {
  return props.rows.length && selectedRows.value.length === props.rows.length;
});
</script>

<template>
  <div class="border rounded-xl shadow-sm p-4">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-semibold" v-if="title">{{ title }}</h2>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full table-auto text-left text-sm">
        <thead class="bg-gray-100">
          <tr>
            <th v-if="selectable" class="px-4 py-2">
              <input type="checkbox" :checked="allSelected" @change="toggleSelectAll" />
            </th>
            <th
              v-for="(col, index) in columns"
              :key="index"
              class="px-4 py-2 font-semibold"
              :style="{ width: col.width || 'auto' }"
            >
              {{ col.header }}
            </th>
            <th v-if="actions?.length" class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(row, rowIndex) in rows"
            :key="rowIndex"
            class="hover:bg-gray-50"
            :class="{ 'bg-gray-50': selectedRows.includes(row) }"
          >
            <td v-if="selectable" class="px-4 py-2">
              <input
                type="checkbox"
                :checked="selectedRows.includes(row)"
                @change="toggleRow(row)"
              />
            </td>
            <td v-for="(col, colIndex) in columns" :key="colIndex" class="px-4 py-2">
              {{ col.cell(row) }}
            </td>
            <td v-if="actions?.length" class="px-4 py-2">
              <div class="flex gap-2">
                <Button
                  v-for="(action, i) in actions"
                  :key="i"
                  variant="ghost"
                  size="xs"
                  @click="() => action.onClick(row)"
                  class="flex items-center gap-1"
                >
                  <component
                    :is="
                      action.type === 'edit'
                        ? Pencil
                        : action.type === 'delete'
                        ? Trash2
                        : null
                    "
                    class="w-4 h-4"
                  />
                </Button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <div v-if="!rows.length" class="text-center py-6 text-gray-500">No data found.</div>
    </div>
  </div>
</template>
