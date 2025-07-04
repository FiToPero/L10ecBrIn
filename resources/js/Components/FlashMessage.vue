<script setup>
import { ref } from 'vue'

const props = defineProps({
    message: { type: Boolean, required: true },
    color: { type: String }
})
const close = ref(false)

const colorDiv = ref('text-'+props.color+'-800 border border-'+props.color+'-800 bg-'+props.color+'-500 dark:bg-'+props.color+'-500 dark:text-'+props.color+'-700 dark:border-'+props.color+'-800')
const colorButton = ref('bg-'+props.color+'-400 text-'+props.color+'-900 hover:bg-'+props.color+'-500 focus:ring-2 focus:ring-'+props.color+'-500')

const emit = defineEmits(['closeMessage'])
const closeMessage = () => {
    emit('closeMessage', close.value)
}

</script>

<template>
<div class="flex items-center m-5 mr-12 p-4 text-lg rounded-lg" :class="colorDiv" role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div>
        <span class="font-medium">  {{ message }}</span>
    </div>
    <button type="button" @click="closeMessage" :class="colorButton" class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8" aria-label="Close">
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>

</template>