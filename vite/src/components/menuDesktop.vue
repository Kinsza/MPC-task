<template>
  <a
    v-if="item.type == 'custom'"
    class="text-gray-100 hover:text-primary-100 group"
    :href="item.url"
    target="blank"
    >{{ item.title }}</a
  >
  <a
    v-else
    :class="item.classes"
    class="text-gray-100 hover:text-primary-100 group"
    :href="isEl"
  >
    {{ item.title }}</a
  >
</template>

 <script>
export default {
  props: ["item"],
  data() {
    return {};
  },
  computed: {
    isEl: function () {
      if (this.item.url) {
        if (this.item.url == "/") return this.item.url;
        else if (this.item.url !== "#")
          return "" + this.item.url.replace(/.*\/\/[^\/]*/, "");
        else return { path: "/", hash: "#" + this.item.title };
      } else {
        if (this.item.el._link == "page") return this.item.el.title_slug;
        else return "/" + this.item.el._link + "/" + this.item.el.title_slug;
      }
    },
  },
  components: {},
};
</script>