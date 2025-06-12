<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, usePage, router, Head } from '@inertiajs/vue3'
import Show from '@/Pages/Forms/ProductForms/Show.vue'
import ProductTable from '@/Tables/ProductTable.vue'
import FlashMessage from '@/Components/FlashMessage.vue'

const props = defineProps({
    products: { type: Object, required: true },
    productsTrashed: { type: Object },
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

const deleteStore = (id) => {
    router.delete(route('product.delete', [id]), {}, {})   
}
const editStore = (id) => {
    router.get(route('product.edit', [id]), {}, {})
}
const forceDelete = (id) => {
    router.delete(route('product.forceDestroy', [id]), {}, {})   
}
const restore = (id) => {
    router.patch(route('product.restore', [id]), {}, {})
}

const closeMessage = () => { 
    isMessage.value = false
    page.props.flash.message = null;
}

watch(() => page.props.flash.message, (newValue) => {
  if (newValue) { isMessage.value = true; }
}, { immediate: true })

</script>

<template>
    <Head title="Product" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Products') }}</h2>
        </template>
        <div class="w-full m-3">
            <!-- FLASH MESSAGE -->
            <FlashMessage v-if="isMessage" :message="$page.props.flash.message" :color="$page.props.flash.color" @closeMessage="closeMessage" />
            <!-- button Create -->
            <div class="m-5">
                <Link v-if="page.props.auth.user.permissions.includes('create_product')" :href="route('product.create')" class="mb-5 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ $t('Create New Product') }}</Link>
            </div>
            <!-- Modal Show -->
            <Show v-if="modalShow" :product="productShow" @closeShow="closeShow" />
        </div>
        <!-- Product Table -->
        <ProductTable  :products="products" searchName="product" v-slot="{product}">
            <button type="button" @click="openShow(product)" class="mx-3 text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 ">{{ $t('Show') }}</button>
            <button v-if="page.props.auth.user.permissions.includes('update_product')" type="button" @click="editStore(product.id)" class="mx-4 text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-136 px-2 py-1 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800 ">{{ $t('Edit') }}</button>
            <button v-if="page.props.auth.user.permissions.includes('delete_product')" type="button" @click="deleteStore(product.id)" class="mx-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ">{{ $t('Delete') }}</button>
        </ProductTable>
        <!-- Product Trashed Table -->
        <ProductTable :products="productsTrashed" searchName="productTrashed" v-slot="{product}" >
            <button v-if="page.props.auth.user.permissions.includes('restore_product')" type="button" @click="restore(product.id)" class="mx-4 text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm w-136 px-2 py-1 text-center dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:ring-cyan-800 ">{{ $t('Restore') }}</button>
            <button v-if="page.props.auth.user.permissions.includes('forceDelete_product')" type="button" @click="forceDelete(product.id)" class="mx-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 ">{{ $t('Force Delete') }}</button>
        </ProductTable>

    </AuthenticatedLayout>
</template>
