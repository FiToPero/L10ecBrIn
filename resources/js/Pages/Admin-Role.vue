<script setup>
import { ref, watch } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { usePage, Head, router } from '@inertiajs/vue3'
import FlashMessage from '@/Components/FlashMessage.vue'
import ButtonColor from '@/Components/ButtonColor.vue'
import Badge from '@/Components/Badge.vue'
import Create from '@/Pages/Forms/RolesForms/Create.vue'
import Modal from '@/Components/Modal.vue'

const props = defineProps({
    roles: { type: Array, required: true },
    permissions: { type: Array, required: true },
})
const page = usePage()

const rolesOriginal = props.roles
const rolesTemp = ref(JSON.parse(JSON.stringify(props.roles)))
const isMessage = ref(false)
const modalCreate = ref(false)
const modalView = ref(false)
const viewSave = ref([])
const addPermission = ref('')
let responseSave = ''

const openCreate = () => { modalCreate.value = !modalCreate.value }

//////// Functions  Permission ///////////
const removePermission = (perId, roleId, index) => {  
    rolesTemp.value = rolesTemp.value.map(role => {
        if (role.id === roleId) {
            role.permissions = role.permissions.filter(p => p.id !== perId)
        }
        return role
    })
    markAsModified(index, false)
}
watch(addPermission, (newValue) => {
    rolesTemp.value = rolesTemp.value.map(role => {
        if (role.id === newValue.roleId) {
            const exists = role.permissions.some(p => Number(p.id) === Number(newValue.id))
            if (!exists) {
                role.permissions.push({id: newValue.id, name: newValue.name})
            }
        }
        return role
    })
    markAsModified(newValue.index, false)
    addPermission.value = ''
})
//////////////////////////////////////////////

const markAsModified = (index, remove) => {
    if (remove) {
        viewSave.value = viewSave.value.filter(i => i !== index)
    }else{
        if (!viewSave.value.includes(index)) {
            viewSave.value.push(index)
        }
    }
}

//////////////// Save Role /////////////////
const openModalView = (role, index) => { 
    modalView.value = !modalView.value
    responseSave =  JSON.parse(JSON.stringify(role))
    cancelUpdate(index, role.id)
}

const saveRole = (save) => {
    router.post(route('adminRole.update'), save)
    modalView.value = false
    responseSave = ''
}
//////////////////////////////////////
const cancelUpdate = (index, roleId) => {    
    rolesTemp.value = rolesTemp.value.map(role => {
        if (role.id === roleId) {
            Object.assign(role, JSON.parse(JSON.stringify(rolesOriginal.find(roleOriginal => roleOriginal.id === roleId))))
        }
        return role
    })
    markAsModified(index, true)
}

///////  Mesage Flash ///////
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
<Head title="Admin-Root" />
<AuthenticatedLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $t('Admin-Root') }}</h2>
    </template>
    <div class="w-full  p-3">

        <FlashMessage v-if="isMessage" :message=$page.props.flash.message :color="$page.props.flash.color" @closeMessage="closeMessage"  />

        <!-- CREATE BUTTON -->
        <div class="my-5">
            <ButtonColor text="white" bg="green" v-if="page.props.auth.user.permissions.includes('create_role')" @click="openCreate()" class="px-10 py-4" >{{ $t('Create New Role') }}</ButtonColor>
        </div>
        <!-- MODAL CREATE -->
        <Create v-if="modalCreate" @closeCreate="openCreate" :permissions="props.permissions" />
        <!--   MODAL MESSAGE -->
        <Modal :show="modalView" maxWidth="lg" @close="openModalView" >
            <p class="my-5 mx-auto text-xl dark:text-white font-semibold mb-4">{{ $t('Are you sure to Update this Role?') }}</p>
            <div class="flex justify-center my-5">
                <ButtonColor text="white" bg="gray" @click="openModalView" class="mr-10">{{ $t('Cancel') }}</ButtonColor>
                <ButtonColor text="white" bg="cyan"  @click=saveRole(responseSave)>{{ $t('Update Role') }}</ButtonColor>
            </div>
        </Modal>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="shadow-md sm:rounded-lg">
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
                            <th scope="col" class="px-6 py-3">
                                {{ $t('Save') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(role, index) in rolesTemp" :key="'roles'+index">
                            <tr class=" bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="p-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p class="dark:text-white">{{ role.id }}</p>
                                </th>
                                <td class="p-2 font-medium text-gray-900 whitespace-nowrap">
                                    <p class="dark:text-white">{{ role.name }}</p>
                                </td>
                                <td class="p-2 m-10 font-medium text-gray-900 whitespace-nowrap">
                                    <label class='block m-2 text-sm text-gray-900 dark:text-white font-bold'>{{ $t('Select Permission') }}</label>
                                    <select v-model="addPermission" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                         <option value="">{{ $t('Select...') }}</option>
                                        <template v-for="permission in permissions" :key="'select'+role.id">
                                            <option v-if="!role.permissions.some(p => p.id === permission.id)" :value="{id: permission.id, name: permission.name, index, roleId: role.id}" >{{ permission.name }} </option>
                                        </template>
                                    </select>   
                                </td>
                                <td id="badge" class="  flex flex-wrap gap-1 p-2 font-medium text-gray-900 whitespace-nowrap">
                                    <template v-for="permission in role.permissions" :key="'permissions'+permission.id">
                                        <Badge :text="permission.name" :perId="permission.id" :roleId="role.id" :index="index" @remove="removePermission" />
                                    </template>
                                </td>
                                <td class="p-5 font-medium" >
                                    <div class="flex justify-center gap-2">
                                    <ButtonColor text="white" bg="green" v-if="page.props.auth.user.permissions.includes('update_role') && viewSave.some(item => item === index)" @click="openModalView(role, index)"  >{{ $t('Save') }}</ButtonColor>
                                    <ButtonColor text="white" bg="red" v-if="page.props.auth.user.permissions.includes('update_role') && viewSave.some(item => item === index)" @click="cancelUpdate(index, role.id)"  >{{ $t('Cancel') }}</ButtonColor>
                                    </div>
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
