<template>
  <v-container>
    <h2>Create Post Confim</h2>
    <v-form v-on:submit.prevent="createstore" id="form">
      <v-container>
        <v-row>
          <v-col cols="4">
            <v-subheader>Title</v-subheader>
            <v-text-field v-model="title" name="title" v-show="disiable"></v-text-field>
          </v-col>
          <v-col cols="8">
            <p>{{ title }}</p>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="4">
            <v-subheader>Description</v-subheader>
            <v-text-field v-model="description" name="description" v-show="disiable"></v-text-field>
          </v-col>
          <v-col cols="8">
            <p>{{ description }}</p>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12" class="text-center">
            <v-btn color="primary" type="submit" class="mr-4">Comfirm</v-btn>
            <!-- <v-btn color="light" type="reset">Cancel</v-btn> -->
            <router-link to="/vue/createpost" class="btn btn-light">Cancel</router-link>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-container>
</template>
<script>
export default {
  props: ["id","title", "description"],
  data() {
    return {
      disiable: false
    };
  },
  methods: {
    createstore: function(e) {
      var form = document.getElementById("form");
      var formData = new FormData(form);
      axios({
        method: "post",
        url: "/auth/createpost",
        data: formData,
        config: { headers: { "Content-Type": "multipart/form-data" } }
      })
        .then(response => {
          console.log(response);
          this.$router.push({ name: "postlist" });
          // return response.data;
        })
        .catch(err => {
          console.log(err.response);
          return err;
        });
    }
  }
};
</script>