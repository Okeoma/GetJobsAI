<template>
    

    <div class=" w-full bg-gradient-to-r from-white via-gray-100 to-white text-gray-900 font-sans">

<!-- Badge -->
<div class="p-4">
    <div class="inline-flex items-center space-x-2 bg-white shadow-lg rounded-full px-4 py-1 text-sm font-medium">
      <svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48..."/> <!-- Optional icon placeholder -->
      </svg>
      <span>Powered by Advanced AI</span>
    </div>
  </div>

<!-- Hero Section -->
<div class="flex flex-col lg:flex-row items-center justify-between px-10 py-16 max-w-7xl mx-auto">
  
  <!-- Text Section -->
  <div class="max-w-xl space-y-6">
    <h1 class="text-5xl font-bold leading-tight">
      Land Your <span class="text-purple-600">Dream Job</span><br/>
      Let AI Work for You.
    </h1>
    <p class="text-lg text-gray-700">
      Revamp your CV. Write your cover letter. Auto-apply to 1000s of jobs. All with one click.
    </p>
    <div class="flex space-x-4">
      <Link :href="route('home')" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg text-lg">
        Get Started →
      </Link>
      <Link :href="route('home')" class="border border-purple-600 text-purple-600 hover:bg-purple-50 px-6 py-3 rounded-lg text-lg flex items-center space-x-2">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4l12 6-12 6z"/></svg>
        <span>See Demo</span>
      </Link>
    </div>
  </div>

  <!-- Visual Section -->
  <div class="relative mt-10 lg:mt-0 w-full max-w-md">
    <!-- Large Icon -->
    <div class="w-48 h-48 bg-gradient-to-br from-purple-600 to-purple-800 rounded-full flex items-center justify-center mx-auto shadow-lg">
      <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M12 4v16m8-8H4"/>
      </svg>
    </div>

    <!-- Floating Elements -->
    <div class="absolute top-0 left-0 w-12 h-12 bg-white rounded-xl shadow-lg transform -translate-x-4 -translate-y-4 flex items-center justify-center">
      <div class="w-8 h-4 bg-purple-600 rounded"></div>
    </div>

    <div class="absolute top-0 right-0 w-6 h-6 bg-white rounded-full shadow-lg flex items-center justify-center">
      <div class="w-3 h-3 bg-green-500 rounded-full"></div>
    </div>

    <div class="absolute bottom-0 right-0 w-20 h-10 bg-white rounded-xl shadow-lg flex items-center px-2 space-x-2">
      <div class="w-6 h-6 bg-purple-600 text-white text-sm font-bold rounded-full flex items-center justify-center">J</div>
      <div class="w-8 h-2 bg-gray-300 rounded"></div>
    </div>
  </div>
</div>
</div>
    

<section class="py-16 px-6 md:px-12 max-w-7xl mx-auto text-center">
    
    <!-- Label Badge -->
    <div class="mb-4">
      <span class="bg-purple-100 text-purple-700 text-xs font-semibold px-4 py-1 rounded-full shadow">
        Powerful Features
      </span>
    </div>

    <!-- Heading -->
    <h2 class="text-4xl font-bold">
      Everything You Need to<br>
      <span class="text-purple-600">Land Your Next Role</span>
    </h2>

    <!-- Subtitle -->
    <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
      Our AI-powered platform streamlines every aspect of your job search, from optimizing your resume to landing interviews.
    </p>

    <!-- Features Grid -->
    <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      
      <!-- Feature Card -->
      <div class="bg-white rounded-xl shadow-md p-6 text-left hover:shadow-lg transition">
        <div class="text-purple-500 text-3xl mb-4">
          📄
        </div>
        <h3 class="text-lg font-semibold">AI CV Revamp</h3>
        <p class="text-gray-600 mt-2 text-sm">
          Transform your resume with AI-powered optimization to match industry standards and ATS requirements.
        </p>
      </div>

      <div class="bg-white rounded-xl shadow-md p-6 text-left hover:shadow-lg transition">
        <div class="text-blue-500 text-3xl mb-4">
          📝
        </div>
        <h3 class="text-lg font-semibold">Smart Cover Letter Generator</h3>
        <p class="text-gray-600 mt-2 text-sm">
          Generate personalized cover letters that speak directly to hiring managers and showcase your unique value.
        </p>
      </div>

      <div class="bg-white rounded-xl shadow-md p-6 text-left hover:shadow-lg transition">
        <div class="text-purple-500 text-3xl mb-4">
          ⚡
        </div>
        <h3 class="text-lg font-semibold">Click Auto Job Apply</h3>
        <p class="text-gray-600 mt-2 text-sm">
          Apply to hundreds of relevant positions automatically while you focus on interview preparation.
        </p>
      </div>

      <div class="bg-white rounded-xl shadow-md p-6 text-left hover:shadow-lg transition">
        <div class="text-green-500 text-3xl mb-4">
          🌐
        </div>
        <h3 class="text-lg font-semibold">Job Aggregator</h3>
        <p class="text-gray-600 mt-2 text-sm">
          Access opportunities from LinkedIn, Indeed, and Glassdoor all in one unified dashboard.
        </p>
      </div>

      <div class="bg-white rounded-xl shadow-md p-6 text-left hover:shadow-lg transition">
        <div class="text-orange-500 text-3xl mb-4">
          🔒
        </div>
        <h3 class="text-lg font-semibold">Secure Data Encryption</h3>
        <p class="text-gray-600 mt-2 text-sm">
          Your personal information and career data are protected with enterprise-grade security.
        </p>
      </div>

      <div class="bg-white rounded-xl shadow-md p-6 text-left hover:shadow-lg transition">
        <div class="text-indigo-500 text-3xl mb-4">
          📊
        </div>
        <h3 class="text-lg font-semibold">Interview Tracking</h3>
        <p class="text-gray-600 mt-2 text-sm">
          Monitor your application progress and get insights to improve your job search strategy.
        </p>
      </div>

    </div>
  </section>

  <section class="max-w-6xl mx-auto p-6">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">

      <!-- Left Content -->
      <div class="p-8 flex flex-col justify-center">
        <h2 class="text-2xl font-bold mb-4">See the Power of AI in Action</h2>
        <p class="text-gray-700 mb-6">
          Watch how our AI transforms a basic resume into an interview-winning document in seconds.
        </p>
        <div class="flex items-center space-x-3">
          <!-- Dots -->
          <div class="flex space-x-1">
            <span class="w-4 h-4 bg-purple-600 rounded-full"></span>
            <span class="w-4 h-4 bg-blue-600 rounded-full"></span>
            <span class="w-4 h-4 bg-green-600 rounded-full"></span>
          </div>
          <span class="text-sm text-gray-600">Trusted by 2,500+ job seekers</span>
        </div>
      </div>

      <!-- Right Content -->
      <div class="bg-gradient-to-r from-indigo-900 to-purple-600 flex items-center justify-center text-center text-white p-10">
        <div>
          <!-- Icon -->
          <div class="bg-purple-500 bg-opacity-30 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
          </div>
          <h3 class="text-lg font-semibold">AI Processing</h3>
          <p class="text-sm mt-1">Analyzing and optimizing...</p>
        </div>
      </div>

    </div>
  </section>
  <section class="py-20 px-6 md:px-12 max-w-7xl mx-auto text-center">
    
    <!-- Badge -->
    <div class="mb-4">
      <span class="bg-purple-100 text-purple-700 text-xs font-semibold px-4 py-1 rounded-full shadow">
        Simple Process
      </span>
    </div>

    <!-- Title -->
    <h2 class="text-4xl font-bold mb-3">How It Works</h2>
    <p class="text-lg text-gray-600 mb-12">
      Get started in minutes and let our AI handle the heavy lifting of your job search.
    </p>

    <!-- 3 Step Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      
      <!-- Step 1 -->
      <div class="bg-white rounded-2xl shadow-lg p-8 relative">
        <!-- Step Badge -->
        <div class="absolute -top-4 left-1/2 -translate-x-1/2">
          <span class="bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full">01</span>
        </div>
        <!-- Icon -->
        <div class="w-14 h-14 bg-purple-100 mx-auto rounded-xl flex items-center justify-center mb-6">
          <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.59 5.58L20 12l-8-8-8 8z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Upload your CV</h3>
        <p class="text-sm text-gray-600">
          Simply upload your existing resume or create one from scratch using our AI-powered builder.
        </p>
      </div>

      <!-- Step 2 -->
      <div class="bg-white rounded-2xl shadow-lg p-8 relative">
        <div class="absolute -top-4 left-1/2 -translate-x-1/2">
          <span class="bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full">02</span>
        </div>
        <div class="w-14 h-14 bg-blue-100 mx-auto rounded-xl flex items-center justify-center mb-6">
          <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 14.93V18h-2v-1.07A8.001 8.001 0 014.07 13H3v-2h1.07A8.001 8.001 0 0111 4.07V3h2v1.07A8.001 8.001 0 0119.93 11H21v2h-1.07A8.001 8.001 0 0113 16.93z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Select preferred roles</h3>
        <p class="text-sm text-gray-600">
          Tell us what kind of positions you're looking for and we’ll customize everything accordingly.
        </p>
      </div>

      <!-- Step 3 -->
      <div class="bg-white rounded-2xl shadow-lg p-8 relative">
        <div class="absolute -top-4 left-1/2 -translate-x-1/2">
          <span class="bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full">03</span>
        </div>
        <div class="w-14 h-14 bg-green-100 mx-auto rounded-xl flex items-center justify-center mb-6">
          <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M5 20h14v-2H5v2zm7-16c-2.21 0-4 1.79-4 4 0 1.66 1.3 3.08 3 3.44V17h2v-5.56c1.7-.36 3-1.78 3-3.44 0-2.21-1.79-4-4-4z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2">Let AI apply</h3>
        <p class="text-sm text-gray-600">
          Sit back and relax while our AI applies to hundreds of relevant positions and tracks responses.
        </p>
      </div>

    </div>
  </section>
</template>

<script setup lang="ts">
import MainLayout from '@/components/MainLayout.vue';

import { Link } from '@inertiajs/vue3'


</script>

<script lang="ts">


export default{

    layout: MainLayout
}
</script>