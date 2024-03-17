<template>
    <q-page>
      <div class="home">
        
        <div class="row items-center card-item justify-center">

          <q-card class="my-card" bordered>
            <div class="q-pa-md col card-login column items-center justify-center">
              <div class="logo"></div>
              <span class="madimi q-pb-md">Login</span>
              <q-form
                @submit="onSubmit"
                @reset="onReset"
                class="q-gutter-md full-width"
              >
                <q-input
                  class="full-width"
                  label-color="white"
                  filled
                  dark
                  v-model="login"
                  label="Login"
                  lazy-rules
                  :rules="[ val => !!val || 'Insira seu login']"
                />

                <q-input 
                  class="full-width"
                  v-model="password" 
                  filled 
                  label-color="white"
                  dark
                  label="Senha"
                  :type="isPwd ? 'password' : 'text'"
                  :rules="[ val => !!val || 'Insira sua senha']"
                >
                  <template v-slot:append>
                    <q-icon
                      :name="isPwd ? 'visibility_off' : 'visibility'"
                      class="cursor-pointer"
                      @click="isPwd = !isPwd"
                    />
                  </template>
                </q-input>

              </q-form>
              <div class="singup row full-width">
                <q-btn unelevated color="orange" label="Cadastro" class="full-width"/>
              </div>
              <div class="bottom-card">
                <q-btn flat text-color="white" label="Login" class="full-width login" @click="getAll()"/>
              </div>
            </div>
          </q-card>

        </div>
      </div>
    </q-page>
</template>

<script>
import ClientService from 'src/services/ClientService';
import { ref } from 'vue'

export default {
  name: 'Login',
  mixins: [],
  components: {

  },
  data () {
    return {
      login: ref(''),
      password: ref(''),
      isPwd: ref(true),
    }
  },
  created () {
    
  },
  computed: {
    
  },
  methods: {
    getAll() {
      ClientService.fetch()
    }
  },
  watch: {

  }
}
</script>
<style scoped>
.home{
  height: 100vh;
  background: linear-gradient(45deg, #ffd000, #f8c45c, #faa52f, #ff7b00);
  background-size: 200% 200%;
  animation: colors 15s both infinite;
}
.card-item{
  height: 100%;
  width: 100%;
}
.card-login{
  background-color: #0060b1;
  height: 100%;
  width: 100%;
}
.card-login span{
  font-weight: bold;
  color: #fff;
  font-size: 36px;
}
.my-card{
  height: 60%;
  width: 20%;
}
.login{
  background-color: #f17a28;
  border-radius: 50% 50% 0 0;
}
.bottom-card{
  width: 100%;
  height: 20px;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
}
@keyframes colors {
  0%{
    background-position: 0% 50%;
  }

  50%{
    background-position: 100% 50%;
  }

  100%{
    background-position: 0% 50%;
  }
}
</style>
