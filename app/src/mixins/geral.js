import Notifier from '../services/NotifyService'
import { date, Loading } from 'quasar'
import _ from 'lodash'
import { ref } from "vue";
import { loadCep } from 'src/utils';
import { documentValidator } from 'src/utils/validators/document';
import UserService from "src/services/UserService";
import ClientService from "src/services/ClientService";


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
        async addClient(){
        this.loading.confirmar = !this.loading.confirmar
        let success = await this.$refs['clientForm'].validate()
        if(success){
            try {
                ClientService.adicionar(this.payload)
                this.loading.confirmar = !this.loading.confirmar
                
            } catch (e) {
                NotifyService.error("erro aqui")
                console.log('addClient', e, e.response)
                this.loading.confirmar = !this.loading.confirmar
            }
        }
        },
        async loadCepHandler() {
        try{
            const result = await loadCep(this.payload.endereco.logradouro_cep)
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
        async access() {
            this.loading.login = true;
            const payload = {
              login: this.login,
              senha: this.password
            }
            let login = await UserService.login(payload)
      
            
      
            try {
              const login = await UserService.login(payload)
              this.loading.login = !this.loading.login
              localStorage.setItem("token", login.data.jwt)
              router.push({ name: 'painel'})
            }
            catch(err) {
              console.log(err)
              this.loading.login = this.loading.login
            }
      
            if (login.status == 200) {
      
              this.$router.push({name: "painel"})
            }
            
          },
          openEditAddress(){
            this.$refs.editAddress.show()
          },
          async buscar() {
            let client = await ClientService.fetch()
            if (client.status == 200) {
              this.clientes = client.data.data
            }
          },
          async deletarClient(id) {
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
          },
          async singup() {
            this.loading.cadastro = !this.loading.cadastro
            const payload = {
              login: this.login,
              senha: this.password
            }
      
            try {
              await UserService.cadastro(payload)
              this.loading.cadastro = !this.loading.cadastro
              router.push({ name: 'profile'})
            }
            catch(err) {
              console.log(err)
              this.loading.cadastro = false
            }
            
          },
    },
    watch: {
        
    },
}
