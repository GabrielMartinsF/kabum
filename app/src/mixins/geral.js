import Notifier from '../services/NotifyService'
import { date, Loading } from 'quasar'
import _ from 'lodash'
import { ref } from "vue";
import { loadCep } from 'src/utils';
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
            clientes: ref(null),
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
            }
        }
    },
    beforeCreate () {
        
    },
    created () {
        
    },
    computed: {
        
    },
    methods: {

          openDialogClient(){
              this.$refs.dialogClient.show()
          },
          openDialogAddress(client){
              this.$refs.dialogAddress.show(client)
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
              router.push({ name: 'profile'})
            }
            catch(err) {
              console.log(err)
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
              console.log(err)
              this.loading.login = false
            }
      
            if (login.status == 200) {
      
              this.$route.push({name: "painel"})
            }
            
          },
      

          /* Client */
          async buscarClient() {
            let client = await ClientService.fetch()
            if (client.status == 200) {
                this.clientes = client.data.data
            }
          },
          async deletarClient(id) {
            let del = await ClientService.deletar(id)
            if(del.status == 200){
                this.buscarClient()
            }
          },


          /* Address */
          async addAddress(payload){
              this.loading.confirmar = true
              let success = await this.$refs['clientForm'].validate()
              if(success){
                  try {
                      AddressService.adicionar(payload)
                      this.buscarClient()
                      this.loading.confirmar = false
                  } catch (e) {
                      NotifyService.error("erro aqui")
                      console.log('addClient', e, e.response)
                      this.loading.confirmar = false
                  }
              }
          },

          async deleteAddress(id) {
              let del = await AddressService.deletar(id)
              if(del.status == 200){
                  this.buscarClient()
              }
          },
    },
    watch: {
        
    },
}
