<template>
<div class="flex justify-between mt-2 mb-2 container mx-auto px-4 py-6">
<Link class="btn-normal" :href="route('dashboard.index')">Dashboard</Link>
<Link class="btn-normal" :href="route('interview.index')">Get Started</Link>
</div>
<section class="container mx-auto px-4 py-6 w-full">
    <h1 class="text-2xl font-bold text-purple-700 mb-16 text-center"> Completed Interviews for {{ user.name }}</h1>


<section v-if="interviews.data.length">
   <Interview v-for="interview in interviews.data" :key="interview.id" :interview="interview"/>
</section>
<EmptyState v-else class="text-center text-slate-500">You have not carried out any Interviews with our platform <Link class="text-blue-500" :href="route('interview.index')">click here to start</Link> </EmptyState>


</section>

<div v-if="interviews.data.length" class="w-full flex justify-center mt-4 mb-4">
<Pagination :links="interviews.links" />
</div>
</template>


<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import {computed} from 'vue'

const page = usePage()
const user = computed(

()=>page.props.user
)

defineProps({
interviews: Object
});


</script>

<script lang="ts">
import MainLayout from '@/components/MainLayout.vue';
import EmptyState from '@/components/EmptyState.vue';
import Interview from './Components/Interview.vue';
import Pagination from '@/components/Pagination.vue';

export default{

    layout: MainLayout
}
</script>