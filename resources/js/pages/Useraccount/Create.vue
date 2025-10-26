<template>

    <div class="text-2xl font-bold text-slate-700 text-center mt-8">Register</div>
        <form @submit.prevent="register">
        
            <div class="w-1/2 mx-auto  mt-16">
                <div class="">
        
        <label class="label" for="name">Your Name:</label>
        <input v-model="form.name" class="input" type="text" id="name" />
        <div class="input-error" v-if="form.errors.name">{{ form.errors.name }}</div>
    </div>
    
        <div class="mt-4">
        
            <label class="label" for="email">E-mail:</label>
            <input v-model="form.email" class="input" type="text" id="email" />
            <div class="input-error" v-if="form.errors.email">{{ form.errors.email }}</div>
        </div>
        <div class="mt-4">
        
        <label class="label" for="password">Password:</label>
        <input v-model="form.password" class="input" type="password" id="password" />
        <div class="input-error" v-if="form.errors.password">{{ form.errors.password }}</div>
        </div>
        <div class="mt-4">
        
        <label class="label" for="password_confirmation">Confirm Password:</label>
        <input v-model="form.password_confirmation" class="input" type="password" id="password_confirmation" />
        <div class="input-error" v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</div>
        </div>
        <!-- Rules Feedback -->
        <ul class="mt-2 space-y-1 text-sm">
          <li>
            <span :class="ruleStatus.hasMinLength ? 'text-green-600' : 'text-red-500'">
              {{ ruleStatus.hasMinLength ? '✅' : '❌' }} At least 8 characters
            </span>
          </li>
          <li>
            <span :class="ruleStatus.hasUpperCase ? 'text-green-600' : 'text-red-500'">
              {{ ruleStatus.hasUpperCase ? '✅' : '❌' }} At least one uppercase letter
            </span>
          </li>
          <li>
            <span :class="ruleStatus.hasNumber ? 'text-green-600' : 'text-red-500'">
              {{ ruleStatus.hasNumber ? '✅' : '❌' }} At least one number
            </span>
          </li>
          <li>
            <span :class="ruleStatus.hasSpecialChar ? 'text-green-600' : 'text-red-500'">
              {{ ruleStatus.hasSpecialChar ? '✅' : '❌' }} At least one special character (@, $, !, %, etc.)
            </span>
          </li>
        </ul>
        <div class="mt-4">
        
        
        <button
      class="btn-normal w-full"
      type="submit"
      :disabled="!Object.values(ruleStatus).every(Boolean)"
    >
      Create Account
    </button>
        <div class="mt-4 text-center"> 
        <Link :href="route('login')" class="text-sm text-gray-500">Already have an account? Click here </Link>
    </div>
        </div>
        
        
            </div>
        </form>
        
        
        </template>
        
        
        <script setup lang="ts">
        
        import {useForm, Link} from '@inertiajs/vue3'
        import { ref, computed } from 'vue'
     
        const form = useForm({
            name: null,
            email: null,
            password: null,
            password_confirmation: null
    
        })
    
        const ruleStatus = computed(() => ({
      hasMinLength: form.password?.length >= 8,
      hasUpperCase: /[A-Z]/.test(form.password || ''),
      hasNumber: /[0-9]/.test(form.password || ''),
      hasSpecialChar: /[@$!%*?#£&]/.test(form.password || ''),
    }))
        const register = () => form.post(route('user-account.store'))
        </script>
        
        <script lang="ts">
        import MainLayout from '@/components/MainLayout.vue';
        export default {
          layout: MainLayout
        }
        </script> 