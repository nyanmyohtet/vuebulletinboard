<template>
  <v-container>
    <h2>{{ userlisttitle }}</h2>
    <v-form id="form">
      <v-container>
        <v-row>
          <v-col cols="12" sm="6" md="3" lg="2">
            <v-text-field label="Name" v-model="searchName"></v-text-field>
          </v-col>

          <v-col cols="12" sm="6" md="3" lg="2">
            <v-text-field label="Email" v-model="searchMail"></v-text-field>
          </v-col>

          <v-col cols="12" sm="6" md="3" lg="2">
            <v-text-field label="Start Date" type="date" v-model="minDate"></v-text-field>
          </v-col>

          <v-col cols="12" sm="6" md="3" lg="2">
            <!-- <v-text-field label="End Date"></v-text-field> -->
            <v-text-field label="End Date" type="date" v-model="maxDate"></v-text-field>
          </v-col>

          <v-col cols="12" lg="4">
            <v-btn color="primary" class="mr-4" @click="searchFilter">Search</v-btn>
            <!-- <v-btn color="primary" class="mr-4">Add</v-btn> -->
            <router-link to="/vue/createuser" class="btn btn-primary" v-if="userType == 0">Add</router-link>
            {{userType}}
          </v-col>
        </v-row>
      </v-container>
    </v-form>
    <v-data-table :headers="headers" :items="showlist" :items-per-page="5" class="elevation-1">
      <template v-slot:item.name="{ item }">
        <!-- <p>{{item.name}}</p> -->
        <p @click="infoDetail(item)">{{item.name}}</p>
      </template>
      <template v-slot:item.created_at="{ item }">{{ getDate(item.created_at) }}</template>
      <template v-slot:item.updated_at="{ item }">{{ getDate(item.updated_at) }}</template>
      <template v-slot:item.actions="{ item }"  v-if="userType == 0">
        <v-btn small color="primary" @click="deleteConfirm(item.id)">Delete</v-btn>
        <!-- <v-btn small color="primary" @click="deleteuser(item.id)">Delete</v-btn> -->
      </template>
    </v-data-table>
    <v-dialog v-model="deleteDialog" max-width="290">
      <v-card>
        <v-card-title class="headline">Do you want to delete sure?</v-card-title>

        <v-card-text>User ID: {{deleteID}}</v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <!-- <p>{{deleteID}}</p> -->
          <v-btn color="primary darken-1" text @click="deleteDialog = false">Close</v-btn>
          <v-btn color="primary" text @click="deleteuser(deleteID)">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="detailDialog" max-width="500">
      <v-card>
        <v-card-title class="headline">User Detail Information</v-card-title>

        <v-card-text>User id:{{detailItem.id}}</v-card-text>
        <v-card-text>User Name:{{detailItem.name}}</v-card-text>
        <v-card-text>User Email:{{detailItem.email}}</v-card-text>
        <v-card-text>User Type:{{detailItem.type}}</v-card-text>
        <v-card-text>User Phone:{{detailItem.phone}}</v-card-text>
        <v-card-text>User Birth Date:{{detailItem.dob}}</v-card-text>
        <v-card-text>User Address:{{detailItem.address}}</v-card-text>
        <v-card-text>Created User Name:{{detailItem.users.name}}</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary darken-1" text @click="detailDialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-container>
</template>
<script src="../../services/user/userlist.js"></script>