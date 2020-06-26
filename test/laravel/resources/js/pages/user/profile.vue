<template>
  <v-container>
    <v-row>
      <div class="col-10 col-sm-10 col-md-10">
        <h3>User Profile</h3>
      </div>
      <div class="col-2 col-sm-2 col-md-2">
        <a href="/vue/update" class="btn btn-primary">Edit</a>
      </div>
    </v-row>
    <v-form>
      <v-container>
        <v-row>
          <label for="name" class="col-4 col-sm-4 col-md-4">Name</label>
          <label for="name" class="col-8 col-sm-8 col-md-8">{{ userName }}</label>
        </v-row>
        <v-row>
          <label for="name" class="col-4 col-sm-4 col-md-4"></label>
          <div class="col-8 col-sm-8 col-md-8">
            <img :src="'/img/tempProfile/'+ profile" alt="img" width="100" heigth="100" />
          </div>
        </v-row>
        <v-row>
          <label for="email" class="col-4 col-sm-4 col-md-4">Email</label>
          <label for="email" class="col-8 col-sm-8 col-md-8">{{ email }}</label>
        </v-row>
        <v-row>
          <label for="type" class="col-4 col-sm-4 col-md-4">Type</label>
          <label for="type" class="col-8 col-sm-8 col-md-8">{{ type }}</label>
        </v-row>
        <v-row>
          <label for="phone" class="col-4 col-sm-4 col-md-4">Phone</label>
          <label for="phone" class="col-8 col-sm-8 col-md-8">{{phone}}</label>
        </v-row>
        <v-row>
          <label for="dob" class="col-4 col-sm-4 col-md-4">Date Of Birth</label>
          <label for="dob" class="col-8 col-sm-8 col-md-8">{{ dob }}</label>
        </v-row>
        <v-row>
          <label for="address" class="col-4 col-sm-4 col-md-4">Address</label>
          <label for="address" class="col-8 col-sm-8 col-md-8">{{ address }}</label>
        </v-row>
      </v-container>
    </v-form>
  </v-container>
</template>
<script>
import utilsFunc from "../../utils/user-utils";
export default {
  data() {
    return {
      userName: "",
      email: "",
      phone: "",
      address: "",
      type: "",
      dob: "",
      profile: ""
    };
  },
  async mounted() {
    const userInfo = await utilsFunc.getCurrentLoginUser();
    this.userName = userInfo.name;
    this.email = userInfo.email;
    this.phone = userInfo.phone;
    this.address = userInfo.address;
    this.type = userInfo.type;
    this.dob = userInfo.dob;
    this.profile = userInfo.profile;
  }
};
</script>