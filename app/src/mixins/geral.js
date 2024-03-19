import { mapActions, mapGetters, mapMutations } from 'vuex';
import Notifier from 'src/services/NotifyService'
import { date, Loading } from 'quasar'
import _ from 'lodash'
import { ref } from "vue";
import { documentValidator } from 'src/utils/validators/document';
import UserService from "src/services/UserService";
import ClientService from "src/services/ClientService";
import AddressService from 'src/services/AddressService';


export default {
    data () {
        return {
            loading:{
                confirmar: ref(false),
                login: ref(false)
            },
            login: ref(''),
            password: ref(''),
            isPwd: ref(true),
            payload : {
                nome: '',
                data_nascimento: '',
                cpf: '',
                rg: '',
                telefone: '',
                endereco: {
                    logradouro: '',
                    logradouro_numero: '',
                    logradouro_complemento: '',
                    logradouro_bairro: '',
                    logradouro_cep: '',
                    logradouro_cep: '',
                    logradouro_cidade: '',
                    logradouro_estado: '',
                }
            },
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
    beforeCreate () {
        
    },
    created () {
      
    },
    computed: {
        ...mapGetters('clients', ["clientes"])
    },
    methods: {
          ...mapActions('clients', ["fetchClientes"]),
          openDialogClient(){
              this.$refs.dialogClient.show()
          },
          openDialogAddress(client){
              this.$refs.dialogAddress.show(client)
          },
          openDialogEditAddress(data){
            this.$refs.dialogEditAddress.show(data)
          },
          openDialogEditClient(data){
            this.$refs.dialogEditClient.show(data)
          },

          /* validate and formate */

          documentValidatorHandler(value) {
            return documentValidator(value)
          },
          validaDate(value){
            const partesData = value.split('/')
            const data = {
                dia: partesData[0],
                mes: partesData[1],
                ano: partesData[2]
            }

            const dia = parseInt(data.dia)
            const mes = parseInt(data.mes)

            if (mes < 1 || mes > 12 || dia < 1 || dia > 31) {
                return false
            }

            return true
          },

          /* user */
          async singup() {
            this.loading.cadastro = true
            const payload = {
              login: this.login,
              senha: this.password
            }
      
            try {
              await UserService.cadastro(payload)
              this.loading.cadastro = false
              router.push({ name: 'login'})
            }
            catch(err) {
              Notifier.error(err.response.data.message)
              this.loading.cadastro = false
            }
            
          },

          async access() {
            this.loading.login = true;
            const payload = {
              login: this.login,
              senha: this.password
            }
      
            try {
              const login = await UserService.login(payload)
              this.loading.login = false
              localStorage.setItem("token", login.data.jwt)
              router.push({ name: 'painel'})
            }
            catch(err) {
              Notifier.error(err.response.data.message)
              this.loading.login = false
            }            
          },
      

          /* Client */
          async addClient(){
              let success = await this.$refs['clientForm'].validate()
              if(success){
                  try {
                      this.loading.confirmar = true
                      await ClientService.adicionar(this.payload)
                      this.loading.confirmar = false
                      await this.fetchClientes()
                      this.hide()
                  } catch (e) {
                      Notifier.error(e.response.data.message)
                      this.loading.confirmar = false
                  }
              }
          },

          async editClient(){
              let success = await this.$refs['clientForm'].validate()
              if(success){
                  try {
                      this.loading.confirmar = true
                      await ClientService.editar(this.payload)
                      this.loading.confirmar = false
                      await this.fetchClientes()
                      this.hide()
                  } catch (e) {
                      Notifier.error(e.response.data.message)
                      this.loading.confirmar = false
                  }
              }
          },

          async deletarClient(id) {
            try {
              await ClientService.deletar(id)
              this.fetchClientes()
              Notifier.success("Cliente deletado!")
            } catch (e) {
              Notifier.error(e.response.data.message)
            }                
          },


          /* Address */
          async addAddress(){
            let success = await this.$refs['addressForm'].validate()
            if(success){
                try {
                    this.loading.confirmar = true
                    await AddressService.adicionar(this.payloadAddress)
                    this.fetchClientes()
                    this.loading.confirmar = false
                    this.hide()
                } catch (e) {
                    Notifier.error(e.response.data.message)
                    this.loading.confirmar = false
                }
            }
          },

          async editAddress(){
              let success = await this.$refs['clientForm'].validate()
              if(success){
                  try {
                      this.loading.confirmar = true
                      await AddressService.editar(this.payloadAddress)
                      this.loading.confirmar = false
                      await this.fetchClientes()
                      this.hide()
                  } catch (e) {
                      Notifier.error(e.response.data.message)
                      this.loading.confirmar = false
                  }
              }
          },

          async deleteAddress(id) {
            try {
              await AddressService.deletar(id)
              this.fetchClientes()
              Notifier.success("endereço deletado!")
            } catch (e) {
              Notifier.error(e.response.data.message)
            }  
          },
    },
    watch: {
        
    },
}
