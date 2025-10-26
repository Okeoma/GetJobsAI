<template>
    <div class="container mx-auto p-6">
      <h2 class="text-xl font-bold mb-4">Start AI Interview</h2>
      <form @submit.prevent="startInterview" class="space-y-4">
        <input v-model="form.job_title" type="text" placeholder="Job Title" class="input" required />
        <textarea v-model="form.job_description" placeholder="Job Description" class="w-full ounded-md block outline outline-slate-200 p-2 shadow-sm border-gray-300 dark:border-gray-500 text-gray-500" required></textarea>
        <button type="submit" class="btn-normal">Generate Questions</button>
      </form>
    </div>
  </template>
  
  <script setup lang="ts">
  import { useForm } from '@inertiajs/vue3'
  
  const form = useForm({
    job_title: '',
    job_description: ''
  })
  
  function startInterview() {
    form.post(route('interview.create'))
  }
  </script>
  <script lang="ts">

  import MainLayout from '@/components/MainLayout.vue';
  
  
  
  export default{
  
      layout: MainLayout
  }
  </script>
  