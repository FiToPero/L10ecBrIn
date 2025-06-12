<script setup>
import { ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    users: { type: Object },
    searchName: { type: String },
})

const search = ref('')

watch(search, (value) => {router.get('adminUser', {[props.searchName]: value}, {preserveState: true})})
</script>

<template>
<div class="w-full h-max mt-3 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <!-- Search -->  
        <input v-model="search" type="text" class="block w-1/2 m-5 py-2.5 px-2 text-sm text-gray-100 placeholder-gray-900 bg-transparent border-2 rounded-lg border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600" placeholder="Buscar / Search UserName"/> 
        <div class="m-5 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-3 w-3">
                            {{ $t('ID') }}
                        </th>
                         <th scope="col" class="px-6 py-3">
                            {{ $t('UserName') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('Role') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('Email') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('First Name') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('Last Name') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('Phone') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('Address') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('City') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('Country') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('ZIP code') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('Profile Photo path') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('Email Verified') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ $t('ACTION') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="user in users.data" :key="'users'+user.id">
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p class="dark:text-white">{{ user.id }}</p>
                            </th>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.username }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.role_name }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.email }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.first_name }}</p>
                            </td>
                            <th scope="row" class="text-center px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <p class="dark:text-white">{{ user.last_name }}</p>
                            </th>
                            <td class="text-center px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.phone }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.address }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.city }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.country }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.zip_code }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.profile_photo_path }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                <p class="dark:text-white">{{ user.email_verified_at }}</p>
                            </td>
                            <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                
                                <!-- Slot -->
                               <slot :user="user"  />

                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <Pagination :links="users"/>
    </div>
</div>
</template>