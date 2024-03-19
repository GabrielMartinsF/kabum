<template>
    <q-dialog
      ref="addressEditDialog"
      style="backdrop-filter: blur(4px) "
    >
        <q-card class="full-width">
            <q-card-section class="row items-center">
                <div class="text-h6">Editar Cliente</div>
            </q-card-section>

            <q-card-section class="q-pt-none full-width">
                <div class="q-pa-sm full-width">
                    <q-form
                        @submit="addClient()"
                        class="row full-width"
                        ref="clientForm"
                    >
                        <div class="row full-width">
                            <q-input
                                class="col-2 q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                filled v-model="payload.nome" label="Nome Completo*" 
                                lazy-rules :rules="[ val => val && val.length > 0 || 'Campo obrigatório']"
                            />
                            <div class="row full-width">
                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width" mask="##/##/####"
                                    filled v-model="payload.data_nascimento" label="Data de Nascimento *" 
                                    lazy-rules :rules="[ val => validaDate(val) || 'Campo obrigatório']"
                                />

                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                    filled v-model="payload.cpf" label="CPF *" mask="###.###.###-##"
                                    lazy-rules :rules="[ val => documentValidatorHandler(val) || 'Campo deve ser preenchido com CPF válido']"
                                />
                            </div>
                            
                            <div class="row full-width">
                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                    filled v-model="payload.rg" label="RG *" mask="##.###.###-##"
                                    lazy-rules :rules="[ val => val && val.length > 0 || 'Campo obrigatório']"
                                />

                                <q-input
                                    class="col q-pr-sm p-pl-sm q-pb-md q-pt-md full-width"
                                    filled v-model="payload.telefone" label="Telefone *"  mask="(##) #####-####"
                                    lazy-rules :rules="[ val => val && val.length > 0 || 'Campo obrigatório']"
                                />
                            </div>                        
                        </div>
                    </q-form>

                    </div>
            </q-card-section>

            <q-card-actions align="center">
                <q-btn flat label="Cancelar" color="primary" v-close-popup />
                <q-btn flat label="Confirmar" color="primary" @click="editClient(id)" :loading="loading.confirmar" />
            </q-card-actions>
        </q-card>
    </q-dialog>
  </template>
  
  <script>
import { geral } from 'src/mixins';
import { loadCep } from 'src/utils';
  
export default {
    name: 'DialogClient',
    mixins: [geral],
    data () {
      return {
            id: null
      }
    },
    methods: {
        show (data) {
            if(data) {
                this.id = data.id_cliente
                this.payload = data
            }
            this.$refs.addressEditDialog.show();
        },
        hide () {
            this.$refs.addressEditDialog.hide();
        },

        async loadCepHandler(value) {
            try{
                const result = await loadCep(value)
                if(result){
                    this.payload.endereco.logradouro_bairro = result.bairro
                    this.payload.endereco.logradouro_cidade = result.cidade
                    this.payload.endereco.logradouro_estado = result.estado
                    this.payload.endereco.logradouro = result.logradouro
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
  