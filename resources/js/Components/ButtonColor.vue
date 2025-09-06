<script setup>
import { ref } from 'vue'


const props = defineProps({
    bg: { type: String, required: true },
    text: { type: String, required: true }
})

const bg = ref('')
const text = ref('')

switch (props.bg) {
    case 'red':
        bg.value = 'bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto p-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 px-5 py-2.5';
        text.value = 'text-white';
        break;
    case 'green':
        bg.value = 'bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto p-2 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 px-5 py-2.5';
        text.value = 'text-white';
        break;
    case 'blue':
        bg.value = 'bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto p-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 px-5 py-2.5';
        text.value = 'text-white';
        break;
    case 'yellow':
        bg.value = 'bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto p-2 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 px-5 py-2.5';
        text.value = 'text-white';
        break;
    case 'cyan':
        bg.value = 'bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-full sm:w-auto p-2 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800 px-5 py-2.5';
        text.value = 'text-white';
        break;
    case 'gray':
        bg.value = 'bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto p-2 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 px-5 py-2.5';
        text.value = 'text-white';
        break;
}

</script>
<template>
    <button :class="[bg, text]"   >
        <slot />
    </button>
</template>
