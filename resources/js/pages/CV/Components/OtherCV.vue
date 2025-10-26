<template>
<Box class="flex gap-2 justify-between items-center mb-4">
    <div class="text-sm font-medium">Date Reviewed: {{dateReviewed }}</div>
    
    <div class="text-sm font-medium">Score: {{ otherCv.score }}%</div>
    
    <Link class="btn-normal" :href="route('cv.show', {cv: otherCv.id})">See Recommendations</Link>
    </Box>

</template>




<script setup lang="ts">
import Box from '@/components/Box.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
otherCv: Object
});

const dateReviewed = computed(
    () => new Date(props.otherCv.created_at).toDateString()
)

</script>