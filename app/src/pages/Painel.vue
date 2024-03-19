<template>
    <q-page>

      <DialogClient ref="dialogClient"/>
      <DialogEditClient ref="dialogEditClient"/>
      <DialogAddress ref="dialogAddress"/>
      <DialogEditAddress ref="dialogEditAddress"/>

      <div class="painel">
        <div class="row items-center card-item justify-center">

          <q-card class="my-card" square>
            <div class="q-pa-md q-pt-xl col card-login column items-center justify-center">
              <div class="logo"></div>
              <div  class="full-width">
                <div class="q-pa-md full-width justify-center row">
                  <q-btn outline color="orange" label="Novo Cliente" @click="openDialogClient()"/>
                </div>
                <q-card class="background q-mb-lg q-pa-md" v-for="(clients, clientsIndex) in clientes" :key="clientsIndex">
                  <div class="card-client row col-8 items-center">
                    <div class="col column items-center">
                      <span class="header">Nome</span>
                      <span class="info">
                        {{ clients.nome }}
                      </span>
                    </div>
                    <div class="col column items-center">
                      <span class="header">CPF</span>
                      <span class="info">
                        {{ clients.cpf }}
                      </span>
                    </div>
                    <div class="col column items-center">
                      <span class="header">RG</span>
                      <span class="info">
                        {{ clients.rg }}
                      </span>
                    </div>
                    <div class="col column items-center">
                      <span class="header">Data de nascimento</span>
                      <span class="info">
                        {{ clients.data_nascimento }}
                      </span>
                    </div>
                    <div class="col column items-center">
                      <span class="header">Telefone</span>
                      <span class="info">
                        {{ clients.telefone }}
                      </span>
                    </div>
                    <div>
                      <span class="col q-pa-md" @click="openDialogEditClient(clients)">
                        <q-btn flat round color="orange" icon="edit" />
                      </span>
                    </div>
                    <div>
                      <span class="col q-pa-md" @click="deletarClient(clients.id_cliente)">
                        <q-btn flat round color="orange" icon="delete" />
                      </span>
                    </div>
                  </div>
                  <div class="address">
                    <div class="address-show row q-col-gutter-md">
                      <div class="card-address q-ma-md q-pa-md col-2" v-for="(address, addressIndex) in clients.enderecos" :key="addressIndex">
                        <div class="col items-start">
                          <div class="row">
                            <span style="color: aliceblue;">{{ address.logradouro }}</span>
                          </div>
                          <div class="row">
                            <span style="color: aliceblue;">{{ `Numero: ${address.logradouro_numero}` }}</span> <span v-if="address.logradouro_complemento">{{ `, ${address.logradouro_complemento}` }}</span>
                          </div>
                          <div class="row">
                            <span style="color: aliceblue;">{{ `CEP ${address.logradouro_cep} - ${address.logradouro_cidade}, ${address.logradouro_estado}` }}</span>
                          </div>
                          <div class="row">
                            <q-btn class="full-width col" square flat color="white" icon="edit" @click="openDialogEditAddress(address)"/>
                            <q-btn class="full-width col" square flat color="white" icon="delete" @click="deleteAddress(address.id_endereco)" v-if="clients.enderecos.length > 1"/>
                          </div>
                        </div>
                      </div>
                      <div class="address-add column justify-center q-ma-md q-pa-md">
                        <q-btn color="orange" icon="add" label="Novo Endereço" @click="openDialogAddress(clients)"/>
                      </div>
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
import { defineComponent } from "vue";
import DialogClient from "src/components/DialogClient.vue";
import DialogAddress from "src/components/DialogAddress.vue";
import DialogEditAddress from "src/components/DialogEditAddress.vue";
import DialogEditClient from "src/components/DialogEditClient.vue";
import { geral } from "src/mixins";

export default defineComponent({
  mixins: [geral],
  name: "Painel",
  components: {
    DialogClient,
    DialogAddress,
    DialogEditAddress,
    DialogEditClient
  },
  data: () => ({
             
  }),
  created() {
    this.fetchClientes()
  },
  computed: {

  },
  methods: {
    
  },
  
});
</script>
<style scoped>
.painel{
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
  width: 100%;
  min-height: 100%;
}
.card-login span{
  font-weight: bold;
  color: #fff;
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


/* endereços */
.card-address {
  background-color: #f17a28;
  font-size: 15px;
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
