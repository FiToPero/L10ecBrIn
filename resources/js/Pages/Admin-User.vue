<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, usePage, useForm, router, Head } from '@inertiajs/vue3'

const props = defineProps({
    users: { type: Object, required: true },
})
const form = useForm({
    name: props.user,
    email: '',
    priority: '3',
})
</script>
<template>
    <Head title="Admin-User" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Admin-User') }}</h2>
        </template>

        <div class="w-full m-3 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- FLASH MESSAGE -->
                <div v-if="isMessage" class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div>
                        <span class="font-medium">  {{ $page.props.flash.message }}</span>
                    </div>
                    <button type="button" @click="closeMessage" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" aria-label="Close">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <!-- FLASH MESSAGE -->

                <!-- <button type="button" @click="openCreate(user)" class="mx-3 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 ">{{ $t('Create New User') }}</button> -->
                <div class="m-5">
                    <Link :href="route('adminUser.create')" class="mb-5 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ $t('Create New User') }}</Link>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-3 w-3">
                                    {{ $t('ID') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Name') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Email') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Email Verified') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Prifile Photo Path') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Role_id') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="user in users" :key="user.id">
                                <!-- {{ user.role.created_at }} -->
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="dark:text-white">{{ user.id }}</p>
                                    </th>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ user.name }}</p>
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ user.email }}</p>
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ user.email_verified_at }}</p>
                                    </td>
                                    <td class="text-center px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ user.profile_photo_path }}</p>
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ user.role_id }}</p>
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <button type="button" @click="openShow(user)" class="mx-3 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 ">{{ $t('Show') }}</button>
                                        <button type="button" @click="editStore(user.id)" class="mx-4 text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-136 px-2 py-1 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800 ">{{ $t('Edit') }}</button>
                                        <button type="button" @click="deleteStore(user.id)" class="mx-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ">{{ $t('Delete') }}</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>