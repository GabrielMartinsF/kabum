<template>
    <q-page>
      <div class="painel">
        
        <div class="row items-center card-item justify-center">

          <q-card class="my-card" square>
            <div class="q-pa-md q-pt-xl col card-login column items-center justify-center">
              <div class="logo"></div>
              <div  class="full-width">
                <q-card class="background q-mb-lg q-pa-md" v-for="(clients, clientsIndex) in clientes" :key="clientsIndex">
                  <div class="card-client row col-8">
                    <div class="col column items-center">
                      <span class="header">Nome</span>
                      <span class="info">
                        {{ clients.nome }}
                      </span>
                    </div>
                    <div class="col column items-center">
                      <span class="header">CPF</span>
                      <span class="info">
                        {{ formatDocument(clients.cpf) }}
                      </span>
                    </div>
                    <div class="col column items-center">
                      <span class="header">RG</span>
                      <span class="info">
                        {{ formatRg(clients.rg) }}
                      </span>
                    </div>
                    <div class="col column items-center">
                      <span class="header">Data de nascimento</span>
                      <span class="info">
                        {{ formatDate(clients.data_nascimento) }}
                      </span>
                    </div>
                    <div class="col column items-center">
                      <span class="header">Telefone</span>
                      <span class="info">
                        {{ formatPhone(clients.telefone) }}
                      </span>
                    </div>
                    <div>
                      <span class="col q-pa-md" @click="edit(clients.id_cliente)">
                        <q-btn flat round color="orange" icon="edit" />
                      </span>
                    </div>
                    <div>
                      <span class="col q-pa-md" @click="deletar(clients.id_cliente)">
                        <q-btn flat round color="orange" icon="delete" />
                      </span>
                    </div>
                  </div>
                </q-card>
              </div>
            </div>
          </q-card>

        </div>
      </div>
    </q-page>
</template>

<script>
import { date } from "quasar";
import { defineComponent } from "vue";
import { ref } from "vue";
import ClientService from "src/services/ClientService";

export default defineComponent({
  data: () => ({
    clientes: ref(null),            
  }),
  created() {
    this.buscar()
  },
  computed: {

  },
  methods: {
    async buscar() {
      let client = await ClientService.fetch()
      if (client.status == 200) {
        this.clientes = client.data.data
      }
    },
    async deletar(id) {
      let del = await ClientService.deletar(id)
      if(del.status == 200){
        console.log(del)
        this.buscar()
      }
    },
    formatDate(data) {
      const extracted = date.extractDate(data, 'YYYY-MM-DD')
      return date.formatDate(extracted, "DD/MM/YYYY")
    },
    formatDocument(data) {
      return data.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    },
    formatRg(data) {
      data=data.replace(/\D/g,"");
      data=data.replace(/(\d{2})(\d{3})(\d{3})(\d{1})$/,"$1.$2.$3-$4");
      return data;
    },
    formatPhone(data) {
      data = data.replace(/\D/g,'')
      data = data.replace(/(\d{2})(\d)/,"($1) $2")
      return data = data.replace(/(\d)(\d{4})$/,"$1-$2")
    }
  },
  
});
</script>
<style scoped>
.painel{
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
  
  width: 100%;
  min-height: 100%;
}
.card-login span{
  font-weight: bold;
  color: #fff;
  font-size: 36px;
}
.my-card{
  height: 80%;
  width: 100%;
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
.background{
  background-color: #fff;
  height: 100%;
  width: 100%;
}
.card-client span{
  color: #f17a28;
}
.header{
  font-size: 14px !important;
}
.info{
  font-size: 24px !important;
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
