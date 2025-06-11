<script setup>
import { ref, watch } from 'vue'
import { router } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'

const props = defineProps({
    products: { type: Object },
    searchName: { type: String },
})

const search = ref('')

watch(search, (value) => {router.get('product', {[props.searchName]: value}, {preserveState: true})})
</script>

<template>
<div class="w-full h-max mt-3 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <!-- Search -->
        <input v-model="search" type="text" class="block w-1/2 m-5 py-2.5 px-2 text-sm text-gray-100 placeholder-gray-900 bg-transparent border-2 rounded-lg border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600" placeholder="Buscar / Search"/> 
        <div class="m-5 relative overflow-x-auto shadow-md sm:rounded-lg">
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
                    <template v-for="product in products.data" :key="'products'+product.id">
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
                                
                                <!-- Slot -->
                               <slot :product="product"  />

                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <Pagination :links="products"/>
    </div>
</div>
</template>