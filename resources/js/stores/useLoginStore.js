import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useLoginStore = defineStore('useLoginStore', () => {
  const modalLogin = ref(false)
  const modalRegister = ref(false)
  const modalVerified = ref(false)

  function showModalLogin(){ modalLogin.value = !modalLogin.value }
  function showModalRegister(){ modalRegister.value = !modalRegister.value }
  function showModalVerified(){ modalVerified.value = !modalVerified.value }
  
  //const isModalLogin = computed(() => modalLogin.value)

  return { modalLogin, modalRegister, modalVerified, showModalLogin, showModalRegister, showModalVerified }
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