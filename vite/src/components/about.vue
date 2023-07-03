<template>
  <div v-if="loaded" class="container relative mx-auto">
    <div class="py-12 lg:py-24 pb-0 reverse">
      <div
        class="flex flex-wrap w-full mb-24"
        v-for="item in page.sekcje"
        :key="item"
      >
        <div class="w-full lg:w-1/12"></div>
        <div class="w-full lg:w-6/12 lg:pr-28 sfl">
          <h2
            class="text-4xl font-semibold lg:text-46"
            v-html="item.naglowek"
          ></h2>
          <div
            class="mt-12 text-xl leading-normal text"
            v-html="item.tekst"
          ></div>
          <a
            data-aos="fade-up"
            data-aos-delay="550"
            :href="item.button_link"
            class="inline-block mt-2 btn2"
            >{{ item.button }}</a
          >
        </div>
        <div class="w-full lg:w-5/12 pt-8">
          <img :src="item.zdjecie" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      page: [],
      loaded: false,
    };
  },
  props: ["id"],

  computed: {},
  components: {},
  beforeMount() {
    fetch("/wp-json/acf/v3/pages/" + this.id)
      .then((res) => res.json())
      .then((res) => {
        console.log(res.acf);
        this.page = res.acf;
        this.loaded = true;
      });
  },
};
</script>