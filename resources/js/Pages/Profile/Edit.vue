<script setup>
import Edit from '@/Pages/Forms/UserForms/Edit.vue'
import { useLoginStore } from '../../stores/useLoginStore'

const userStore = useLoginStore()
const { showModalProfileEdit } = userStore

const props = defineProps({
    props: { type: Object, required: true },
})

const closeEdit = () => {
    showModalProfileEdit()
}

</script>

<template>

    <!-- <FlashMessage v-if="isMessage" :message=$page.props.flash.message :color="$page.props.flash.color" @closeMessage="closeMessage"  /> -->

    <Edit :user="props.props.auth.user" :roles="null" :errors="props.props.errors" @closeEdit="closeEdit()" />

</template>
