<template >
<div class="flex justify-between mt-2 mb-2 container mx-auto px-4 py-6">
<Link class="btn-normal" :href="route('dashboard.index')">Dashboard</Link>
<Link class="btn-normal" :href="route('cv.create')">Review new CV</Link>
</div>
<section class="container mx-auto px-4 py-6 w-full">
    <h1 class="text-2xl font-bold text-purple-700 mb-4 text-center">Welcome to CV Optimizer</h1>
<h3 class="text-slate-500 font-medium mb-2 mt-16 text-center">Dear {{ user.name }}, below is your latest CV review</h3>

<Box v-if="latestCv" class="flex gap-2 justify-between items-center">
<div class="text-sm font-medium">Date Reviewed: {{dateReviewed }}</div>

<div class="text-sm font-medium">Score: {{ latestCv.score }}%</div>

<Link class="btn-normal" :href="route('cv.show', {cv: latestCv.id})">See Recommendations</Link>
</Box>
<EmptyState v-else class="text-center text-slate-500">You dont have any reviewed CV </EmptyState>

<h3 class="text-slate-500 font-medium mb-2 mt-16 text-center">Previously reviewed CVs</h3>

<div v-if="otherCvs.data.length">
    <OtherCV v-for="otherCv in otherCvs.data" :key="otherCv.id" :otherCv="otherCv"/> 
</div>
<EmptyState v-else>Either you have reviewed only one CV or None </EmptyState>

 

<div v-if="otherCvs.data.length" class="w-full flex justify-center mt-4 mb-4">
<Pagination :links="otherCvs.links" />
</div>

</section>
</template>



<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import Box from '@/components/Box.vue';
import OtherCV from './Components/OtherCV.vue';
 import {computed} from 'vue'

const page = usePage()
const user = computed(

()=>page.props.user
)

const props = defineProps({
    latestCv: Object, otherCvs: Object
});

const dateReviewed = computed(
    () => new Date(props.latestCv.created_at).toDateString()
)

</script>

<script lang="ts">
import MainLayout from '@/components/MainLayout.vue';
import EmptyState from '@/components/EmptyState.vue';
import Pagination from '@/components/Pagination.vue';



export default{

    layout: MainLayout
}
</script>