<template>
    <q-layout view="lHh LpR lFf">
      <q-header class="bg-default">
        <div class="row justify-between">
          <q-toolbar class="row col-xs-5 q-pl-md">
            <q-btn
              flat
              @click="drawerLeft = !drawerLeft"
              round
              dense
              icon="menu"
            />
          </q-toolbar>
          <LoginSignupComponent />
        </div>
        <q-separator dark />
      </q-header>
      <q-drawer
        v-model="drawerLeft"
        content-class="bg-primary text-white"
        :width="350"
        bordered
      >
        <q-card
          flat
          class="transparent"
        >
          <div class="row q-px-lg q-py-md q-mx-auto">
            <q-btn
              to="/"
              flat
              :ripple="false"
              padding="xs"
              style="width: 100%;"
            >
              <!-- <q-avatar class="q-ma-sm logo-header">
              </q-avatar> -->
              <img
                class="q-ma-sm logo-header"
                src="LOGO SPDATA MINHA CLINICA BRANCO.svg"
              />
              <!-- <div class="q-mt-md q-ml-xs text-uppercase icon-text">
                <b>Agendamento online</b>
              </div> -->
            </q-btn>
          </div>
          <q-form
            @submit.prevent="() => true"
            ref="filterForm"
          >
            <q-card-section class="row q-pa-xs">
              <q-item class="col-xs-12 col-sm-4 column full-width">
                <q-btn-toggle
                  v-model="filterAttendance"
                  class="q-mt-xs bg-opaque"
                  no-caps
                  unelevated
                  spread
                  adding="xs xl"
                  toggle-color="secondary"
                  text-color="white"
                  :options="attendanceOptions"
                  emit-value
                  map-options
                />
              </q-item>
  
              <q-item class="col-xs-12 col-sm-4 column full-width">
                <q-btn-toggle
                  v-model="filterPaymentForm"
                  class="q-mt-xs bg-opaque"
                  no-caps
                  unelevated
                  spread
                  adding="xs xl"
                  toggle-color="secondary"
                  text-color="white"
                  :options="paymentFormOptions"
                  emit-value
                  map-options
                />
              </q-item>
  
              <q-item
                class="full-width"
                v-if="!isParticular"
              >
                <q-select
                  class="full-width"
                  label="Convênio médico"
                  color="secondary"
                  option-value="codigo"
                  option-label="nome"
                  :options-dark="false"
                  v-model="filterMedicalInsurance"
                  :options="medicalInsurances"
                  emit-value
                  map-options
                  dark
                  clearable
                  :loading="loading.medicalInsurance"
                  lazy-rules
                  :rules="[ val => isMedicalInsuranceValid(val) || 'Convênio médico é obrigatório']"
                >
                  <template v-slot:no-option>
                    <q-item>
                      <q-item-section class="text-italic text-grey">
                        Nenhum convêio médico encontrado
                      </q-item-section>
                    </q-item>
                  </template>
                </q-select>
              </q-item>
  
              <q-item
                class="full-width"
                v-if="!isTelemedicina"
              >
                <q-select
                  class="full-width"
                  label="Localidade"
                  :options-dark="false"
                  color="secondary"
                  dark
                  clearable
                  option-value="sigla"
                  option-label="nome"
                  v-model="filterLocation"
                  :options="allLocations"
                  emit-value
                  map-options
                  :loading="loading.location"
                  lazy-rules
                  :rules="[ val => isLocationValid(val) || 'Localidade é obrigatória']"
                >
                  <template v-slot:no-option>
                    <q-item>
                      <q-item-section class="text-italic text-grey">
                        Nenhuma localidade encontrada
                      </q-item-section>
                    </q-item>
                  </template>
                </q-select>
              </q-item>
              <q-item class="full-width">
                <q-select
                  class="full-width"
                  label="Especialidade"
                  :options-dark="false"
                  color="secondary"
                  option-value="codigo"
                  option-label="nome"
                  v-model="filterSpecialty"
                  :options="specialties"
                  emit-value
                  map-options
                  dark
                  clearable
                  :loading="loading.specialty"
                  lazy-rules
                  :rules="[
                        val => isSpecialtyValid(val) || 'Especialidade é obrigatória',
                        _ => isOtherValid() || 'Pelo menos uma Especialidade ou Clínica ou Profissional devem ser escolhidos'
                    ]"
                >
                  <template v-slot:no-option>
                    <q-item>
                      <q-item-section class="text-italic text-grey">
                        Nenhuma especialidade encontrada
                      </q-item-section>
                    </q-item>
                  </template>
                </q-select>
              </q-item>
              <q-item
                class="full-width"
                v-if="!isTelemedicina"
              >
                <q-select
                  class="full-width"
                  label="Clínica"
                  color="secondary"
                  option-value="codigo"
                  :option-label="formatCompanyDesc"
                  :options-dark="false"
                  v-model="filterTenant"
                  :options="companies"
                  emit-value
                  map-options
                  dark
                  clearable
                  :loading="loading.tenant"
                  lazy-rules
                  :rules="[ _ => isOtherValid() || 'Pelo menos uma Especialidade ou Clínica ou Profissional devem ser escolhidos']"
                >
                  <template v-slot:no-option>
                    <q-item>
                      <q-item-section class="text-italic text-grey">
                        Nenhuma clínica encontrada
                      </q-item-section>
                    </q-item>
                  </template>
                </q-select>
              </q-item>
  
              <q-item class="full-width">
                <q-select
                  class="full-width"
                  label="Profissional"
                  :options-dark="false"
                  color="secondary"
                  :option-value="opt => Object(opt) === opt && 'tenant' in opt ? `${opt.tenant.codigo}_${opt.codigo}` : null"
                  :option-label="formatProfessionalDesc"
                  v-model="filterProfessional"
                  :options="professionalsByTenant"
                  emit-value
                  map-options
                  dark
                  clearable
                  :loading="loading.tenant"
                  lazy-rules
                  required
                  :rules="[ val => isOtherValid(val) || 'Pelo menos uma Especialidade ou Clínica ou Profissional devem ser escolhidos']"
                  @clear="clearTenant"
                >
                  <template v-slot:no-option>
                    <q-item>
                      <q-item-section class="text-italic text-grey">
                        Nenhum profissional encontrada
                      </q-item-section>
                    </q-item>
                  </template>
                </q-select>
              </q-item>
              <q-item class="text-dark">
                <q-date
                  class="full-width"
                  v-model="filterDate"
                  no-unset
                  mask="YYYY/MM/DD"
                  :options="disabledDate"
                  today-btn
                  subtitle="Data"
                  color="primary"
                />
              </q-item>
            </q-card-section>
          </q-form>
        </q-card>
      </q-drawer>
      <q-page-container>
        <router-view />
      </q-page-container>
    </q-layout>
  </template>
  
  <script>
  
  import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
  import { booking, commons } from '../mixins'
  import { date } from 'quasar'
  import LoginSignupComponent from '../components/LoginSignupComponent'
  
  export default {
    name: 'MainLayoutBooking',
    components: {
      LoginSignupComponent
    },
    mixins: [commons, booking],
    data () {
      return {
        drawerLeft: true,
      }
    },
    mounted () {
      if (this.windowWidth < 768) {
        setTimeout(() => this.drawerLeft = false, 2000)
      }
    },
    computed: {
      ...mapGetters('booking', ['isTelemedicina'])
    },
    methods: {
      ...mapActions('booking', ['fetchAttendances']),
      disabledDate (dateCalendar) {
        return dateCalendar >= date.formatDate(Date.now(), 'YYYY/MM/DD') &&
          this.fullDaysOrNotAvaible &&
          !this.fullDaysOrNotAvaible.includes(dateCalendar)
      },
      clearTenant () {
        if (this.isTelemedicina) this.filterTenant = null;
      }
    },
    watch: {
      'filterState': {
        deep: true,
        async handler () {
          await this.$refs['filterForm'].validate()
        },
      },
    }
  }
  </script>
  
  <style scoped>
  /* Mobile classes */
  
  .bg-default {
    background: linear-gradient(
      90deg,
      rgba(0, 98, 164, 1) 7%,
      rgba(0, 186, 182, 0.95) 100%
    );
  }
  .icon-text {
    width: 7.1em;
    line-height: 1.25em;
    font-size: 1.25em;
  }
  .logo-header {
    width: 100%;
  }
  
  .bg-primary {
    background: rgba(0, 98, 164, 0.95);
  }
  .bg-opaque,
  .bg-card {
    background: rgba(255, 255, 255, 0.15);
  }
  
  /* Desktop classes */
  </style>
  