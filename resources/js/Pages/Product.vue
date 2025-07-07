<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Link, usePage, router, Head } from '@inertiajs/vue3'
import Show from '@/Pages/Forms/ProductForms/Show.vue'
import Create from '@/Pages/Forms/ProductForms/Create.vue'
import Edit from '@/Pages/Forms/ProductForms/Edit.vue'
import ProductTable from '@/Tables/ProductTable.vue'
import FlashMessage from '@/Components/FlashMessage.vue'
import Modal from '@/Components/Modal.vue'
import ButtonColor from '@/Components/ButtonColor.vue'

const props = defineProps({
    products: { type: Object, required: true },
    productsTrashed: { type: Object },
})
const page = usePage()

const modalShow = ref(false)
const modalCreate = ref(false)
const modalEdit = ref(false)
const modalView = ref(false)
const productShow = ref('')
const isMessage = ref(false)

const openCreate = () => { modalCreate.value = !modalCreate.value }

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
                <ButtonColor text="white" bg="green" v-if="page.props.auth.user.permissions.includes('create_product')" @click="openCreate()" class="mb-5"  >{{ $t('Create New Product') }}</ButtonColor>
            </div>

            <!-- MODAL CREATE -->
            <Create v-if="modalCreate" :roles="props.roles" @closeCreate="openCreate" />
            <!-- MODAL SHOW -->
            <Show v-if="modalShow" :product="productShow" @closeShow="closeShow" />
            <!-- MODAL EDIT -->
            <Edit v-if="modalEdit" :product="productEdit" :roles="props.roles" @closeEdit="closeEdit" />

            <!-- MODAL MESSAGE -->
            <Modal :show="modalView" maxWidth="lg" @close="modalIsView" >
                <p class="my-5 mx-auto text-xl dark:text-white font-semibold mb-4">{{ $t('Are you sure to '+typeModalView+' this user?') }}</p>
                <div class="flex justify-center my-5">
                    <ButtonColor text="white" bg="gray" @click="modalIsView" class="mr-10">{{ $t('Cancel') }}</ButtonColor>
                    <ButtonColor text="white" bg="red"  @click=callFunction(idModalView)>{{ $t(typeModalView) }}</ButtonColor>
                </div>
            </Modal>

        </div>
        <!-- Product Table -->
        <ProductTable  :products="products" searchName="product" v-slot="{product}">
            <ButtonColor text="white" bg="yellow" type="button" @click="openShow(product)" class="mx-3" >{{ $t('Show') }}</ButtonColor>
            <ButtonColor text="white" bg="cyan" v-if="page.props.auth.user.permissions.includes('update_product')" type="button" @click="editStore(product.id)" class="mx-4" >{{ $t('Edit') }}</ButtonColor>
            <ButtonColor text="white" bg="red" v-if="page.props.auth.user.permissions.includes('delete_product')" type="button" @click="deleteStore(product.id)" class="mx-3" >{{ $t('Delete') }}</ButtonColor>
        </ProductTable>
        <!-- Product Trashed Table -->
        <ProductTable :products="productsTrashed" searchName="productTrashed" v-slot="{product}" >
            <ButtonColor text="white" bg="gray" v-if="page.props.auth.user.permissions.includes('restore_product')" type="button" @click="restore(product.id)" class="mx-4" >{{ $t('Restore') }}</ButtonColor>
            <ButtonColor text="white" bg="red" v-if="page.props.auth.user.permissions.includes('forceDelete_product')" type="button" @click="forceDelete(product.id)" class="mx-3" >{{ $t('Force Delete') }}</ButtonColor>
        </ProductTable>

    </AuthenticatedLayout>
</template>
