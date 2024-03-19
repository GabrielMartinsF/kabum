<template>
    <q-page>
      <div class="home">
        
        <div class="row items-center card-item justify-center">

          <q-card class="my-card" bordered>
            <div class="q-pa-md col card-login column items-center justify-center">
              <div class="logo"></div>
              <span class="madimi q-pb-md">Entrar</span>
              <q-form
                @submit="handleLogin"
                ref="loginForm"
                class="q-gutter-md full-width"
              >
                <q-input
                  class="full-width"
                  label-color="white"
                  filled
                  dark
                  v-model="credencial.login"
                  label="Login"
                  lazy-rules
                  :rules="[ val => !!val || 'Insira seu login']"
                />

                <q-input 
                  class="full-width"
                  v-model="credencial.senha" 
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
                <q-btn unelevated color="orange" label="Cadastro" class="full-width" to="/signup"/>
              </div>
              <div class="bottom-card">
                <q-btn flat text-color="white" label="Login" class="full-width login" @click="handleLogin" :loading="loading.login = !loading.login"/>
              </div>
            </div>
          </q-card>

        </div>
      </div>
    </q-page>
</template>

<script>
import { defineComponent } from "vue";
import { geral } from "src/mixins";
import { mapActions } from "vuex";
import Notifier from "src/services/NotifyService"

export default defineComponent({
  mixins: [geral],
  name: "Login",
  data: () => ({
      credencial: {
        login: '',
        senha: ''
      },
      isPwd: true
  }),
  methods: {
    ...mapActions('auth', ["goLogin"]),

    async handleLogin () {
      const success = await this.$refs['loginForm'].validate()
      if (!success)
        return

      await this.goLogin(this.credencial)
        .then((response) => {
            console.log("teste")
            this.$router.push("/painel")
        })
        .catch((e) => {
          console.error(e)
          if (e.response && e.response.status === 401) {
            Notifier.error("Usuário não autorizado!");
          } else if (!e.response) {
            Notifier.error("Ocorreu um erro sistêmico interno, favor entrar em contato!");
          } else {
            Notifier.error("Usuário ou Senha inválidos!");
          }
        });
    },
  },
  mounted() {
    
  },
});
</script>
<style scoped>
.home{
  height: auto;
  width: 100%;
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
