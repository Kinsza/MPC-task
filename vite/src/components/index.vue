<template class="">
  <div class="py-12 lg:py-24 pb-14">
    <div v-if="loaded" class="container relative mx-auto"></div>
  </div>
</template> 


<script>
//import opinie from "./opinie.vue";

//https://splidejs.com/guides/options/
export default {
  data() {
    return {
      page: [],
      loaded: false,
    };
  },

  components: {},
  props: ["settings", "id"],
  beforeMount() {
    fetch("/wp-json/acf/v3/pages/" + this.id)
      .then((res) => res.json())
      .then((res) => {
        this.page = res.acf;
        this.loaded = true;
      });
  },
};
</script>