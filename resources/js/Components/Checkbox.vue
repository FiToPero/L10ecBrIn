<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: { type: [Array, Boolean], required: true },
    value: { default: null },
    label: { type: String, required: true },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>

<template>
<div class="flex items-center m-2">
    <input
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800"
    />
    <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ label }}</label>
</div>
</template>
