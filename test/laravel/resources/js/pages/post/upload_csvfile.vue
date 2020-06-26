<template>
  <v-container>
    <h2>Upload CSV File</h2>
    <v-form v-on:submit.prevent="fileupload">
      <div class="col-sm-10 mx-auto">
        Import File Form:
        <div class="col-sm-10 border">
          <div class="text-danger">{{error}}</div>
          <div class="form-group row mt-5 ml-auto">
            <!-- <input type="file" name="import_file" class="col-md-6 col-sm-10" /> -->
            <!-- <input
              class="input"
              type="text"
              name="name"
              placeholder="File name"
              v-model="fileName"
              required
            />-->
            <input class="file-input" type="file" ref="file" name="import_file" />
          </div>
          <div class="form-group row ml-auto">
            <div class="align-self-center mx-auto col-md-4 col-sm-8">
              <button type="submit" class="btn btn-primary">Import File</button>
            </div>
          </div>
        </div>
      </div>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      error:"",
    };
  },
  methods: {
    fileupload() {
      this.formData = new FormData();
      this.formData.append("import_file", this.$refs.file.files[0]);

      axios
        .post("auth/import", this.formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        })
        .then(response => {
          console.log(response);
          this.$router.push({name:"postlist"})
        })
        .catch(err => {
          console.log(err.response);
          this.error ="Post has been upload. The input data duplicate. Please upload again"
        });
    }
  }
};
</script>