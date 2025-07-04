<script setup>
import { ref } from 'vue'


const props = defineProps({
    bg: { type: String, required: true },
    text: { type: String, required: true }
})
const classColor = ref("text-"+props.text+" bg-"+props.bg+"-700 hover:bg-"+props.bg+"-800 focus:ring-4 focus:outline-none focus:ring-"+props.bg+"-300 font-medium rounded-lg text-sm w-full sm:w-auto p-2 text-center dark:bg-"+props.bg+"-600 dark:hover:bg-"+props.bg+"-700 dark:focus:ring-"+props.bg+"-800")


</script>
<template>
    <button :class="classColor"   >
        <slot />
    </button>
</template>
