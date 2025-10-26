<template>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        </head>


        <header>
    <nav class="flex items-center justify-between px-6 py-4 shadow relative">
      <!-- Logo -->
      <Link :href="route('home')" class="flex items-center space-x-2">
        <div class="bg-gradient-to-r from-purple-500 to-purple-700 text-white font-bold text-lg rounded-xl w-8 h-8 flex items-center justify-center">
          G
        </div>
        <span class="font-bold text-lg">
          <span class="text-gray-900">GetJobs</span>
          <span class="text-purple-600">AI</span>
        </span>
      </Link>

      <!-- Hamburger (Mobile) -->
      <button @click="isOpen = !isOpen" class="md:hidden flex flex-col space-y-1 focus:outline-none">
        <span :class="['w-6 h-0.5 bg-gray-800 transition', isOpen ? 'rotate-45 translate-y-1.5' : '']"></span>
        <span :class="['w-6 h-0.5 bg-gray-800 transition', isOpen ? 'opacity-0' : '']"></span>
        <span :class="['w-6 h-0.5 bg-gray-800 transition', isOpen ? '-rotate-45 -translate-y-1.5' : '']"></span>
      </button>

      <!-- Navigation + Buttons (Shared for Mobile & Desktop) -->
      <div
        class="absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow md:shadow-none transition-all duration-300 z-20"
        :class="isOpen ? 'flex flex-col md:flex-row' : 'hidden md:flex md:flex-row'"
      >
        <ul class="flex flex-col md:flex-row md:items-center text-gray-800 font-medium md:space-x-8">
          <li><Link :href="route('home')" class="block px-4 py-2 hover:text-purple-600">Home</Link></li>
          <li><Link :href="route('home')" class="block px-4 py-2 hover:text-purple-600">Features</Link></li>
          <li><Link :href="route('home')" class="block px-4 py-2 hover:text-purple-600">Pricing</Link></li>
          <li><Link :href="route('home')" class="block px-4 py-2 hover:text-purple-600">Testimonials</Link></li>
        </ul>

        <!-- Auth Buttons: ONE set for all devices -->
        <div class="flex flex-col md:flex-row items-center md:space-x-4 w-full md:w-auto px-4 py-4 md:py-0 border-t md:border-0">
          <template v-if="user">
            <Link :href="route('dashboard.index')" class="w-full md:w-auto mb-2 md:mb-0 border border-purple-500 rounded-lg px-4 py-1 text-center hover:border-purple-700">
              Dashboard
            </Link>
            <Link :href="route('logout')" method="post" as="button" class="w-full md:w-auto bg-white text-red-500 px-4 py-1 rounded-lg shadow text-center hover:opacity-90">
              Logout
            </Link>
          </template>
          <template v-else>
            <Link :href="route('login')" class="w-full md:w-auto mb-2 md:mb-0 border border-gray-400 rounded-lg px-4 py-1 text-center hover:border-purple-500">
              Sign In
            </Link>
            <Link :href="route('user-account.create')" class="w-full md:w-auto bg-gradient-to-r from-purple-500 to-purple-700 text-white px-4 py-1 rounded-lg shadow text-center hover:opacity-90">
              Try AI Job Assistant
            </Link>
          </template>
        </div>
      </div>
    </nav>
  </header>
<main>
    <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
{{ flashSuccess }}
</div>
<div v-else-if="flashError" class="mb-4 border rounded-md shadow-sm border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900 p-2">
{{ flashError }}
</div>
    <slot></slot>
</main>


<footer class="bg-black text-white px-12 py-10 mt-8">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
    <!-- Left section with logo and description -->
    <div class="space-y-6">
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 rounded-md bg-gradient-to-tr from-purple-700 to-purple-400 flex items-center justify-center">
          <span class="text-white font-bold">G</span>
        </div>
        <span class="text-purple-700 font-semibold text-lg">GetJobsAI</span>
      </div>
      <p class="text-sm leading-relaxed max-w-xs">
        Transform your job search with AI-powered automation. Land your dream job faster with intelligent CV optimization and automated applications.
      </p>
      <div class="flex space-x-5 text-white text-xl">
        <Link :href="route('home')" aria-label="Facebook" class="hover:text-purple-500"><i class="fab fa-facebook-f"></i></Link>
        <Link :href="route('home')" aria-label="Twitter" class="hover:text-purple-500"><i class="fab fa-twitter"></i></Link>
        <Link :href="route('home')" aria-label="LinkedIn" class="hover:text-purple-500"><i class="fab fa-linkedin-in"></i></Link>
        <Link :href="route('home')" aria-label="Instagram" class="hover:text-purple-500"><i class="fab fa-instagram"></i></Link>
      </div>
    </div>

    <!-- Product column -->
    <div class="space-y-3">
      <h3 class="font-semibold mb-3">Product</h3>
      <ul class="space-y-2 text-sm">
        <li><Link :href="route('home')" class="hover:text-purple-500">Features</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">CV Builder</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Cover Letter Generator</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Job Aggregator</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Auto Apply</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Interview Tracker</Link></li>
      </ul>
    </div>

    <!-- Company column -->
    <div class="space-y-3">
      <h3 class="font-semibold mb-3">Company</h3>
      <ul class="space-y-2 text-sm">
        <li><Link :href="route('home')" class="hover:text-purple-500">About Us</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Careers</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Press</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Blog</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Success Stories</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Partners</Link></li>
      </ul>
    </div>

    <!-- Support column -->
    <div class="space-y-3">
      <h3 class="font-semibold mb-3">Support</h3>
      <ul class="space-y-2 text-sm">
        <li><Link :href="route('home')" class="hover:text-purple-500">Help Center</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Contact Support</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Privacy Policy</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Terms of Service</Link></li>
        <li><Link :href="route('home')" class="hover:text-purple-500">Cookie Policy</Link></li>
      </ul>

      <div class="mt-6 space-y-4 text-sm text-gray-300">
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 01-8 0 4 4 0 018 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M12 14v.01"></path><path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6.75 6.75 0 100-13.5 6.75 6.75 0 000 13.5z"></path></svg>
          <span>support@getjobsai.com</span>
        </div>
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10l9 6 9-6-9-6-9 6z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M3 10v10a1 1 0 001 1h16a1 1 0 001-1V10"></path></svg>
          <span>+1 (555) 123-4567</span>
        </div>
        <div class="flex items-center space-x-2">
          <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13 21.314l-4.657-4.657a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
          <span>Manchester, UK</span>
        </div>
      </div>
    </div>
  </div>

  <hr class="border-gray-700 my-8" />

  <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-gray-400 text-sm space-y-4 md:space-y-0">
    <span>© {{ currentYear }} GetJobsAI. All rights reserved.</span>
    <div class="flex space-x-8">
      <Link :href="route('home')" class="hover:text-purple-500">Status</Link>
      <Link :href="route('home')" class="hover:text-purple-500">API</Link>
      <Link :href="route('home')" class="hover:text-purple-500">Security</Link>
      <Link :href="route('home')" class="hover:text-purple-500">Sitemap</Link>
    </div>
  </div>
</footer>


        </template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
 import {computed} from 'vue'
import { ref } from 'vue'

const currentYear = new Date().getFullYear();
console.log(currentYear);


const page = usePage()
const user = computed(

()=>page.props.user
)

const flashSuccess = computed(

()=>page.props.flash.success
)
const flashError = computed(

()=>page.props.flash.error
)
</script>

<script lang="ts">
export default {
  name: 'Navbar',
  data() {
    return {
      isOpen: false,
    }
  },
}
</script>