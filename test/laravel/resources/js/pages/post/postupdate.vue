<template>
  <v-container>
    <h2>Update Post</h2>
    <v-form class="form-wd" v-on:submit.prevent="editpost(id)" id="form">
      <v-container>
        <v-row>
          <v-col cols="4">
            <v-subheader>Title</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field name="title" v-model="title"></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="4">
            <v-subheader>Description</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-text-field name="description" v-model="description"></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="4">
            <v-subheader>Status</v-subheader>
          </v-col>
          <v-col cols="8">
            <v-switch v-model="status" name="status" :true-value="1" :false-value="0"></v-switch>
            <!-- <v-text-field name="status" v-model="status" :true-value="1" :false-value="0" ></v-text-field> -->
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" class="text-center">
            <v-btn color="primary" type="submit">Confirm</v-btn>
            <v-btn color="light">Cancel</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-container>
</template>

<script>
export default {
  props: ["id", "description", "title","status"],
  data() {
    return {
      // switch1:true,
    };
  },
  methods: {
    editpost(id) {
      var form = document.getElementById("form");
      var formData = new FormData(form);
      axios
        .post("/auth/editpost/" + id, formData)
        .then(response => {
          console.log(response);
          this.$router.push({
            name: "postupdateconfirm",
            params: {
              id: this.id,
              title: this.title,
              description: this.description,
              status: this.status
            }
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
<style scoped>
.form-wd {
  max-width: 960px;
  width: 100%;
  margin: 0 auto;
}
</style>