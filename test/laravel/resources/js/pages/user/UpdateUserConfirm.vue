<template>
  <v-container>
    <h3>Update User</h3>
    <v-row>
      <div class="col-md-8 col-sm-12">
        <v-form v-on:submit.prevent="updateuser(userId)" id="form">
          <v-container>
            <v-row>
              <v-col cols="4">
                <v-subheader>Name</v-subheader>
              </v-col>
              <v-col cols="8">
                <p>{{ userName }}</p>
                <v-text-field v-model="userName" name="name" v-show="disiable"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Email</v-subheader>
              </v-col>
              <v-col cols="8">
                <p>{{ email }}</p>
                <v-text-field v-model="email" name="email" v-show="disiable"></v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="4">
                <v-subheader>Type</v-subheader>
              </v-col>
              <v-col cols="8">
                <p>{{ type }}</p>
                <v-text-field v-model="type" name="type" v-show="disiable"></v-text-field>
                <!-- <select v-model="type" name="type">
                  <option value="0">Admin</option>
                  <option value="1">User</option>
                </select>-->
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Phone</v-subheader>
              </v-col>
              <v-col cols="8">
                <p>{{ phone }}</p>
                <v-text-field v-model="phone" name="phone" v-show="disiable"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Dirth of Birth</v-subheader>
              </v-col>
              <v-col cols="8">
                <p>{{ dob }}</p>
                <v-text-field v-model="dob" type="date" name="dob" v-show="disiable"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="4">
                <v-subheader>Address</v-subheader>
              </v-col>
              <v-col cols="8">
                <p>{{ address }}</p>
                <v-text-field v-model="address" name="address" v-show="disiable"></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" class="text-center">
                <v-btn color="primary" type="submit">Update</v-btn>
                <v-btn color="light">Cancel</v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </div>
      <div class="col-md-4 col-sm-0">
        <v-text-field v-model="profile.name" name="profile" v-show="disiable"></v-text-field>
        <img id="preview" alt="img" width="100" heigth="100" />
      </div>
    </v-row>
  </v-container>
</template>
<script>
export default {
  props: [
    "userId",
    "userName",
    "email",
    "password",
    "type",
    "dob",
    "address",
    "phone",
    "profile",
    "newprofile"
  ],
  data() {
    return {
      disiable: false
    };
  },
  methods: {
    updateuser(id) {
      // console.log(this.userdata.profile);
      var form = document.getElementById("form");
      var formData = new FormData(form);
      formData.append('profile', this.profile);
      axios
        .post("/auth/update/" + id, formData)
        .then(response => {
          console.log(response);
          console.log(this.profile);
          alert("sure this user");
          this.$router.push({ name: "userlist" });
        })
        .catch(err => {
          console.log(err.response);
          return err;
        });
    }
  },
  mounted() {
    if (this.profile) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $("#preview").attr("src", e.target.result);
      };

      reader.readAsDataURL(this.profile); // convert to base64 string
    }
    console.log(this.profile);
  }
};
</script>