<template>
<section class="container mx-auto px-4 py-6 w-full">

    <Box v-for="job in jobs " :key="job.id">
{{ job.title }}
</Box>

</section>


</template>


<script setup lang="ts">

defineProps({jobs: Object})

</script>

<script lang="ts">
import Box from '@/components/Box.vue';
import MainLayout from '@/components/MainLayout.vue';



export default{

    layout: MainLayout
}
</script>