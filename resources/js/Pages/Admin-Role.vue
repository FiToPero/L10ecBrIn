<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, usePage, router, Head } from '@inertiajs/vue3'
import FlashMessage from '@/Components/FlashMessage.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
    roles: { type: Object, required: true },
    permissions: { type: Object, required: true },
})
const page = usePage()

const isMessage = ref(false)
const closeMessage = () => { 
    isMessage.value = false
    page.props.flash.message = null;
}

watch(() => page.props.flash.message, (newValue) => {
  if (newValue) {
    isMessage.value = true;
  }
}, { immediate: true })
</script>

<template>
<Head title="Admin-Root" />
<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Admin-Root') }}</h2>
    </template>
    <div class="w-full m-3">

        <FlashMessage v-if="isMessage" :message=$page.props.flash.message :color="$page.props.flash.color" @closeMessage="closeMessage"  />
        <div class="m-5">
            <Link v-if="page.props.auth.user.permissions.includes('create_role')" :href="route('adminRole.create')" class="mb-5 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ $t('Create New Role') }}</Link>
        </div>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-3 py-3 w-3">
                                {{ $t('ID') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ $t('Role Name') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ $t('Add Permission') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ $t('Permissions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="role in roles" :key="'roles'+role.id">
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="p-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p class="dark:text-white">{{ role.id }}</p>
                                </th>
                                <td class="p-2 font-medium text-gray-900 whitespace-nowrap">
                                    <p class="dark:text-white">{{ role.name }}</p>
                                </td>
                                <td class="p-2 m-10 font-medium text-gray-900 whitespace-nowrap">
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">{{ $t('Select Permission') }}</option>
                                        <template v-for="permission in permissions" :key="'select'+permission.id">
                                            <option :value="permission.id">{{ permission.name }}</option>
                                        </template>
                                    </select>   
                                </td>
                                <td class=" p-2 font-medium text-gray-900 whitespace-nowrap">
                                    <template v-for="permission in role.permissions" :key="'permissions'+permission.id">
                                        
                                        <PrimaryButton class="m-1">{{ permission.name }}</PrimaryButton>

                                    </template>
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
