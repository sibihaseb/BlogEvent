<script setup lang="ts">
import { Head, useForm } from "@inertiajs/vue3";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";
import InputError from "@/components/InputError.vue";
import AppLayout from "@/layouts/AppLayout.vue";
import { LoaderCircle } from "lucide-vue-next";

import {
  ComboboxRoot,
  ComboboxAnchor,
  ComboboxTrigger,
  ComboboxInput,
  ComboboxContent,
  ComboboxGroup,
  ComboboxLabel,
  ComboboxItem,
  ComboboxItemIndicator,
  ComboboxViewport,
  TagsInputRoot,
  TagsInputItem,
  TagsInputItemText,
  TagsInputItemDelete,
  TagsInputInput,
  useFilter,
} from "reka-ui";
import { Icon } from "@iconify/vue";
import { ref, computed, watch } from "vue";

defineProps<{
  tags: Array<{ id: number; name: string }>;
}>();

const form = useForm({
  picture: null as File | null,
  name: "",
  description: "",
  start_time: "",
  end_time: "",
  location: "",
  type: "",
  tag_ids: [] as number[],
});

const submit = () => {
  form.post(route("events.store"), {
    forceFormData: true,
  });
};

const handleFileChange = (e: Event) => {
  const target = e.target as HTMLInputElement;
  if (target.files?.length) {
    form.picture = target.files[0];
  }
};

// Tags logic
const { contains } = useFilter({ sensitivity: "base" });

const query = ref("");
const values = ref(["Apple"]);
const options = ["Apple", "Banana", "Blueberry", "Grapes", "Pineapple"];

const filteredOptions = computed(() =>
  options.filter(
    (option) => contains(option, query.value) && !values.value.includes(option)
  )
);

watch(
  values,
  () => {
    query.value = "";
  },
  { deep: true }
);
</script>

<template>
  <Head title="Create Event" />
  <AppLayout>
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-6 space-y-6">
      <form @submit.prevent="submit" class="space-y-6">
        <!-- Picture and Name -->
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid gap-2">
            <Label for="picture">Event Picture</Label>
            <Input id="picture" type="file" accept="image/*" @change="handleFileChange" />
            <InputError :message="form.errors.picture" />
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="name">Event Name</Label>
            <Input
              id="name"
              v-model="form.name"
              required
              placeholder="Enter event name"
            />
            <InputError :message="form.errors.name" />
          </div>
        </div>

        <!-- Description -->
        <div class="grid gap-2">
          <Label for="description">Description</Label>
          <textarea
            id="description"
            v-model="form.description"
            rows="4"
            placeholder="Describe the event"
            class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring focus:ring-primary/20"
          ></textarea>
          <InputError :message="form.errors.description" />
        </div>

        <!-- Times and Location -->
        <div class="flex gap-4 flex-col md:flex-row">
          <div class="flex-1 grid md:grid-cols-2 gap-4">
            <div class="grid gap-2">
              <Label for="start_time">Start Time</Label>
              <Input
                id="start_time"
                type="datetime-local"
                v-model="form.start_time"
                required
              />
              <InputError :message="form.errors.start_time" />
            </div>
            <div class="grid gap-2">
              <Label for="end_time">End Time</Label>
              <Input
                id="end_time"
                type="datetime-local"
                v-model="form.end_time"
                required
              />
              <InputError :message="form.errors.end_time" />
            </div>
          </div>
          <div class="flex-1 grid gap-2">
            <Label for="location">Location</Label>
            <Input
              id="location"
              v-model="form.location"
              placeholder="Where is the event?"
            />
            <InputError :message="form.errors.location" />
          </div>
        </div>

        <!-- Type -->
        <div class="grid gap-2">
          <Label for="type">Type</Label>
          <Input id="type" v-model="form.type" placeholder="e.g., Seminar, Workshop" />
          <InputError :message="form.errors.type" />
        </div>

        <!-- Tags Input (Fixed Multi-select) -->
        <div class="grid gap-2">
          <Label>Tags</Label>
          <ComboboxRoot
            v-model="values"
            multiple
            ignore-filter
            class="my-4 mx-auto relative"
          >
            <ComboboxAnchor
              class="w-[400px] inline-flex items-center justify-between rounded-lg p-2 text-[13px] leading-none gap-[5px] bg-white text-grass11 shadow-[0_2px_10px] shadow-black/10 hover:bg-mauve3 focus:shadow-[0_0_0_2px] focus:shadow-black data-[placeholder]:text-grass9 outline-none"
            >
              <TagsInputRoot
                v-model="values"
                delimiter=""
                class="flex gap-2 items-center rounded-lg flex-wrap"
              >
                <TagsInputItem
                  v-for="item in values"
                  :key="item"
                  :value="item"
                  class="flex items-center justify-center gap-2 text-white bg-grass8 aria-[current=true]:bg-grass9 rounded px-2 py-1"
                >
                  <TagsInputItemText class="text-sm" />
                  <TagsInputItemDelete>
                    <Icon icon="lucide:x" />
                  </TagsInputItemDelete>
                </TagsInputItem>

                <ComboboxInput v-model="query" as-child>
                  <TagsInputInput
                    placeholder="Fruits..."
                    class="focus:outline-none flex-1 rounded !bg-transparent placeholder:text-mauve10 px-1"
                    @keydown.enter.prevent
                  />
                </ComboboxInput>
              </TagsInputRoot>

              <ComboboxTrigger>
                <Icon icon="radix-icons:chevron-down" class="h-4 w-4 text-grass11" />
              </ComboboxTrigger>
            </ComboboxAnchor>

            <ComboboxContent
              class="absolute z-10 w-full mt-2 bg-white overflow-hidden rounded shadow-[0px_10px_38px_-10px_rgba(22,_23,_24,_0.35),_0px_10px_20px_-15px_rgba(22,_23,_24,_0.2)] will-change-[opacity,transform] data-[side=top]:animate-slideDownAndFade data-[side=right]:animate-slideLeftAndFade data-[side=bottom]:animate-slideUpAndFade data-[side=left]:animate-slideRightAndFade"
            >
              <ComboboxViewport class="p-[5px]">
                <ComboboxGroup v-if="filteredOptions.length">
                  <ComboboxLabel class="px-[25px] text-xs leading-[25px] text-mauve11">
                    Fruits
                  </ComboboxLabel>

                  <ComboboxItem
                    v-for="(option, index) in filteredOptions"
                    :key="index"
                    class="text-[13px] leading-none text-grass11 rounded-[3px] flex items-center h-[25px] pr-[35px] pl-[25px] relative select-none data-[disabled]:text-mauve8 data-[disabled]:pointer-events-none data-[highlighted]:outline-none data-[highlighted]:bg-grass8 data-[highlighted]:text-grass1"
                    :value="option"
                  >
                    <ComboboxItemIndicator
                      class="absolute left-0 w-[25px] inline-flex items-center justify-center"
                    >
                      <Icon icon="radix-icons:check" />
                    </ComboboxItemIndicator>
                    <span>
                      {{ option }}
                    </span>
                  </ComboboxItem>
                </ComboboxGroup>
              </ComboboxViewport>
            </ComboboxContent>
          </ComboboxRoot>
          <InputError :message="form.errors.tag_ids" />
        </div>

        <!-- Submit -->
        <Button type="submit" class="w-full" :disabled="form.processing">
          <LoaderCircle v-if="form.processing" class="mr-2 h-4 w-4 animate-spin" />
          Create Event
        </Button>
      </form>
    </div>
  </AppLayout>
</template>
