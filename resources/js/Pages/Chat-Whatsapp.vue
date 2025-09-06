<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'


</script>
<template>
    <Head title="Chat WhatsApp" />
<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Admin-Root') }}</h2>
    </template>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Chat WhatsApp</h1>
        <p>Esta es la página de Chat WhatsApp.</p>
    </div>
</AuthenticatedLayout>
</template>