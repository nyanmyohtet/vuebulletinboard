<template>
  <v-app>
    <v-card color="lighten-4" flat tile>
      <v-toolbar dark color="primary" tile>
        <v-container>
          <v-row>
            <v-toolbar-title class="title">
              <span>{{title}}</span>
            </v-toolbar-title>
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="collapse navbar-collapse">
                <div class="navbar-nav" v-if="isLoggedIn">
                  <router-link to="/vue/userprofile" class="nav-item nav-link route-link">Profile</router-link>
                  <router-link to="/vue/userlist" class="nav-item nav-link route-link">Users</router-link>
                  <router-link to="/vue/postlist" class="nav-item nav-link route-link">Post</router-link>
                </div>
              </div>
            </nav>
            <v-spacer></v-spacer>
            <div class="route-links">
              <router-link class="route-link" :to="{ name: 'login'}" v-if="!isLoggedIn">Login</router-link>
              <v-btn color="primary" v-if="isLoggedIn" @click="logout">Logout</v-btn>
            </div>
          </v-row>
        </v-container>
      </v-toolbar>
      <v-container>
        <router-view></router-view>
      </v-container>
    </v-card>
  </v-app>
</template>

<script src="../services/components/layout.js">
</script>
<style scoped>
@import "../../css/components/layout.css";
</style>
