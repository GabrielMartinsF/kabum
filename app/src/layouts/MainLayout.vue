<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn flat dense :icon="this.loggedIn ? 'login' : 'logout'" @click="doLogout()"/>
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { ref } from 'vue';
import { mapGetters, mapActions } from 'vuex';

defineOptions({

  name: 'MainLayout',

  data: () => ({
    logged: ref(false)
  }),
  computed: {
    ...mapGetters('auth', ["loggedIn"]),
  },
  methods: {
    ...mapActions('auth', ["logout"]),
    async doLogout() {
      if(this.loggedIn){
        await this.logout()
        this.$router.push("/")
      } else {
        this.$router.push("/")
      }
      
    }
  },
  created() {

  }
})

</script>
