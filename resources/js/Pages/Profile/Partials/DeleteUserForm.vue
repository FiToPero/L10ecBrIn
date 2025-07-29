<script setup>
import ButtonColor from '@/Components/ButtonColor.vue'
import InputFull from '@/Components/InputFull.vue'
import Modal from '@/Components/Modal.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { nextTick, ref } from 'vue'

const confirmingUserDeletion = ref(false)
const passwordInput = ref(null);

const page = usePage()
const form = useForm({
    password_destroy: '',
})

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true
}

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    })
}

const closeModal = () => {
    confirmingUserDeletion.value = false
    form.reset()
}
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $t('Delete Account') }}</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ $t('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </header>

        <ButtonColor text="white" bg="red" @click="confirmUserDeletion">{{ $t('Delete Account') }}</ButtonColor>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ $t('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ $t('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <form @submit.prevent="deleteUser" class="mt-6">
                    <InputFull
                        v-model:model="form.password_destroy"
                        v-model:errors="page.props.errors.password_destroy"
                        :label="$t('Password')"
                        :type="'password'"
                        :id="'password_destroy'"
                        ref="password_destroy"
                        @keyup.enter="deleteUser"
                    />

                    <div class="mt-6 flex justify-end gap-5">
                        <ButtonColor text="white" bg="gray" @click="closeModal"> {{ $t('Cancel') }} </ButtonColor>

                        <ButtonColor text="white" bg="red" :disabled="form.processing" @click="deleteUser"> {{ $t('Delete Account') }} </ButtonColor>
                    </div>
                </form>
     

             
            </div>
        </Modal>
    </section>
</template>
