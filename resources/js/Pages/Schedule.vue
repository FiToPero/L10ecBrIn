<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'

</script>
<template>
    <Head title="Schedule" />
<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Schedule') }}</h2>
    </template>
    <div class="container mx-auto p-4 text-gray-900 dark:text-white">Schedule works!</div>
</AuthenticatedLayout>
</template>