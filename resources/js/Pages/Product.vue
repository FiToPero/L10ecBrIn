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
const productEdit = ref('')
const typeModalView = ref('')
const idModalView = ref('')
const isMessage = ref(false)

const openCreate = () => { modalCreate.value = !modalCreate.value }
const openShow = (product) => {
    productShow.value = product
    modalShow.value = !modalShow.value
}
const openEdit = (product) => {
    productEdit.value = product
    modalEdit.value = !modalEdit.value
}
const openModalView = (id, type) => { 
    typeModalView.value = type
    idModalView.value = id
    modalView.value = !modalView.value
}

///////////// Select function to call /////////////
const callFunction = (id) => {
    if (typeModalView.value === 'Delete') {
        deleteStore(id)
    } else if (typeModalView.value === 'Force Delete') {
        forceDelete(id)
    } else if (typeModalView.value === 'Restore') {
        restore(id)
    }
}

////////// fuction modals ///////////
const deleteStore = (id) => {
    router.delete(route('product.delete', [id]), {}, {})  
    modalView.value = false
    typeModalView.value = ''
    idModalView.value = ''   
}
const forceDelete = (id) => {
    router.delete(route('product.forceDestroy', [id]), {}, {})   
    modalView.value = false
    typeModalView.value = ''
    idModalView.value = ''  
}
const restore = (id) => {
    router.patch(route('product.restore', [id]), {}, {})
    modalView.value = false
    typeModalView.value = ''
    idModalView.value = ''  
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
            <Show v-if="modalShow" :product="productShow" @closeShow="openShow" />
            <!-- MODAL EDIT -->
            <Edit v-if="modalEdit" :product="productEdit" :roles="props.roles" @closeEdit="openEdit" />

            <!-- MODAL MESSAGE -->
            <Modal :show="modalView" maxWidth="lg" @close="openModalView" >
                <p class="my-5 mx-auto text-xl dark:text-white font-semibold mb-4">{{ $t('Are you sure to '+typeModalView+' this user?') }}</p>
                <div class="flex justify-center my-5 bg-y ">
                    <ButtonColor text="white" bg="gray" @click="openModalView" class="mr-10">{{ $t('Cancel') }}</ButtonColor>
                    <ButtonColor text="white" bg="red"  @click=callFunction(idModalView)>{{ $t(typeModalView) }}</ButtonColor>
                </div>
            </Modal>

        </div>
        <!-- Product Table -->
        <ProductTable  :products="products" searchName="product" v-slot="{product}">
            <ButtonColor text="white" bg="yellow" @click="openShow(product)" class="mx-3" >{{ $t('Show') }}</ButtonColor>
            <ButtonColor text="white" bg="cyan" v-if="page.props.auth.user.permissions.includes('update_product')" @click="openEdit(product)" class="mx-4" >{{ $t('Edit') }}</ButtonColor>
            <ButtonColor text="white" bg="red" v-if="page.props.auth.user.permissions.includes('delete_product')"  @click="openModalView(product.id, 'Delete')" class="mx-3" >{{ $t('Delete') }}</ButtonColor>
        </ProductTable>
        <!-- Product Trashed Table -->
        <ProductTable :products="productsTrashed" searchName="productTrashed" v-slot="{product}" >
            <ButtonColor text="white" bg="gray" v-if="page.props.auth.user.permissions.includes('restore_product')" @click="openModalView(product.id, 'Restore')" class="mx-4" >{{ $t('Restore') }}</ButtonColor>
            <ButtonColor text="white" bg="red" v-if="page.props.auth.user.permissions.includes('forceDelete_product')" @click="openModalView(product.id, 'Force Delete')" class="mx-3" >{{ $t('Force Delete') }}</ButtonColor>
        </ProductTable>

    </AuthenticatedLayout>
</template>
