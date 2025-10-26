<template>

<Box class="flex gap-2 justify-between items-center mb-4">
<div class="text-sm font-medium">Job Title: {{interview.job_title }}</div>

<div class="text-sm font-medium">Score: {{ interview.score }}%</div>

<div class="text-sm font-medium">Date: {{ dateReviewed }}</div> 

<Link class="btn-normal" :href="route('my-interview.show', {my_interview: interview.id})">View More</Link>
</Box>
</template>


<script setup lang="ts">
import Box from '@/components/Box.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
interview: Object
});

const dateReviewed = computed(
    () => new Date(props.interview.created_at).toDateString()
)
</script>

