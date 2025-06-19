<script setup>
import { ref } from 'vue';


const model = defineModel('model', { type: String, required: true })
const errors = defineModel('errors',{ type: Object, required: true, default: null })

const props = defineProps({ 
    id : { type: String, required: true },
    label: { type: String, required: true },
    type: { type: String, default: 'text' },
    disabled: { type: Boolean, default: false },
    autofocus: { type: Boolean, default: false },
})

const input = ref(null);

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <label :id="id" for=first_name class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>{{ label }}</label>
    <input
        :id="id"
        v-model="model"
        class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
        :class="{'border-red-500 dark:border-red-500' : errors}"
        :disabled="disabled"
        :autofocus="autofocus"
        :type="type"
        ref="input"
        @focus="errors = ''"
    />
    <div v-if="errors" class="text-red-500 text-sm font-bold">{{ errors }}</div>

</template>
