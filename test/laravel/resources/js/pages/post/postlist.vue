<template>
  <v-container>
    <h2>Post List</h2>
    <v-form id="form">
      <v-container>
        <v-row>
          <v-col cols="12" sm="6" md="3" lg="4">
            <v-text-field label="Search" v-model="searchTitle"></v-text-field>
          </v-col>

          <v-col cols="12" sm="6" md="3" lg="2">
            <v-btn color="primary" class="mr-4" @click="searchFilter">Search</v-btn>
          </v-col>

          <v-col cols="12" sm="6" md="3" lg="2">
            <router-link to="/vue/createpost" class="btn btn-primary link-btn">Add</router-link>
          </v-col>

          <v-col cols="12" sm="6" md="3" lg="2">
            <router-link to="/vue/uploadfile" class="btn btn-primary link-btn">Upload</router-link>
          </v-col>

          <v-col cols="12" sm="6" md="3" lg="2">
            <!-- <router-link to="/vue/createuser" class="btn btn-primary link-btn">Download</router-link> -->
            <v-btn color="primary" class="mr-4" @click="downloadPost">Download</v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
    <v-data-table :headers="headers" :items="showlist" :items-per-page="5" class="elevation-1">
      <template v-slot:item.created_at="{ item }">{{ getDate(item.created_at) }}</template>
      <template v-slot:item.actions="{ item }">
        <!-- <v-btn small color="primary" class="mr-4">Edit</v-btn> -->
        <router-link class="route-link btn btn-primary" :to="{ name: 'postupdate', params: { id: item.id, title:item.title,description:item.description,status:item.status }}">Edit</router-link>
        <v-btn small color="red" @click="deleteConfirm(item.id)">Delete</v-btn>
      </template>
    </v-data-table>
    <v-dialog v-model="deleteDialog" max-width="290">
      <v-card>
        <v-card-title class="headline">Do you want to delete sure?</v-card-title>

        <v-card-text>Post ID: {{deleteID}}</v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary darken-1" text @click="deleteDialog = false">Close</v-btn>
          <v-btn color="primary" text @click="deletepost(deleteID)">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      searchTitle: "",
      headers: [
        { text: "Post Title", value: "title" },
        { text: "Post Description", value: "description" },
        { text: "Posted user", value: "users.name" },
        { text: "Posted Date", value: "created_at", sortable: false },
        { text: "Action", value: "actions", sortable: false }
      ],
      postlist: [],
      showlist: [],
      deleteDialog: false,
      deleteID: null
    };
  },
  async mounted() {
    const postInfo = await axios
      .get("/auth/postlist")
      .then(response => {
        // console.log(response);
        return response.data;
      })
      .catch(err => {
        console.log(err);
        return err;
      });
    this.postlist = postInfo;
    this.showlist = this.postlist;

    // console.log(userInfo);
  },
  methods: {
    getDate(datetime) {
      let date = new Date(datetime)
        .toJSON()
        .slice(0, 10)
        .replace(/-/g, "/");
      return date;
    },
    searchFilter() {
      this.showlist = this.postlist.filter(this.checkTitle);
    },
    checkTitle(post) {
      let var1 =
        post.title.toLowerCase().includes(this.searchTitle.toLowerCase()) ||
        post.description.toLowerCase().includes(this.searchTitle.toLowerCase());
      return var1;
    },
    deleteConfirm(id) {
      this.deleteDialog = true;
      this.deleteID = id;
    },
    deletepost(id) {
      axios
        .delete("/auth/deletepost/" + id)
        .then(response => {
          console.log(response);
          this.postlist.splice(this.postlist.indexOf(id), 1);
          this.deleteDialog = false;
        })
        .catch(err => {
          console.log(err.response);
          return err;
        });
    },
    downloadPost() {
      axios.get("/auth/export")
      .then(response=>{
        console.log(response);
      })
      .catch(err=>{
        console.log(err.response);
      });
    }
  }
};
</script>
<style scoped>
.link-btn {
  color: #fff;
}
</style>