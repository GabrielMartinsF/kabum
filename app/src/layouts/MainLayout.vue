<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn flat dense :icon="logged ? 'logout':'login'" />
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { ref } from 'vue';



defineOptions({

  name: 'MainLayout',

  data: () => ({
    logged: ref(false)
  }),
  methods: {
    login() {
      if(this.logged) {
        this.logged = !this.logged
      }
    }
  },
  created() {
    if(localStorage.getItem("token")){
      this.logged = true
    }    
  }
})

</script>
