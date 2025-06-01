<script setup lang="ts">
import { Icon } from "@iconify/vue";
import { Motion } from "motion-v";
import {
  AccordionRoot,
  AccordionItem,
  AccordionHeader,
  AccordionTrigger,
  AccordionContent,
} from "reka-ui";
import type { AccordionData } from "@/client";

const props = defineProps<{
  accordionItems: AccordionData[];
}>();
</script>

<template>
  <AccordionRoot
    class="bg-white w-full mx-auto rounded-lg border-2 border-gray-200 shadow-lg"
    default-value="item-1"
    type="single"
    :collapsible="true"
  >
    <template v-for="item in props.accordionItems" :key="item.value">
      <AccordionItem
        class="border-b border-gray-200 overflow-hidden focus-within:relative focus-within:z-10"
        :value="item.value"
      >
        <AccordionHeader>
          <AccordionTrigger
            class="text-black bg-white hover:bg-gray-100 transition-colors duration-200 ease-in-out flex items-center justify-between w-full px-5 h-12 text-sm font-medium group focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
          >
            <span>{{ item.title }}</span>
            <Icon
              icon="radix-icons:chevron-down"
              class="transition-transform duration-300 ease-in-out group-data-[state=open]:rotate-180 text-black"
              aria-hidden="true"
            />
          </AccordionTrigger>
        </AccordionHeader>
        <AccordionContent as-child>
          <Motion
            :initial="{ height: 0, opacity: 0 }"
            :animate="{ height: 'auto', opacity: 1 }"
            :exit="{ height: 0, opacity: 0 }"
            :transition="{ duration: 0.3, ease: 'easeInOut' }"
          >
            <div class="px-5 py-4 text-sm text-black bg-white">
              {{ item.content }}
            </div>
          </Motion>
        </AccordionContent>
      </AccordionItem>
    </template>
  </AccordionRoot>
</template>
