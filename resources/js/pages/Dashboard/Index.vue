<template>

  <div class="min-h-screen flex flex-col md:flex-row">
    <!-- Sidebar / Navigation -->
    <aside class="w-full md:w-1/4 bg-white p-6 border-r border-r-purple-500 rounded-md">
      <h2 class="text-xl font-semibold mb-20 text-slate-500 text-center"> 
        <i class="fas fa-user text-purple-500 border border-purple-500 rounded-full p-2"></i> 
         {{ user.name }}</h2>
      <nav class="space-y-4">
        <Link :href="route('home')" class="btn-normal block w-full text-center">Job Search</Link>
        <Link :href="route('cv.index')" class="btn-normal block w-full text-center">CV Optimizer</Link>
        <Link :href="route('my-interview.index')" class=" btn-normal block w-full text-center">AI Interview Preparation</Link>
      </nav>
    </aside>

    <!-- Main Content Area -->
    <main class="w-full md:w-2/3 md:py-6 md:px-16 p-4">
      <h1 class="text-2xl font-bold text-purple-700 mb-4">Welcome to GetJobsAI</h1>
      <p class="text-gray-700 mb-4">
        This is your personal AI-powered career assistant. Use the tools on the left to:
      </p>
      <ul class="list-disc list-inside text-gray-600 space-y-2">
        <li><strong>Job Search:</strong> Discover relevant jobs tailored to your skills.</li>
        <li><strong>CV Optimizer:</strong> Get instant AI feedback on your resume.</li>
        <li><strong>AI Interview Prep:</strong> Practice with smart questions and feedback.</li>
      </ul>

      <div class="mt-8 p-4 bg-purple-50 border border-purple-200 rounded-lg">
        <p class="text-purple-700 font-medium">Tip: Select a tool on the left to get started.</p>
      </div>
    </main>
  </div>


</template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
 import {computed} from 'vue'
import { ref } from 'vue'

const page = usePage()
const user = computed(

()=>page.props.user
)
</script>
<script lang="ts">
import MainLayout from '@/components/MainLayout.vue';




export default{

    layout: MainLayout
}
</script>