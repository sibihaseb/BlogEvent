<script setup lang="ts">
import type { ReferenceElement } from "reka-ui";
import {
  ComboboxAnchor,
  ComboboxContent,
  ComboboxInput,
  ComboboxItem,
  ComboboxPortal,
  ComboboxRoot,
  Label,
  useFilter,
} from "reka-ui";
import { computed, ref, watch, watchEffect } from "vue";
import { computedWithControl } from "@vueuse/core";
import {
  getAnchorRect,
  getSearchValue,
  getTrigger,
  getTriggerOffset,
  replaceValue,
} from "./utils";

// Props
defineProps<{
  modelValue: string;
  label?: string;
}>();

const emit = defineEmits(["update:modelValue"]);

const { contains } = useFilter({ sensitivity: "base" });

const value = ref("");
const trigger = ref<string | null>(null);
const caretOffset = ref<number | null>(null);
const open = ref(false);
const searchValue = ref("");
const textareaRef = ref<InstanceType<typeof ComboboxInput>>();

const list = ref<string[]>([
  "@alice",
  "@bob",
  "#Laravel",
  "#Vue3",
  ":smile:",
  ":rocket:",
]);

const reference = computedWithControl(
  () => [searchValue.value, open.value],
  () =>
    ({
      getBoundingClientRect: () => {
        if (textareaRef.value?.$el) {
          const { x, y, height } = getAnchorRect(textareaRef.value.$el);
          return { x, y, height, top: y, left: x, width: 0 };
        } else {
          return null;
        }
      },
    } as ReferenceElement)
);

const filteredList = computed(() =>
  list.value.filter((item) => contains(item, searchValue.value))
);

watch(
  () => filteredList.value.length,
  () => {
    open.value = !!filteredList.value.length;
  }
);

watchEffect(() => {
  const textarea = textareaRef.value?.$el as HTMLTextAreaElement | undefined;
  if (caretOffset.value !== null && textarea) {
    textarea.setSelectionRange(caretOffset.value, caretOffset.value);
  }
});

watch(
  () => value.value,
  (val) => emit("update:modelValue", val)
);

function handleChange(ev: InputEvent) {
  const target = ev.target as HTMLTextAreaElement;
  const _trigger = getTrigger(target);
  const _searchValue = getSearchValue(target);

  if (_trigger) {
    trigger.value = _trigger;
    open.value = true;
  } else if (!_searchValue) {
    trigger.value = null;
    open.value = false;
  }

  value.value = target.value;
  searchValue.value = _searchValue;

  if (!_trigger) open.value = false;
}

function handleSelect(ev: CustomEvent) {
  const textarea = textareaRef.value?.$el;
  if (!textarea) return;

  const offset = getTriggerOffset(textarea);
  const selected = ev.detail.value;

  ev.preventDefault();
  trigger.value = null;
  value.value = replaceValue(value.value, offset, searchValue.value, selected);
  caretOffset.value = offset + selected.length + 1;
}
</script>

<template>
  <ComboboxRoot
    v-model:open="open"
    ignore-filter
    :reset-search-term-on-blur="false"
    class="text-foreground flex flex-col"
  >
    <Label v-if="label" for="textarea" class="text-sm font-semibold">
      {{ label }}
    </Label>

    <ComboboxInput
      id="textarea"
      ref="textareaRef"
      v-model="value"
      as="textarea"
      class="mt-2 border rounded-md border-muted w-full p-2"
      rows="5"
      placeholder="Type @, # or :"
      @input="handleChange"
      @pointerdown="open = false"
      @keydown.enter="(ev: KeyboardEvent) => open && ev.preventDefault()"
      @keydown.left.right="open = false"
    />
    <ComboboxAnchor :reference="reference" />

    <ComboboxPortal>
      <ComboboxContent
        v-if="filteredList.length"
        position="popper"
        side="bottom"
        align="start"
        class="overflow-y-auto overflow-x-hidden max-h-48 w-full bg-card border border-muted-foreground/30 p-1.5 rounded-md"
      >
        <ComboboxItem
          v-for="item in filteredList"
          :key="item"
          :value="item"
          class="px-2 py-1 data-[highlighted]:bg-muted rounded flex cursor-default"
          @select="handleSelect"
        >
          <span class="truncate">{{ item }}</span>
        </ComboboxItem>
      </ComboboxContent>
    </ComboboxPortal>
  </ComboboxRoot>
</template>
