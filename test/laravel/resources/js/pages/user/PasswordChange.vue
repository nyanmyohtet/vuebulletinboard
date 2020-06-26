<template>
  <v-container>
    <h2>Change Password</h2>
    <v-form class="form-wd" v-on:submit.prevent="changePassword" id="form">
      <v-container>
        <v-row>
          <v-col cols="4">
            <v-subheader>Old Password</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field label="Enter old password" v-model="password.current_password"></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="4">
            <v-subheader>New Password</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field label="Enter new password" v-model="password.new_password"></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="4">
            <v-subheader>Confirm New Password</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field label="Enter confirm password" v-model="password.new_confirm_password"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12" class="text-center">
            <v-btn color="primary" type="submit">Create</v-btn>
            <v-btn color="light" type="reset">Cancel</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-container>
</template>
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
<script>
export default {
  data() {
    return {
      password: {
        current_password: "",
        new_password: "",
        new_confirm_password: ""
      }
    };
  },
  methods: {
    changePassword() {
      axios
        .post("auth/changepassword", this.password)
        .then(response => {
          // this.password = {
          //   old_password:this.password,
          //   new_password: "",
          //   new_confirm_password: ""
          // };
          console.log(response.data.message);
          alert("test");
          this.$router.push({ name: "userlist" });
        })
        .catch(err => {
          console.log(err.response);
          return err;
        });
    }
  }
};
</script>