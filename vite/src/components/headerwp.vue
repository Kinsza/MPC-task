<template>
  <Slide
    :closeOnNavigation="true"
    :isOpen="isOpen"
    @closeMenu="isOpen = false"
    noOverlay
    :burgerIcon="false"
    class="block lg:hidden"
  >
    <ul class="flex-col w-full p-0 m-0 cd-accordion-menu">
      <template v-for="item in menu" :key="item">
        <itemDesktop class="text-lg" :item="item"></itemDesktop>
      </template>
    </ul>
  </Slide>
  <header class="w-full pb-3">
    <div class="container relative py-4 mx-auto">
      <div class="flex flex-wrap items-center justify-between mt-4">
        <a href="/" class="w-64 mt-3">
          <img alt :src="options.logo" />
        </a>

        <nav class="items-center hidden ml-auto text-lg font-medium lg:flex">
          <template v-for="item in menu" :key="item">
            <itemDesktop class="ml-16" :item="item"></itemDesktop>
          </template>
        </nav>

        <button class="text-black lg:hidden" @click="isOpen = true">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-12 h-12"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              fill-rule="evenodd"
              d="M0 7.897C0 7.402.402 7 .897 7h22.206a.897.897 0 010 1.794H.897A.897.897 0 010 7.897zM0 16.196c0-.495.402-.897.897-.897h14.58a.897.897 0 010 1.794H.897A.897.897 0 010 16.197z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
      </div>
    </div>
  </header>
  <div class="absolute w-full h-44 bg"></div>
</template>

<script >
import { Slide } from "vue3-burger-menu"; // import the CSS transitions you wish to use, in this case we are using `Slide`
import item from "./menu.vue";
import itemDesktop from "./menuDesktop.vue";
var treeData = {
  name: "Item2",
  name: "Group",
  children: [
    {
      name: "Sub Group",
      children: [
        {
          name: "Item",
        },
        {
          name: "Item",
        },
      ],
    },
    {
      name: "Item",
    },
  ],
};

export default {
  props: ["options", "user"],
  data() {
    return {
      treeData: treeData,
      isOpen: false,
      menu: [],
    };
  },
  components: {
    Slide, // Register your component
    item: item,
    itemDesktop,
  },
  beforeMount() {
    fetch("/wp-json/myroutes/menu")
      .then((res) => res.json())
      .then((res) => {
        this.menu = res;
      });
  },
};
</script>