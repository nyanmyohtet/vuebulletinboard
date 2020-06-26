<template>
  <v-container>
    <h3>Update User</h3>
    <v-row>
      <div class="col-md-8 col-sm-12">
        <v-form v-on:submit.prevent="edituser(userId)" id="form">
          <v-container>
            <input type="hidden" name id v-model="userId" />
            <v-row>
              <v-col cols="4">
                <v-subheader>Name</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field v-model="userName" name="name"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Email</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field v-model="email" name="email"></v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="4">
                <v-subheader>Type</v-subheader>
              </v-col>
              <v-col cols="8">
                <select v-model="type" name="type">
                  <option value="0">Admin</option>
                  <option value="1">User</option>
                </select>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Phone</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field v-model="phone" name="phone"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Dirth of Birth</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field v-model="dob" type="date" name="dob"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Address</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-text-field v-model="address" name="address"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Profile</v-subheader>
              </v-col>
              <v-col cols="8">
                <v-file-input
                  v-model="profile"
                  accept="image/png, image/jpeg"
                  @change="Preview_image($event)"
                />
                <img id="Preview_image_create" class="Preview_image" />
              </v-col>
            </v-row>
            <v-row>
              <router-link :to="{ name: 'changepassword'}">changepassword</router-link>
            </v-row>
            <v-row>
              <v-col cols="12" class="text-center">
                <v-btn color="primary" type="submit">Confirm</v-btn>
                <v-btn color="light">Cancel</v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </div>
      <div class="col-md-4 col-sm-0">
        <img :src="'/img/tempProfile/'+ profile" alt="img" width="100" heigth="100" />
      </div>
    </v-row>
  </v-container>
</template>
<script>
import utilsFunc from "../../utils/user-utils";
export default {
  data() {
    return {
      userId: "",
      userName: "",
      email: "",
      phone: "",
      address: "",
      type: "",
      dob: "",
      profile: "",
      newprofile:""
    };
  },
  async mounted() {
    const userInfo = await utilsFunc.getCurrentLoginUser();
    this.userId = userInfo.id;
    this.userName = userInfo.name;
    this.email = userInfo.email;
    this.phone = userInfo.phone;
    this.address = userInfo.address;
    this.type = userInfo.type;
    this.dob = userInfo.dob;
    this.profile = userInfo.profile;
  },
  methods: {
    edituser(id) {
      var form = document.getElementById("form");
      var formData = new FormData(form);
      axios
        .post("/auth/editconfirm/" + id, formData)
        .then(response => {
          console.log(response);
          alert("sure this user");
          console.log(this.profile);
          this.$router.push({ name: "UpdateConfirm",params: { userId:this.userId,userName:this.userName,email: this.email, password:this.password,
          phone: this.phone, address:this.address, dob: this.dob, type:this.type, profile:this.profile } });
        })
        .catch(err => {
          console.log(err.response);
          return err;
        });
    },
    Preview_image(e) {
      if (e) {
        $("#Preview_image_create").attr("src", URL.createObjectURL(e)); // jQuery selector
      }
    }
  }
};
</script>
<style scoped>
.form-wd {
  max-width: 960px;
  width: 100%;
  margin: 0 auto;
}
select {
  width: 100%;
  border: 1px solid gray;
}
</style>
