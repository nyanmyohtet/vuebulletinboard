<template>
  <v-select :items="items" label="Choose Type" dense></v-select>
</template>

<script>
export default {
  data: () => ({
    items: ["Admin", "User"]
  }), 
};
</script>