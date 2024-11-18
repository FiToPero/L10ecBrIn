<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, usePage, router, Head } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'
import Show from '@/Pages/Show.vue'

const search = ref('')
const modalShow = ref(false)
const productShow = ref('')
const isMessage = ref(false)

const page = usePage()

const props = defineProps({
    products: { type: Object, required: true },
})

const openShow = (product) => {
    productShow.value = product
    modalShow.value = true
}
const closeShow = () => { modalShow.value = false }
const closeMessage = () => { isMessage.value = false }

watch(page.props.flash.message, () => {
        if(page.props.flash.message){ isMessage.value = true }
    }, { immediate: true })
watch(search, (value) => {router.get('/', {search: value}, {preserveState: true})})

</script>

<template>
<Head title="Welcome" />
<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Welcome') }}</h2>
    </template>
<div @click="closeShow" class=" min-h-screen bg-gray-100 dark:bg-gray-900 p-5">
    <p class="text-white">{{ UserStore }}</p>
    <input v-model="search" type="text" class="block my-5 py-2.5 px-2 w-full text-sm text-gray-100 placeholder-gray-900 bg-transparent border-2 rounded-lg border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600" placeholder="Buscar / Search"/> 
    <Show v-if="modalShow" :product="productShow" @closeShow="closeShow"/>
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
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    <!-- all card -->  
    <template v-for="product in products.data" :key="product.id">
        <div @dblclick="openShow(product)" tabindex="0" :class="[product.priority == 1 ? 'md:col-span-3': '', product.priority == 2 ? 'md:col-span-2': '', 'sm:col-span-1 min-w-full min-h-96 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500']">
            <div class="w-1/3">
                <img class="object-cover w-full rounded-lg" :src="`${product.image_01}`" >
            </div>
            <div class=w-2/3>
                <div class="ml-4">
                    <input type="hidden" name="id_product" class=""  :placeholder="product.id" disabled/>
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="productName" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="product.productName" disabled/> 
                    </div>
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="shortDescription" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600" :placeholder="product.shortDescription" disabled/>
                    </div>
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="company" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="product.company" disabled/>
                    </div>
                    <div class="grid md:grid-cols-3 md:gap-6">
                        <div class="relative z-0 w-full mb-2 group">
                            <input type="text" name="stock" class="block py-2.5 px-0 w-full text-sm text-center placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600" :placeholder="product.stock" disabled/>
                        </div>
                        <div class="relative z-0 w-full mb-2 group">
                            <input type="text" name="price" class="block py-2.5 px-0 w-full text-sm text-center placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600" :placeholder="`€ ${product.price}`" disabled/>
                        </div>
                        <div class="relative z-0 w-full mb-2 group">
                            <input type="text" name="priority" class="block py-2.5 px-0 w-full text-sm text-center placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="product.priority" disabled/>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="brand" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="product.brand" disabled/>
                    </div>
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="address" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="product.address" disabled/>
                    </div>
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="website" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="product.website" disabled/>
                    </div>
                    <div class="relative z-0 w-full mb-2 group">
                        <input type="text" name="email" class="block py-2.5 px-0 w-full text-sm placeholder-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:placeholder-gray-300 dark:border-gray-600"  :placeholder="product.email" disabled/>
                    </div>
                </div>
            </div>
        </div>  
    </template>
    <!-- END all card -->
    </div>
        <!-- Pagination    -->
        <Pagination :links="products"/>
</div>
</AuthenticatedLayout>
</template>
