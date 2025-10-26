<template>
    <div class="text-2xl font-bold text-slate-700 text-center mt-8">Login</div>
    <form @submit.prevent="login">
    
        <div class="w-1/2 mx-auto  mt-16">
    <div class="">
    
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
    
    <button class="btn-normal w-full" type="submit">Login</button>
    <div class="mt-4 text-center"> 
     <Link :href="route('user-account.create')" class="text-sm text-gray-500">Need an account? Click here </Link> 
    </div>
    </div>
    
    
        </div>
    </form>
    
    
    </template>
    
    
    <script setup lang="ts">
    
    import {useForm, Link} from '@inertiajs/vue3'
    
    const form = useForm({
        email: null,
        password: null
    })
    const login = () => form.post(route('signin.store'))
    </script>
    
    <script lang="ts">
    import MainLayout from '@/components/MainLayout.vue';
    export default {
      layout: MainLayout,
      
    }
    </script>