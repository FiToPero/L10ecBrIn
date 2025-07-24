<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import Edit from '@/Pages/Forms/UserForms/Edit.vue'

const props = defineProps({
    status: { type: String },
    user: { type: Object },
    roles: { type: Array },
    errors: { type: Object },
})

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>

            <Edit :user="user" :roles="roles" :errors="errors" /> 
       
    </AuthenticatedLayout>
</template>
