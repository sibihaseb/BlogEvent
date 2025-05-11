<script setup lang="ts">
import HeaderLayout from "./frontend/HeaderLayout.vue";
import FooterLayout from "./frontend/FooterLayout.vue";

defineProps<{
  title?: string;
  description?: string;
}>();
</script>

<template>
  <HeaderLayout />
  <slot />
  <FooterLayout />
</template>
