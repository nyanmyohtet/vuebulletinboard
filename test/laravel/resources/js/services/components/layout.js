
import { mapGetters } from "vuex";
import constants from "../../constants/constants";
import utilsFunc from "../../utils/user-utils";

export default {
    data() {
        return {
            title: constants.APP_TITLE
        };
    },
    computed: {
        ...mapGetters(["isLoggedIn"])
    },

    methods: {
        /**
         * This is to log out from system.
         * @returns void
         */
        logout() {
            this.$store
                .dispatch("logout")
                .then(() => {
                    this.$router.push({ name: "login" });
                })
                .catch(err => {
                    console.log(err);
                });
        },
        /**
         * This is to route profile page.
         * @returns void
         */
        showProfile() {
            if (this.$router.app._route.name !== "profile")
                this.$router.push({ name: "profile" });
        }
    },
    async mounted() {
        const userInfo = await utilsFunc.getCurrentLoginUser();
        if(userInfo.error) {
          this.$store.commit('setUserData', null);
          if(this.$router.app._route.name !== "login") {
            this.$router.push({ name: "login" });
          }
        }
    }
};
