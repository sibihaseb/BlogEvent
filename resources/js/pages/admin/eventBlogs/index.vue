<template>

    <Head title="Event Blogs" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
            <h1 class="text-xl font-bold">Event Blogs</h1>

            <div class="flex justify-between mb-4">
                <input v-model="form.search" @input="searchchurchEventBlogs(String(churchEventBlogs.current_page))"
                    type="text" placeholder="Search by name " class="border border-gray-300 rounded px-3 py-2" />
                <Button @click="createRecord">Create Event Blog</Button>
            </div>

            <Datatable :title="'Event Blogs List'" :columns="columns" :rows="churchEventBlogs.data" :selectable="true"
                :actions="actions" />

            <div class="flex justify-between items-center mt-4">
                <span class="text-sm text-gray-500">
                    Showing {{ churchEventBlogs.from }} to {{ churchEventBlogs.to }} of {{ churchEventBlogs.total }}
                    results
                </span>

                <div class="space-x-2">
                    <Button variant="outline" size="sm" :disabled="churchEventBlogs.current_page === 1"
                        @click="handlePageChange(churchEventBlogs.current_page - 1)">
                        Prev
                    </Button>
                    <Button variant="outline" size="sm"
                        :disabled="churchEventBlogs.current_page === churchEventBlogs.last_page"
                        @click="handlePageChange(churchEventBlogs.current_page + 1)">
                        Next
                    </Button>
                </div>
            </div>
            <EditEventBlogModal v-if="editOpen" :eventBlog="blogEdit" v-model:open="editOpen" />
            <CreateEventBlogModal v-if="createOpen" v-model:open="createOpen" />
            <DeleteModal v-if="deleteRecord" :id="deleteId" route="blogs.destroy" :open="deleteRecord"
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
import type { EventBlogs, EventBlogsTable } from "@/client";
import DeleteModal from "@/components/DeleteModal.vue";
import type { Ref } from "vue";
const props = defineProps<{
    churchEventBlogs: EventBlogsTable;
    filters: Record<string, any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [{ title: "Event Blogs", href: "/eventBlogs" }];
const createOpen = ref(false);
const deleteRecord: Ref<boolean> = ref(false);
const deleteId: Ref<number> = ref(0);
const editOpen = ref(false);
const blogEdit: Ref<EventBlogs> = ref({ id: 0, name: "", description: "", image: "", type: "", });
const form = useForm({
    search: props.filters.search || "",
});

// debounce search input
let debounceTimeout: number = 0;
const searchchurchEventBlogs = (page: string) => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        router.get(
            route("blogs.index"),
            { search: form.search, page },
            { preserveState: true, replace: true }
        );
    }, 400);
};

const handlePageChange = (page: number) => {
    router.get(
        route("blogs.index"),
        { search: form.search, page },
        { preserveState: true, replace: true }
    );
};

const createRecord = () => {
    router.visit(route('blogs.create'));

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
        header: "type",
        cell: (row: any) => row.type,
    },

];

// Define actions with icons
const actions = [
    {
        label: "Edit",
        type: "edit",
        icon: "pencil", // Use a string identifier for the icon
        onClick: (row: any) => {
            router.visit(route("blogs.edit", { id: row.id }));

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
