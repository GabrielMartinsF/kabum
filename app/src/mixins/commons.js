import { mapState, mapGetters, mapActions } from "vuex";
import { date } from 'quasar'

export default {
    data () {
        return {
            windowWidth: window.innerWidth,
            isMobile: false,
            isDesktop: true
        }
    },
    beforeCreate () {
        this.$store.commit('auth/initialiseStore', {});
    },

    mounted () {
        this.windowWidth = window.innerWidth
        if (this.windowWidth <= 600) {
          this.isMobile = true
          this.isDesktop = false
        }

        window.onresize = () => {

            this.windowWidth = window.innerWidth
            if (this.windowWidth < 600) {
              this.isMobile = true
              this.isDesktop = false
            }
            else
                this.isMobile = false
                this.isDesktop = true
        }
        this.isDesktop = !this.isMobile

    },
    computed: {
        ...mapGetters('auth', ['loggedIn']),
    },
    methods: {
        ...mapActions('auth', ['logout']),
        doLogout () {
            this.logout()
            this.$router.push('/')
        },
    }
}
