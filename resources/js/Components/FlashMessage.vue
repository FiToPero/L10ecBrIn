<script setup>
import { ref } from 'vue'

const props = defineProps({
    message: { type: String, required: true },
    color: { type: String, required: true }
})
const close = ref(false)
const colorDiv = ref('')
const colorButton = ref('')

switch (props.color) {
    case 'red':
        colorDiv.value = 'text-red-800 border border-red-800 bg-red-500 dark:bg-red-500 dark:text-red-700 dark:border-red-800'
        colorButton.value = 'bg-red-400 text-red-900 hover:bg-red-500 focus:ring-2 focus:ring-red-500'
        break
    case 'green':
        colorDiv.value = 'text-green-800 border border-green-800 bg-green-500 dark:bg-green-500 dark:text-green-700 dark:border-green-800'
        colorButton.value = 'bg-green-400 text-green-900 hover:bg-green-500 focus:ring-2 focus:ring-green-500'
        break
    case 'blue':
        colorDiv.value = 'text-blue-800 border border-blue-800 bg-blue-500 dark:bg-blue-500 dark:text-blue-700 dark:border-blue-800'
        colorButton.value = 'bg-blue-400 text-blue-900 hover:bg-blue-500 focus:ring-2 focus:ring-blue-500'
        break
    case 'yellow':
        colorDiv.value = 'text-yellow-800 border border-yellow-800 bg-yellow-500 dark:bg-yellow-500 dark:text-yellow-700 dark:border-yellow-800'
        colorButton.value = 'bg-yellow-400 text-yellow-900 hover:bg-yellow-500 focus:ring-2 focus:ring-yellow-500'
        break
    case 'cyan':
        colorDiv.value = 'text-cyan-800 border border-cyan-800 bg-cyan-500 dark:bg-cyan-500 dark:text-cyan-700 dark:border-cyan-800'
        colorButton.value = 'bg-cyan-400 text-cyan-900 hover:bg-cyan-500 focus:ring-2 focus:ring-cyan-500'
        break
    default:
        colorDiv.value = 'text-gray-800 border border-gray-800 bg-gray-500 dark:bg-gray-500 dark:text-gray-700 dark:border-gray-800'
        colorButton.value = 'bg-gray-400 text-gray-900 hover:bg-gray-500 focus:ring-2 focus:ring-gray-500'
        break
}

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