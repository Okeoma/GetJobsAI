   <!-- <template>
    <div class="container mx-auto p-6">
      <h2 class="text-xl font-bold mb-4">Interview: {{ jobTitle }}</h2>
  
      <!-- Show current question -->
      <!-- <div v-if="currentQuestionIndex < questions.length" class="mb-4">
        <p><strong>Q{{ currentQuestionIndex + 1 }}:</strong> {{ questions[currentQuestionIndex] }}</p>
      </div>
  
      <video ref="video" autoplay playsinline class="border rounded w-full h-64 mb-4"></video>
  
      <div>
        <button @click="startRecording" :disabled="recording" class="btn mr-2">Start Recording</button>
        <button @click="nextStep" :disabled="!recording" class="btn">
          {{ isLastQuestion ? "Submit Interview" : "Next Question" }}
        </button>
      </div>
    </div>
  </template> -->
  
  <!-- <script setup lang="ts">
  import { ref, computed } from "vue";
  import { useForm, usePage } from "@inertiajs/vue3";
  
  const page = usePage();
  const jobTitle = page.props.jobTitle;
  const questions = page.props.questions;
  
  const video = ref<HTMLVideoElement | null>(null);
  let mediaRecorder: MediaRecorder;
  let recordedChunks: Blob[] = [];
  
  const recording = ref(false);
  const currentQuestionIndex = ref(0);
  
  // Store all recordings here
  const recordings = ref<File[]>([]);
  
  const form = useForm({
    recordings: [],
    job_title: jobTitle,
    questions: questions,
  });
  
  const isLastQuestion = computed(() => currentQuestionIndex.value === questions.length - 1);
  
  async function startRecording() {
    const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
    if (video.value) video.value.srcObject = stream;
  
    recordedChunks = [];
    mediaRecorder = new MediaRecorder(stream);
    mediaRecorder.ondataavailable = (e) => recordedChunks.push(e.data);
    mediaRecorder.start();
  
    recording.value = true;
  }
  
  function nextStep() {
    mediaRecorder.stop();
  
    mediaRecorder.onstop = () => {
      const blob = new Blob(recordedChunks, { type: "video/webm" });
      const file = new File([blob], `answer_${currentQuestionIndex.value + 1}.webm`, { type: "video/webm" });
  
      // Save recording
      recordings.value.push(file);
  
      if (isLastQuestion.value) {
        // Send all recordings to backend
        form.recordings = recordings.value;
  
        form.post(route("interview.store"), {
          forceFormData: true, // 🔹 ensures files are sent as multipart/form-data
          onError: (errors) => console.error("Upload failed:", errors),
          onSuccess: () => console.log("Interview submitted successfully!"),
        });
      } else {
        currentQuestionIndex.value++;
        recording.value = false;
      }
    };
  }
  </script> -->
  
  <!-- <style>
  .btn {
    background: #2563eb;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
  }
  </style>
  
  <script lang="ts">
  import MainLayout from "@/components/MainLayout.vue";
  
  export default {
    layout: MainLayout,
  };
  </script> -->
  

  <template>
    <div class="container mx-auto p-6">
      <h2 class="text-xl font-bold mb-4">Interview: {{ jobTitle }}</h2>
  
      <!-- Show current question -->
      <div v-if="currentQuestionIndex < questions.length" class="mb-4">
        <p><strong>Q{{ currentQuestionIndex + 1 }}:</strong> {{ questions[currentQuestionIndex] }}</p>
      </div>
  
      <video ref="video" autoplay playsinline class="border rounded w-full h-64 mb-4"></video>
  
      <div>
        <button @click="startRecording" :disabled="recording" class="btn mr-2">Start Recording</button>
        <button @click="nextStep" :disabled="!recording" class="btn">
          {{ isLastQuestion ? "Submit Interview" : "Next Question" }}
        </button>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, computed } from "vue";
  import { useForm, usePage } from "@inertiajs/vue3";
  
  const page = usePage();
  const jobTitle = page.props.jobTitle;
  const questions = page.props.questions;
  
  const video = ref<HTMLVideoElement | null>(null);
  let mediaRecorder: MediaRecorder;
  let recordedChunks: Blob[] = [];
  let mediaStream: MediaStream | null = null; // Keep track of camera stream
  
  const recording = ref(false);
  const currentQuestionIndex = ref(0);
  
  // Store all recordings
  const recordings = ref<File[]>([]);
  
  const form = useForm({
    recordings: [],
    job_title: jobTitle,
    questions: questions,
  });
  
  const isLastQuestion = computed(() => currentQuestionIndex.value === questions.length - 1);
  
  // Start recording and camera
  async function startRecording() {
    mediaStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
    if (video.value) video.value.srcObject = mediaStream;
  
    recordedChunks = [];
    mediaRecorder = new MediaRecorder(mediaStream);
    mediaRecorder.ondataavailable = (e) => recordedChunks.push(e.data);
    mediaRecorder.start();
  
    recording.value = true;
  }
  
  // Stop camera tracks
  function stopCamera() {
    if (mediaStream) {
      mediaStream.getTracks().forEach(track => track.stop());
      mediaStream = null;
    }
  }
  
  function nextStep() {
    mediaRecorder.stop();
  
    mediaRecorder.onstop = () => {
      const blob = new Blob(recordedChunks, { type: "video/webm" });
      const file = new File([blob], `answer_${currentQuestionIndex.value + 1}.webm`, { type: "video/webm" });
  
      // Save recording
      recordings.value.push(file);
  
      // Stop camera immediately
      stopCamera();
  
      if (isLastQuestion.value) {
        // Submit all recordings
        form.recordings = recordings.value;
  
        form.post(route("interview.store"), {
          forceFormData: true,
          onError: (errors) => console.error("Upload failed:", errors),
          onSuccess: () => console.log("Interview submitted successfully!"),
        });
      } else {
        // Move to next question and reset
        currentQuestionIndex.value++;
        recording.value = false;
      }
    };
  }
  </script>
  
  <style>
  .btn {
    background: #2563eb;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
  }
  </style>
  
  <script lang="ts">
  import MainLayout from "@/components/MainLayout.vue";
  
  export default {
    layout: MainLayout,
  };
  </script>
  