<template>

    <Head title="Ministries" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
            <h1 class="text-xl font-bold">Ministries</h1>

            <div class="flex justify-between mb-4">
                <input v-model="form.search" @input="searchministries(String(ministries.current_page))" type="text"
                    placeholder="Search by name " class="border border-gray-300 rounded px-3 py-2" />
                <Button @click="createRecord">Create Ministries</Button>
            </div>

            <Datatable :title="'Ministries List'" :columns="columns" :rows="ministries.data" :selectable="true"
                :actions="actions" />

            <div class="flex justify-between items-center mt-4">
                <span class="text-sm text-gray-500">
                    Showing {{ ministries.from }} to {{ ministries.to }} of {{ ministries.total }}
                    results
                </span>

                <div class="space-x-2">
                    <Button variant="outline" size="sm" :disabled="ministries.current_page === 1"
                        @click="handlePageChange(ministries.current_page - 1)">
                        Prev
                    </Button>
                    <Button variant="outline" size="sm" :disabled="ministries.current_page === ministries.last_page"
                        @click="handlePageChange(ministries.current_page + 1)">
                        Next
                    </Button>
                </div>
            </div>
            <EditMinistryModal v-if="editOpen" :eventBlog="ministryEdit" v-model:open="editOpen" />
            <CreateMinistryModal v-if="createOpen" v-model:open="createOpen" />
            <DeleteModal v-if="deleteRecord" :id="deleteId" route="ministries.destroy" :open="deleteRecord"
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
// import { Trash2, Pencil } from "lucide-vue-next";
import type { BreadcrumbItem } from "@/types";
import type { Ministry, MinistryTable } from "@/client";
import DeleteModal from "@/components/DeleteModal.vue";
import EditMinistryModal from "./EditMinistryModal.vue";
import CreateMinistryModal from "./CreateMinistryModal.vue";
import type { Ref } from "vue";
const props = defineProps<{
    ministries: MinistryTable;
    filters: Record<string, any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: "Ministries", href: "/eventBlogs" }];
const createOpen = ref(false);
const deleteRecord: Ref<boolean> = ref(false);
const deleteId: Ref<number> = ref(0);
const editOpen = ref(false);
const ministryEdit: Ref<Ministry> = ref({ id: 0, name: "", description: "", icon: "" });
const form = useForm({
    search: props.filters.search || "",
});

// debounce search input
let debounceTimeout: number = 0;
const searchministries = (page: string) => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        router.get(
            route("ministries.index"),
            { search: form.search, page },
            { preserveState: true, replace: true }
        );
    }, 400);
};

const handlePageChange = (page: number) => {
    router.get(
        route("ministries.index"),
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
        icon: "pencil", // Use a string identifier for the icon
        onClick: (row: any) => {
            ministryEdit.value = row;
            console.log("Edit user", ministryEdit.value);
            editOpen.value = true;
        },
    },
    {
        label: "Delete",
        type: "delete",
        icon: "trash-2", // Use a string identifier for the icon
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
