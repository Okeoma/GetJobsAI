<template>
    <div class="p-6 max-w-xl mx-auto mt-8 mb-8">
      <h2 class="text-xl font-bold mb-4 text-center">Upload Your CV</h2>
  
      <form @submit.prevent="upload" class="space-y-4">
        <input @change="setFile" type="file" class="input block" accept=".pdf,.doc,.docx" />
        <div class="text-sm text-red-500">***PDF recommended</div>
        <button
          type="submit"
          class="btn-normal w-full"
          :disabled="loading || !form.cv"
        >
          {{ loading ? "Uploading..." : "Submit CV" }}
        </button>
      </form>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref } from 'vue'
  import { useForm } from '@inertiajs/vue3'
  import MainLayout from '@/components/MainLayout.vue'
  
  const loading = ref(false)
  
  const form = useForm({
    cv: null,
  })
  
  function setFile(event: Event) {
    const target = event.target as HTMLInputElement
    if (target.files && target.files.length > 0) {
      form.cv = target.files[0]
    }
  }
  
  function upload() {
    if (!form.cv) return alert('Please select a CV to upload.')
  
    loading.value = true
  
    form.post(route('cv.store'), {
      onSuccess: () => {
        loading.value = false
        alert('CV uploaded successfully!')
        form.reset('cv')
      },
      onError: (errors) => {
        loading.value = false
        alert('Upload failed.' + JSON.stringify(errors))
      },
    })
  }
  </script>
  
  <script lang="ts">
  export default {
    layout: MainLayout,
  }
  </script>
  