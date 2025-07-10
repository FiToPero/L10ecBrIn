<script setup>
import { ref, watch } from 'vue'
import { usePage, router, useForm } from '@inertiajs/vue3'
import ButtonColor from '@/Components/ButtonColor.vue'
import CardMobile from '@/Components/CardMobile.vue'

const page = usePage()

const form = useForm({
    
})
const store = () => {
    form.post(route('product.store'))
}


const emit = defineEmits(['closeCreate'])


</script>
<template>
<div class="  w-full h-full p-16   fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">

<CardMobile>

<form v-on:submit.prevent="store" >
    <div class="flex justify-center items-center mb-5">
        <span class="w-5/6 flex justify-center text-white dark:text-gray-300 text-3xl font-bold">Create New Role</span>
        <div class="w-1/6 flex justify-end">
            <ButtonColor text="white" bg="gray" @click="$emit('closeCreate')">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </ButtonColor>
        </div>
    </div>
</form>

</CardMobile>
</div>
</template>