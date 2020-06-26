<template>
  <v-container>
    <h2>Create Post</h2>
    <v-form class="form-wd" v-on:submit.prevent="createpost">
      <v-container>
        <v-row>
          <v-col cols="12">
            <v-text-field label="Enter title" v-model="postdata.title" :rules="titleRules" :error-messages="messages.title"></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-text-field
              label="Enter description"
              v-model="postdata.description"
              :rules="descRules"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" class="text-center">
            <v-btn color="primary" type="submit" class="mr-4">Create</v-btn>
            <v-btn color="light" type="reset" @click="resetForm()">Cancel</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      postdata: {
        title: "",
        description: ""
      },
      valid: true,
      title: "",
      description: "",
      messages: {
        title: []
      },
      
      // error:"",

      // validation rules for post title.
      titleRules: [value => !!value || "The title field is required."],
      // validation rules for post description.
      descRules: [value => !!value || "The description field is required."]
    };
  },
  methods: {
    createpost() {
      var formData = new FormData();
      formData.append("title", this.postdata.title);
      formData.append("description", this.postdata.description);

      axios({
        method: "post",
        url: "/auth/createpostconfirm",
        data: formData,
        config: { headers: { "Content-Type": "multipart/form-data" } }
      })
        .then(response => {
          // console.log(response);
          // this.error = "";
          this.$router.push({
            name: "createpostconfirm",
            params: {
              title: this.postdata.title,
              description: this.postdata.description
            }
          });
        })
        .catch(err => {
          // this.error = err.response.data.errors.message;
          //  console.log(err.response);

          let errors = err.response.data.errors;

          if (errors) {
            for (let field in errors) {
              this.messages[field] = errors[field];
            }
          }
        });
    },
    resetForm() {
        console.log('Reseting the form')
        var self = this; //you need this because *this* will refer to Object.keys below`

        //Iterate through each object field, key is name of the object field`
        Object.keys(this.postdata).forEach(function(key,index) {
          self.postdata[key] = '';
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