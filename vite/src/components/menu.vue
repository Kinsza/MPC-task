<template>
  <li :class="[isFolder ? 'folder' : 'file']" class="w-full text-base">
    <label
      :class="{ open: open }"
      @click="toggle"
      @dblclick="changeType"
      class="flex items-center"
    >
      <svg
        v-if="isFolder"
        class="w-3 h-3 mt-1 mr-3 transition-all duration-200 transform"
        :class="{ 'rotate-90': open }"
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        viewBox="0 0 24 24"
      >
        <path
          fill-rule="evenodd"
          d="M4.514.723a2.1 2.1 0 00.209 2.963L14.297 12l-9.574 8.314a2.1 2.1 0 102.754 3.171L20.703 12 7.477.514a2.1 2.1 0 00-2.963.21z"
          clip-rule="evenodd"
        />
      </svg>
      {{ model.name }}
    </label>
    <ul v-show="open" v-if="isFolder" :class="{ open: open }">
      <item
        v-for="(model, index) in model.children"
        :key="index"
        :model="model"
      >
      </item>
    </ul>
  </li>
</template>


<script>
import item from "./menu.vue";

export default {
  name: "item",
  components: {},
  props: {
    model: Object,
  },
  data: function () {
    return {
      open: false,
    };
  },

  computed: {
    isFolder: function () {
      return this.model.children && this.model.children.length;
    },
  },

  methods: {
    toggle: function () {
      if (this.isFolder) {
        this.open = !this.open;
      }
    },
    changeType: function () {
      if (!this.isFolder) {
        Vue.set(this.model, "children", []);
        this.addChild();
        this.open = true;
      }
    },
    addChild: function () {
      this.model.children.push({
        name: "New Item",
      });
    },
  },
};
</script>

<style>
.cd-accordion-menu {
  width: 90%;
  max-width: 600px;
  margin: 4em auto;
  @apply bg-black bg-opacity-25;
  box-shadow: 0 4px 6px 0 rgba(0, 0, 0, 0.3);
}

.cd-accordion-menu li {
  user-select: none;
}

.cd-accordion-menu li span {
  float: right;
}

.cd-accordion-menu label,
.cd-accordion-menu a {
  position: relative;
  display: block;
  padding: 18px 18px 18px 18px;
  box-shadow: inset 0 -1px rgba(0, 0, 0, 02);
  color: #ffffff;
}

.no-touch .cd-accordion-menu label:hover,
.no-touch .cd-accordion-menu a:hover {
  background: #52565d;
}

.cd-accordion-menu label::before,
.cd-accordion-menu label::after,
.cd-accordion-menu a::after {
  /* icons */
  content: "";
  display: inline-block;
  width: 16px;
  height: 16px;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
}

.cd-accordion-menu label {
  cursor: pointer;
}

.cd-accordion-menu label span {
  float: right;
  color: #828282;
}

.cd-accordion-menu li.file > label::before {
}

.cd-accordion-menu li.folder > label::before {
}

.cd-accordion-menu li.file > label::before {
}

.cd-accordion-menu li.add > label::before {
  content: "\f067";
}

.cd-accordion-menu label::before {
  /* arrow icon */
  font: normal normal normal 14px/1 FontAwesome;
  left: 18px;
  transform: translateY(-50%);
  transition: transform 0.3s;
}

.cd-accordion-menu label.open::before {
  transform: translateY(-25%) rotate(90deg);
}

.cd-accordion-menu ul label,
.cd-accordion-menu ul a {
  background: #000;
  box-shadow: inset 0 -1px #141617;
  padding-left: 35px;
}

.no-touch .cd-accordion-menu ul label:hover,
.no-touch .cd-accordion-menu ul a:hover {
  background: #3c3f45;
}

.cd-accordion-menu > li:last-of-type > label,
.cd-accordion-menu > li:last-of-type > a,
.cd-accordion-menu > li > ul > li:last-of-type label,
.cd-accordion-menu > li > ul > li:last-of-type a {
  box-shadow: none;
}

.cd-accordion-menu ul label::before {
  left: 36px;
}

.cd-accordion-menu ul label::after,
.cd-accordion-menu ul a::after {
  left: 59px;
}

.cd-accordion-menu ul ul label,
.cd-accordion-menu ul ul a {
  padding-left: 50px;
}

.cd-accordion-menu ul ul label::before {
  left: 54px;
}

.cd-accordion-menu ul ul label::after,
.cd-accordion-menu ul ul a::after {
  left: 77px;
}

.cd-accordion-menu ul ul ul label,
.cd-accordion-menu ul ul ul a {
  padding-left: 118px;
}

.cd-accordion-menu ul ul ul label::before {
  left: 72px;
}

.cd-accordion-menu ul ul ul label::after,
.cd-accordion-menu ul ul ul a::after {
  left: 95px;
}
.bm-item-list {
  @apply ml-0 !important;
}
.bm-menu {
  @apply bg-primary-200;
}
.bm-burger-button {
  @apply relative left-auto top-auto !important;
}

.bm-menu a {
  @apply text-white !important;
}
</style>