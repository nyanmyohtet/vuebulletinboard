<template>
  <v-container>
    <h2>Update Post</h2>
    <v-form class="form-wd" v-on:submit.prevent="updatepost(id)" id="form">
      <v-container>
        <v-row>
          <v-col cols="4">
            <v-subheader>Title</v-subheader>
          </v-col>
          <v-col cols="8">
            <p>{{ title }}</p>
            <v-text-field name="title" v-model="title" v-show="disiable"></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="4">
            <v-subheader>Description</v-subheader>
          </v-col>
          <v-col cols="8">
            <p>{{ description }}</p>
            <v-text-field name="description" v-model="description" v-show="disiable"></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="4">
            <v-subheader>Status</v-subheader>
          </v-col>
          <v-col cols="8">
            <!-- <p>{{ description }}</p> -->
            <!-- <v-text-field name="description" v-model="description" v-show="disiable"></v-text-field> -->
            <v-switch v-model="status" name="status" disabled></v-switch>
            <v-text-field name="status" v-model="status" v-show="disiable"></v-text-field>
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
  </v-container>
</template>

<script>
export default {
  props: ["id", "title", "description","status"],
  data() {
    return {
      disiable: false
    };
  },
  methods: {
    updatepost(id) {
      var form = document.getElementById("form");
      var formData = new FormData(form);
      axios
        .post("/auth/updatepost/" + id, formData)
        .then(response => {
          console.log(response);
          this.$router.push({
            name: "postlist"
          });
        })
        .catch(err => {
          console.log(err.response);
          return err;
        });
    }
  }
};
</script>