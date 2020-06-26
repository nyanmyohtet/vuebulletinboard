<template>
  <div id="app">
    <!-- <img alt="Vue logo" src="./assets/logo.png"> -->
    <childComponent v-bind:artists="artistoppo"/>
  </div>
</template>
<script>
import childComponent from './childComponent'
export default {
  name: 'app',
  components: {
    childComponent
  },
  data (){
    return {
      artistoppo: [
       {name: 'Davido', genre: 'afrobeats', country: 'Nigeria'},
       {name: 'Burna Boy', genre: 'afrobeats', country: 'Nigeria'},
       {name: 'AKA', genre: 'hiphop', country: 'South-Africa'},
       {name: 'Sarkodie', genre: 'hiphop', country: 'Ghana'},
       {name: 'Stormzy', genre: 'hiphop', country: 'United Kingdom'},
       {name: 'Lil Nas', genre: 'Country', country: 'United States'},
       {name: 'Nasty C', genre: 'hiphop', country: 'South-Africa'},
       {name: 'Shatta-walle', genre: 'Reagae', country: 'Ghana'},
       {name: 'Khalid', genre: 'pop', country: 'United States'},
       {name: 'Ed Sheeran', genre: 'pop', country: 'United Kingdom'}
      ]
    }
  }
}
</script>