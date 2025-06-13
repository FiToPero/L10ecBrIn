<script setup>
import { ref, watch } from 'vue'
import { Link, usePage, router, useForm } from '@inertiajs/vue3'
import FlashMessage from '@/Components/FlashMessage.vue'

const page = usePage()

const form = useForm({
    
})
const store = () => {
    form.post(route('product.store'))
}


</script>
<template>
<div class="min-w-full min-h-full p-6 font-sans text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100 antialiased">
<form v-on:submit.prevent="store" >
    <div class="p-4 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none motion-safe:hover:scale-[1.01] transition-all duration-250"> 
        <p class="text-3xl text-center mb-2">CREATE PRODUCT</p>
        <div class="grid xl:grid-cols-3 sm:grid-cols-1 "></div>
    </div>
</form>
</div>
</template>