<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { usePage, router, Head } from '@inertiajs/vue3'
import Show from '@/Pages/Forms/UserForms/Show.vue'
import Edit from '@/Pages/Forms/UserForms/Edit.vue'
import Create from '@/Pages/Forms/UserForms/Create.vue'
import UserTable from '@/Tables/UserTable.vue'
import FlashMessage from '@/Components/FlashMessage.vue'
import Modal from '@/Components/Modal.vue'
import ButtonColor from '@/Components/ButtonColor.vue'


const props = defineProps({
    users: { type: Object, required: true },
    usersTrashed: { type: Object },
    roles: { type: Object },
})

const page = usePage()

const modalCreate = ref(false)
const modalShow = ref(false)
const userShow = ref('')
const modalEdit = ref(false)
const userEdit = ref('')
const modalView = ref(false)
const typeModalView = ref('')
const idModalView = ref('')
const isMessage = ref(false)

const openCreate = () => { modalCreate.value = !modalCreate.value }
const openShow = (user) => {
    modalShow.value = !modalShow.value
    userShow.value = user
}
const openEdit = (user) => {
    userEdit.value = user
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
////////  fuction modals ///////////
const deleteStore = (id) => {
    router.delete(route('adminUser.delete', [id]), {}, {})
    modalView.value = false
    typeModalView.value = ''
    idModalView.value = ''  
}

const forceDelete = (id) => {
    router.delete(route('adminUser.forceDestroy', [id]), {}, {})
    modalView.value = false
    typeModalView.value = ''
    idModalView.value = ''   
}
const restore = (id) => {
    router.patch(route('adminUser.restore', [id]), {}, {})
    modalView.value = false
    typeModalView.value = ''
    idModalView.value = '' 
}

const closeMessage = () => { 
    isMessage.value = false
    page.props.flash.message = null
    page.props.flash.color = null
}

watch(() => page.props.flash.message, (newValue) => {
  if (newValue) {
    isMessage.value = true;
  }
}, { immediate: true })

</script>
<template>
    <Head title="Admin-User" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Admin-User') }}</h2>
        </template>
        <div class="w-full m-3">
            <!-- FLASH MESSAGE -->
            <FlashMessage v-if="isMessage" :message=$page.props.flash.message :color="$page.props.flash.color" @closeMessage="closeMessage"  />
           
            <!-- CREATE BUTTON -->
            <div class="m-5">
                <ButtonColor text="white" bg="green" v-if="page.props.auth.user.permissions.includes('create_user')" @click="openCreate()" >{{ $t('Create New User') }}</ButtonColor>
            </div>
           
            <!-- MODAL CREATE -->
            <Create v-if="modalCreate" @closeCreate="openCreate" :roles="props.roles" />
            <!-- MODAL SHOW -->
            <Show v-if="modalShow" :user="userShow" @closeShow="openShow" />
            <!-- MODAL EDIT -->
            <Edit v-if="modalEdit" :user="userEdit" :roles="props.roles" @closeEdit="openEdit" />

            <!-- MODAL MESSAGE -->
            <Modal :show="modalView" maxWidth="lg" @close="openModalView" >
                <p class="my-5 mx-auto text-xl dark:text-white font-semibold mb-4">{{ $t('Are you sure to '+typeModalView+' this user?') }}</p>
                <div class="flex justify-center my-5">
                    <ButtonColor text="white" bg="gray" @click="openModalView" class="mr-10">{{ $t('Cancel') }}</ButtonColor>
                    <ButtonColor text="white" bg="red"  @click=callFunction(idModalView)>{{ $t(typeModalView) }}</ButtonColor>
                </div>
            </Modal>
        </div>
        <UserTable :users="props.users" searchName="user" v-slot="{user}" >
            <ButtonColor text="white" bg="yellow" class="mx-2" @click="openShow(user)" >{{ $t('Show') }}</ButtonColor>
            <ButtonColor text="white" bg="cyan" class="mx-2" v-if="page.props.auth.user.permissions.includes('update_user')"  @click="openEdit(user)" >{{ $t('Edit') }}</ButtonColor>
            <ButtonColor text="white" bg="red" class="mx-2" v-if="page.props.auth.user.permissions.includes('delete_user')"  @click="openModalView(user.id, 'Delete')" >{{ $t('Delete') }}</ButtonColor>
        </UserTable>

        <UserTable :users="props.usersTrashed" searchName="userTrashed" v-slot="{user}" > >
            <ButtonColor text="white" bg="gray" class="mx-2" v-if="page.props.auth.user.permissions.includes('restore_user')"  @click="openModalView(user.id, 'Restore')" >{{ $t('Restore') }}</ButtonColor>
            <ButtonColor text="white" bg="red" class="mx-2" v-if="page.props.auth.user.permissions.includes('forceDelete_user')"  @click="openModalView(user.id, 'Force Delete')" >{{ $t('Force Delete') }}</ButtonColor>
        </UserTable>     

    </AuthenticatedLayout>
</template>