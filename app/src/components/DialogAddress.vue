<template>
    <q-dialog
      ref="addressDialog"
      style="backdrop-filter: blur(4px) "
    >
        <q-card class="full-width">
            <q-card-section class="row items-center">
                <div class="text-h6">Cadastro Endereço</div>
            </q-card-section>

            <q-card-section class="q-pt-none full-width">
                <div class="q-pa-sm full-width">
                    <q-form
                        @submit="addClient(payloadAddress)"
                        class="row full-width"
                        ref="clientForm"
                    >
                        <div class="row full-width">
                            <div class="row full-width">
                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width" @change="loadCepHandler(payloadAddress.logradouro_cep)"
                                    filled v-model="payloadAddress.logradouro_cep" label="CEP *" mask="#####-###"
                                    lazy-rules :rules="[ val => val && val.length > 0 || 'Campo obrigatório']"
                                />

                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                    filled v-model="payloadAddress.logradouro" label="Logradouro *" 
                                    lazy-rules :rules="[ val => val && val.length > 0 || 'Campo obrigatório']"
                                />

                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                    filled v-model="payloadAddress.logradouro_numero" label="Numero *" 
                                    lazy-rules :rules="[ val => val && val.length > 0 || 'Campo obrigatório']"
                                />
                            </div> 
                            <div class="row full-width">
                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                    filled v-model="payloadAddress.logradouro_complemento" label="Complemento"
                                />

                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                    filled v-model="payloadAddress.logradouro_bairro" label="Bairro *" 
                                    lazy-rules :rules="[ val => val && val.length > 0 || 'Campo obrigatório']"
                                />

                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                    filled v-model="payloadAddress.logradouro_cidade" label="Cidade *" 
                                    lazy-rules :rules="[ val => val && val.length > 0 || 'Campo obrigatório']"
                                />     

                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                    filled v-model="payloadAddress.logradouro_estado" label="Estado *" 
                                    lazy-rules :rules="[ val => val && val.length > 0 || 'Campo obrigatório']"
                                />
                            </div>
                        </div>
                    </q-form>

                    </div>
            </q-card-section>

            <q-card-actions align="center">
                <q-btn flat label="Cancelar" color="primary" v-close-popup />
                <q-btn flat label="Confirmar" color="primary" @click="addAddress(payloadAddress)" :loading="loading.confirmar" />
            </q-card-actions>
        </q-card>
    </q-dialog>
  </template>
  
  <script>
import { geral } from 'src/mixins';
import { ref } from 'vue';
import { loadCep } from 'src/utils';
import NotifyService from 'src/services/NotifyService';
import AddressService from 'src/services/AddressService';
  
export default {
    name: 'DialogClient',
    mixins: [geral],
    data () {
      return {
        clienteAddress: ref(''),
        payloadAddress: {
            logradouro : '', 
            logradouro_numero : '', 
            logradouro_complemento : '', 
            logradouro_bairro : '', 
            logradouro_cep : '', 
            logradouro_cidade : '', 
            logradouro_estado : '', 
            id_cliente : ''
        }
      }
    },
    methods: {
        show (value) {
            if(value) {
                this.payloadAddress.id_cliente = value.id_cliente
                console.log(this.clienteAddress)
            }
            
            this.$refs.addressDialog.show();
        },
        hide () {
            this.$refs.addressDialog.hide();
        },
        async loadCepHandler(value) {
            try{
                const result = await loadCep(value)
                if(result){
                    this.payloadAddress.logradouro_bairro = result.bairro
                    this.payloadAddress.logradouro_cidade = result.cidade
                    this.payloadAddress.logradouro_estado = result.estado
                    this.payloadAddress.logradouro = result.logradouro
                }
            } catch(e) {
                console.log("loadCep", e, e.response)
            }
        },
    }
  }
  </script>
  
  <style scoped>
  .bg-max {
    background: rgba(255, 255, 255, 0.95);
  }
  </style>
  