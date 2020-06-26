
<template>
  <v-container>
    <h2>Create User</h2>
    <v-form class="form-wd" v-on:submit.prevent="createuser">
      <v-container>
        <v-row>
          <v-col cols="4">
            <v-subheader>Name</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field label="Enter username" v-model="userdata.name"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Email</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field label="Enter email" v-model="userdata.email" :rules="emailRules"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Password</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field
              label="Enter Password"
              type="password"
              v-model="userdata.password"
              :rules="pwdRules"
            ></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Confirm Password</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field
              label="Enter Confirm password"
              type="password"
              v-model="userdata.confirm_password"
              :rules="confirmpwRules"
            ></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>User Type</v-subheader>
          </v-col>
          <v-col cols="8">
            <select v-model="userdata.type">
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
            <v-text-field label="Enter Phone No" v-model="userdata.phone"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Date of birth</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field label="Enter birth date" type="date" v-model="userdata.dob"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Address</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field label="Enter Address" v-model="userdata.address"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Profile</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-file-input
              name="profile"
              type="file"
              v-model="userdata.profile"
              :error-messages="error"
              v-on:change="Preview_image($event)"
            />
            <img id="Preview_image_create" class="Preview_image" />
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12" class="text-center">
            <v-btn color="primary" type="submit">Create</v-btn>
            <v-btn color="light" type="reset" @click="resetForm()">Cancel</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-container>
</template>

<script>
import UserType from "../../components/UserType.vue";
export default {
  data() {
    return {
      userdata: {
        name: "",
        email: "",
        password: "",
        confirm_password: "",
        phone: "",
        type: "",
        dob: "",
        address: "",
        profile: null
      },
      valid: true,
      email: "",
      password: "",
      error: "",

      // validation rules for user email.
      emailRules: [
        value => !!value || "The email field is required.",
        value => /.+@.+\..+/.test(value) || "E-mail must be valid."
      ],

      // validation rules for password.
      pwdRules: [
        value => !!value || "The password field is required.",
        value => value.length >= 8 || "Please Fill at least 8 characters"
      ],
      confirmpwRules: [
        value => !!value || "The confirm password field is required.",
        value =>
          this.userdata.password === this.userdata.confirm_password ||
          "Password must match"
      ]
    };
  },
  components: {
    UserType
  },
  methods: {
    createuser: function(e) {
      console.log(this.userdata.profile);
      var formData = new FormData();
      formData.append("name", this.userdata.name);
      formData.append("email", this.userdata.email);
      formData.append("password", this.userdata.password);
      formData.append("confirm_password", this.userdata.confirm_password);
      formData.append("dob", this.userdata.dob);
      formData.append("type", this.userdata.type);
      formData.append("phone", this.userdata.phone);
      formData.append("address", this.userdata.address);
      formData.append("profile", this.userdata.profile);
      axios({
        method: "post",
        url: "/auth/createuserconfirm",
        data: formData,
        config: { headers: { "Content-Type": "multipart/form-data" } }
      })
        .then(response => {
          // console.log(response);
          this.$router.push({
            name: "createuserconfirm",
            params: {
              name: this.userdata.name,
              email: this.userdata.email,
              password: this.userdata.password,
              type: this.userdata.type,
              phone: this.userdata.phone,
              dob: this.userdata.dob,
              address: this.userdata.address,
              profile: this.userdata.profile
            }
          });
          // return response.data;
        })
        .catch(err => {
          console.log(err.response);
          this.error = "this profile must be image"
          return err;
        });
    },
    Preview_image(e) {
      if (e) {
        $("#Preview_image_create").attr("src", URL.createObjectURL(e)); // jQuery selector
      }
    },
    resetForm() {
      console.log("Reseting the form");
      var self = this; //you need this because *this* will refer to Object.keys below`

      //Iterate through each object field, key is name of the object field`
      Object.keys(this.userdata).forEach(function(key, index) {
        self.userdata[key] = "";
      });
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