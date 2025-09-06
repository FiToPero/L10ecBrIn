<script setup>


const props = defineProps({
    perId: { type: Number, required: true },
    roleId: { type: Number, required: true },
    text: { type: String, required: true },
    index: { type: Number, required: true },
})

const emit = defineEmits(['remove'])

const remove = (perId, roleId, index) => {
    emit('remove', perId, roleId, index)
}

</script>

<template>
<span class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-blue-800 bg-blue-100 rounded-sm dark:bg-blue-900 dark:text-blue-300">
    {{ text }}
    <button @click="remove(perId, roleId, index)" class="inline-flex items-center p-1 ms-2 text-sm text-blue-400 bg-transparent rounded-xs hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300" >
        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</span>
</template>