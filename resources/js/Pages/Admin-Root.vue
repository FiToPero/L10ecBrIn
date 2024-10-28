<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, usePage, router, Head } from '@inertiajs/vue3'
import Show from '@/Pages/Show.vue'

const props = defineProps({
    products: { type: Object, required: true },
})
const page = usePage()

const modalShow = ref(false)
const productShow = ref('')
const isMessage = ref(false)

const openShow = (product) => {
    productShow.value = product
    modalShow.value = true
}
const closeShow = () => { modalShow.value = false }

const forceDelete = (id) => {
    router.post(route('product.forceDestroy', [id]), {}, {})   
}
const restore = (id) => {
    router.post(route('product.restore', [id]), {}, {})
}
const closeMessage = () => { isMessage.value = false }

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

                <div class="m-5">
                    <Link :href="route('product.create')" class="mb-5 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ $t('Create New Product') }}</Link>
                </div>
                <Show v-if="modalShow" :product="productShow" @closeShow="closeShow"/>
                
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-3 py-3 w-3">
                                    {{ $t('ID') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Image') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Product Name') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Short Description') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('company') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('brand') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('price') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('stock') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('address') }}
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    {{ $t('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="product in products" :key="product.id">
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="dark:text-white">{{ product.id }}</p>
                                    </th>
                                    <td class="px-2 py-1 w-3 font-medium text-gray-900 whitespace-nowrap text-center">
                                        <img class="object-cover w-12 rounded-lg" :src="`${product.image_01}`" >
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ product.productName }}</p>
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ product.shortDescription }}</p>
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ product.company }}</p>
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ product.brand }}</p>
                                    </td>
                                    <th scope="row" class="text-center px-2 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <p class="dark:text-white">{{ product.price }}</p>
                                    </th>
                                    <td class="text-center px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ product.stock }}</p>
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <p class="dark:text-white">{{ product.address }}</p>
                                    </td>
                                    <td class="px-2 py-1 font-medium text-gray-900 whitespace-nowrap">
                                        <button type="button" @click="restore(product.id)" class="mx-4 text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-136 px-2 py-1 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800 ">{{ $t('Restore') }}</button>
                                        <button type="button" @click="forceDelete(product.id)" class="mx-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ">{{ $t('Force Delete') }}</button>
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
<!-- v-if="$page.props.auth && $page.props.auth.user && $page.props.auth.user.permissions.includes('create_product')" -->