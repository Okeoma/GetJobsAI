<template>
  <div class="flex gap-1">
    <template v-for="(link, index) in links" :key="index">
      <Link
        v-if="link.url"
        :href="link.url"
        class="py-2 px-4 rounded-md border"
        :class="{
          'bg-indigo-500 text-white': link.active,
          'hover:bg-indigo-200': !link.active
        }"
        v-html="link.label"
      />
      <span
        v-else
        class="py-2 px-4 rounded-md border text-gray-400 cursor-not-allowed"
        v-html="link.label"
      />
    </template>
  </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'

defineProps({
  links: Array
})
</script>
