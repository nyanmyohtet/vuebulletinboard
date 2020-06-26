<template>
  <v-container>
    <h2>Create User Confirm</h2>
    <v-form class="form-wd" v-on:submit.prevent="createstore" id="form">
      <v-container>
        <v-row>
          <v-col cols="4">
            <v-subheader>Name</v-subheader>
            <v-text-field label="Enter username" v-model="name" name="name" v-show ="disiable"></v-text-field>
          </v-col>
          <v-col cols="8">
            <p>{{ name }}</p>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Email</v-subheader>
          </v-col>
          <v-col cols="8">
            <p>{{ email }}</p>
            <v-text-field label="Enter email" v-model="email" name="email" v-show ="disiable"></v-text-field>
          </v-col>
        </v-row>

        <!-- <v-row>
          <v-col cols="4">
            <v-subheader>Password</v-subheader>
          </v-col>
          <v-col cols="8">
            <p>{{password}}</p>
            <v-text-field label="Enter Password" type="password" name="password" v-model="password" v-show ="disiable"></v-text-field>
          </v-col>
        </v-row> -->

        <v-row>
          <v-col cols="4">
            <v-subheader>User Type</v-subheader>
          </v-col>
          <v-col cols="8">
            <!-- <p>{{ type }}</p> -->
            <p v-if="type==0">Admin</p>
            <p v-else>User</p>
            <v-text-field label="Enter Type" v-model="type" name="type" v-show ="disiable"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Phone</v-subheader>
          </v-col>
          <v-col cols="8">
            <p>{{ phone }}</p>
            <v-text-field label="Enter Phone No" v-model="phone" name="phone" v-show ="disiable"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Date of birth</v-subheader>
          </v-col>
          <v-col cols="8">
            <p>{{ dob }}</p>
            <v-text-field label="Enter birth date" type="date" v-model="dob" name="dob" v-show ="disiable"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Address</v-subheader>
          </v-col>
          <v-col cols="8">
            <p>{{ address }}</p>
            <v-text-field label="Enter Address" v-model="address" name="address" v-show ="disiable"></v-text-field>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4">
            <v-subheader>Profile</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field v-model="profile.name" name="profile" v-show ="disiable"></v-text-field>
            <img id="preview" alt="img" width="100" heigth="100" />
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12" class="text-center">
            <v-btn color="primary" type="submit">Comfirm</v-btn>
            <v-btn color="light" type="reset">Cancel</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-container>
</template>
<script>
export default {
  props: ["name", "email","password","type","phone","dob","address","profile"],
  data() {
    return {
      disiable : false,
    }
  },
   methods: {
    createstore: function(e) {
      // console.log(this.userdata.profile);
      var form = document.getElementById('form');
      var formData = new FormData(form);
      axios({
        method: "post",
        url: "/auth/createuser",
        data: formData,
        config: { headers: { "Content-Type": "multipart/form-data" } }
      })
        .then(response => {
          console.log(response);
          this.$router.push({ name: "userlist", });
          // return response.data;
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
      $('#preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(this.profile); // convert to base64 string
  }
    console.log(this.profile);
  }
  
};
</script>