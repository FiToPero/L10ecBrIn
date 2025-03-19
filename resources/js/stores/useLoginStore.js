import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useLoginStore = defineStore('useLoginStore', () => {
  const modalLogin = ref(false)
  const modalRegister = ref(false)
  const modalVerified = ref(false)
  const storedLocale = localStorage.getItem('localeLang') || ''
  const localeLang = ref(storedLocale)

  function showModalLogin(){ modalLogin.value = !modalLogin.value }
  function showModalRegister(){ modalRegister.value = !modalRegister.value }
  function showModalVerified(){ modalVerified.value = !modalVerified.value }
  function changeLocale(lang){  
      localeLang.value = lang, 
      localStorage.setItem('localeLang', lang)
      window.location.reload() }
      
  //const isModalLogin = computed(() => modalLogin.value)
 

  return { modalLogin, modalRegister, modalVerified, localeLang, showModalLogin, showModalRegister, showModalVerified, changeLocale }
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