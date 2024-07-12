import { createApp } from "vue";
import App from "@/App.vue";

const app = createApp(App);

// notification
import Notifications from "@kyvg/vue3-notification";
app.use(Notifications);

// select color
import VSwatches from "vue3-swatches";
import "vue3-swatches/dist/style.css";
app.use(VSwatches);

// vue datepicker
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
app.component("VueDatePicker", VueDatePicker);

// pinia store
import { createPinia } from "pinia";
const pinia = createPinia();
app.use(pinia);

import router from "@/router";
app.use(router);

// main app css
import "@/assets/css/app.css";

// perfect scrollbar
import PerfectScrollbar from "vue3-perfect-scrollbar";
app.use(PerfectScrollbar);

//vue-meta
import { createHead } from "@vueuse/head";
const head = createHead();
app.use(head);

// set default settings
import appSetting from "@/app-setting";
appSetting.init();

//vue-i18n
import i18n from "@/i18n";
app.use(i18n);

// popper
import Popper from "vue3-popper";
app.component("Popper", Popper);

app.mount("#app");
