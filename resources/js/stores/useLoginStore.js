import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useLoginStore = defineStore('useLoginStore', () => {
  const modalLogin = ref(false)
  const modalRegister = ref(false)
  const modalVerified = ref(false)
  const modalForgotPassword = ref(false)
  const modalResetPassword = ref(false)
  const modalProfileEdit = ref(false)
  const storedLocale = localStorage.getItem('localeLang') || ''
  const localeLang = ref(storedLocale)

  function showModalLogin(){ modalLogin.value = !modalLogin.value }
  function showModalRegister(){ modalRegister.value = !modalRegister.value }
  function showModalVerified(){ modalVerified.value = !modalVerified.value }
  function showModalForgotPassword(){ modalForgotPassword.value = !modalForgotPassword.value }
  function showModalResetPassword(){ modalResetPassword.value = !modalResetPassword.value }
  function showModalProfileEdit(){ modalProfileEdit.value = !modalProfileEdit.value }

  function changeLocale(lang){  
      localeLang.value = lang, 
      localStorage.setItem('localeLang', lang)
      window.location.reload() }
      
  //const isModalLogin = computed(() => modalLogin.value)
 

  return { 
    modalLogin, modalRegister, modalVerified, modalForgotPassword, modalResetPassword, modalProfileEdit, localeLang,
    showModalLogin, showModalRegister, showModalVerified, showModalForgotPassword, showModalResetPassword, showModalProfileEdit, changeLocale
  }


})










/* 
  state: () => ({
    openStatePinia: "state Pinia"
  }),
  getters: {    
    useComputer: (state) => {    },
  },
  actions: {
    useAction(){  },
  },
*/