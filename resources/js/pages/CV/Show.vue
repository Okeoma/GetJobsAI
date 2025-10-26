
<template>
  <div class="container mx-auto px-4 py-6">

    <!-- Action Buttons -->
    <div class="flex justify-between mb-4">
      <Link class="btn-normal" :href="route('cv.index')">Back</Link>
      <a class="btn-normal" target="_blank" rel="noopener noreferrer" :href="route('download', cv.id)">View CV</a>
      <Link as="button" method="delete" class="btn-normal" :href="route('cv.destroy', { cv: cv.id })">Delete</Link>
    </div>

    <!-- Recommendations Box -->
    <div class="recommendation-box p-4 mb-6">
      <h2>Recommendations</h2>
      <div v-html="formattedRecommendations"></div>
    </div>

    <!-- Optimized CV Box -->
    <div class="optimized-cv-box p-4">
      <h2>Optimized CV</h2>
      <div v-html="formattedOptimizedCv"></div>
    </div>

  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  cv: Object
});

// Format Recommendations (everything before "### Optimized Version of the CV")
const formattedRecommendations = computed(() => {
  if (!props.cv.recommendation) return '';

  const split = props.cv.recommendation.split(/### Optimized Version of the CV/i);
  const recommendationText = split[0].trim();

  return recommendationText
    .replace(/\n/g, '<br>')
    .replace(/#### (.+?)<br>/g, '<h3>$1</h3>')
    .replace(/### (.+?)<br>/g, '<h2>$1</h2>')
    .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
    .replace(/```([\s\S]+?)```/g, (_match, p1) => `<pre><code>${p1}</code></pre>`);
});

// Format Optimized CV (everything after "### Optimized Version of the CV")
const formattedOptimizedCv = computed(() => {
  if (!props.cv.recommendation) return '';

  const split = props.cv.recommendation.split(/### Optimized Version of the CV/i);
  if (!split[1]) return '';

  const optimizedText = split[1].trim();

  return optimizedText
    .replace(/\n/g, '<br>')
    .replace(/#### (.+?)<br>/g, '<h3>$1</h3>')
    .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
    .replace(/```([\s\S]+?)```/g, (_match, p1) => `<pre><code>${p1}</code></pre>`);
});
</script>

<script lang="ts">
import MainLayout from '@/components/MainLayout.vue';

export default {
  layout: MainLayout
};
</script>

<style scoped>


.recommendation-box {
  border: 2px solid #7c3aed; /* purple border */
  border-radius: 8px;

}

.recommendation-box h2 {
  font-weight: 700;
  color: #9333EA; /* purple heading */
  margin-bottom: 1rem;
  text-align: center;
  font-size: x-large;
}

.optimized-cv-box {
  border: 2px solid #7c3aed; /* purple border */
  border-radius: 8px;
  
}

.optimized-cv-box h2 {
  font-weight: 700;
  color: #9333EA; /* green heading */
  margin-bottom: 1rem;
  text-align: center;
  font-size: x-large;
}

.cv-analysis pre {
  background-color: #f5f5f5;
  padding: 1rem;
  overflow-x: auto;
  border-radius: 0.25rem;
  white-space: pre-wrap;
  font-family: monospace;
  word-break: break-word;
  max-width: 100%;
}
</style>
