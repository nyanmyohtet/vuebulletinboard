import utilsFunc from "../../utils/user-utils";
export default {
    props: ['user'],
    data() {
        return {
            userName: ""
        }
    },
    async mounted() {
        const userInfo = await utilsFunc.getCurrentLoginUser();
        this.userName = userInfo.name;
        console.log(this.user);
    }
};