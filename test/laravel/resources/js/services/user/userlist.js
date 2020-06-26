import constants from "../../constants/constants";
import utilsFunc from "../../utils/user-utils";
export default {
    data() {
        return {
            searchName: '',
            searchMail: '',
            userlisttitle: constants.User_List_Title,
            headers: [
                { text: 'Name', value: 'name' },
                { text: 'Email', value: 'email' },
                { text: 'Create user', value: 'users.name' },
                { text: 'Phone', value: 'phone', sortable: false },
                { text: 'Birth Date', value: 'dob', sortable: false },
                { text: 'Address', value: 'address', sortable: false },
                { text: 'Created Date', value: 'created_at', sortable: false },
                { text: 'Updated Date', value: 'updated_at', sortable: false },
                { text: 'Action', value: 'actions', sortable: false }
            ],
            userlist: [],
            showlist: [],
            fromDateVal: null,
            minDate: "",
            maxDate: "",
            Date:"",
            deleteDialog: false,
            detailDialog:false,
            deleteID: null,
            userType: "",
            detailItem: {
                users: {
                    name:""
                }
            }
        }
    },
    async mounted() {
        const userInfo = await axios.get("/auth/userlist").then(response => {
            // console.log(response);
            return response.data;
        })
            .catch(err => {
                console.log(err);
                return err;
            });
        this.userlist = userInfo;
        this.showlist = this.userlist;

        // console.log(userInfo);
    },
    computed: {
        // fromDateDisp() {
        //     return this.fromDateVal;
        // }
    },
    methods: {
        getDate(datetime) {
            let date = new Date(datetime).toJSON().slice(0, 10).replace(/-/g, '/')
            return date
        },
        searchFilter() {
            this.showlist = this.userlist.filter(
                this.checkName
            );
        },
        checkName(user) {
            let var1 = user.name.toLowerCase().includes(this.searchName.toLowerCase());

            let var2 = user.email.toLowerCase().includes(this.searchMail.toLowerCase());

            let start = user.created_at.toLowerCase().includes(this.minDate.toLowerCase());
            let end = user.created_at.toLowerCase().includes(this.maxDate.toLowerCase());
            // let start = new Date(this.minDate);
            // let end = new Date(this.maxDate);
            // let start = this.minDate.getTime();
            // let end = this.maxDate.getTime();
            // let date = this.getDate(user.created_at);
            // return date >= start && date <= end;
            // return start;

            if (var1 == null) {
                return var2;
            } else if (var2 == null) {
                return var1;
            } else if (var1 == null && var2 == null) {
                return start;
            } else {
                return var1 && var2 && start && end;
            }
        },
        deleteConfirm(id) {
            this.deleteDialog = true;
            this.deleteID = id;
        },
        deleteuser(id) {
            axios.delete("/auth/deleteuser/" + id).then(response => {
                console.log(response);
                this.userlist.splice(this.userlist.indexOf(id), 1);
                this.deleteDialog = false;
                // return response.data;
            })
                .catch(err => {
                    console.log(err.response);
                    return err;
                });
        },
        infoDetail(showlist) {
            this.detailDialog = true;
            this.detailItem = showlist;
        }
    },
    async beforeCreate() {
        const userInfo = await utilsFunc.getCurrentLoginUser();
        this.userType = userInfo.type;
    }
}