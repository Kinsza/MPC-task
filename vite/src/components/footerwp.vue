<template>
  <footer class="relative pt-24 text-black bg-white footer">
    <div
      class="absolute top-0 w-full transform rotate-180 -translate-y-full pointer-events-none  h-44 bg2"
    ></div>
    <div class="container relative mx-auto">
      <div class="flex flex-wrap">
        <div class="w-full lg:w-6/12 lg:pr-28">
          <router-link to="/" class="w-64 mt-3">
            <img alt :src="options.logo" />
          </router-link>
          <div class="leading-normal text-gray-100 mt-14">
            {{ options.st }}
          </div>
        </div>
        <div class="w-full pt-6 lg:w-4/12">
          <h3 class="mb-6 text-xl font-semibold text-gray-100">Menu</h3>
          <nav
            class="flex-wrap items-center hidden ml-auto text-xl font-medium  lg:flex navfooter"
          >
            <template v-for="item in menu" :key="item">
              <itemDesktop class="" :item="item"></itemDesktop>
            </template>
          </nav>
        </div>
        <div class="w-full pt-6 lg:w-2/12">
          <h3 class="mb-6 text-xl font-semibold text-gray-100">Kontakt</h3>
          <div
            class="font-normal leading-tight text-gray-100 whitespace-pre-line  kk"
            v-html="options.adres"
          ></div>
          <a :href="'tel:' + options.tel" class="block mt-2 text-gray-100">
            tel. {{ options.tel }}
          </a>
          <a :href="'mailto:' + options.email" class="block mt-2 text-gray-100">
            {{ options.email }}
          </a>
        </div>
      </div>

      <div
        class="flex flex-wrap justify-between py-6 pb-12 mt-20 text-sm text-gray-200 border-t border-gray-200 "
      >
        <div class="">
          © {{ new Date().getFullYear() }} StanislawRaczynski / Projekt:
          <a href="https://cherryberry.pl/">CherryBerry</a>, wdrożenie:
          <a href="https://miyostudio.pl/">MiyoStudio</a>
        </div>
        <nav
          class="flex-wrap items-center hidden ml-auto text-sm font-medium  lg:flex"
        >
          <template v-for="item in menu2" :key="item">
            <itemDesktop class="ml-10" :item="item"></itemDesktop>
          </template>
        </nav>
      </div>
    </div>
  </footer>
</template>

<script>
import item from "./menu.vue";
import itemDesktop from "./menuDesktop.vue";
export default {
  props: ["options", "settings"],
  data() {
    return {
      menu: [],
      menu2: [],
    };
  },
  components: {
    item: item,
    itemDesktop,
  },
  beforeMount() {
    fetch("/wp-json/myroutes/menu")
      .then((res) => res.json())
      .then((res) => {
        this.menu = res;
        fetch("/wp-json/myroutes/menustopka")
          .then((res) => res.json())
          .then((res) => {
            this.menu2 = res;
          });
      });
  },
};
</script>

<style>
footer nav .group {
  @apply font-normal  !important;
}
footer .navfooter a {
  @apply lg:w-1/2 mb-3 text-base ml-0 !important;
}
footer a {
  @apply hover:text-primary-100 !important;
}
</style>