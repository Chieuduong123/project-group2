import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import router from "./router";
import CKEditor from "@ckeditor/ckeditor5-vue";
import { Collapse } from "vue-collapsed";
import print from "vue3-print-nb";
import { createPinia } from "pinia";
import Toast from "vue-toastification";
import Antd from "ant-design-vue";
import "ant-design-vue/dist/reset.css";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";
import "@fancyapps/ui/dist/carousel/carousel.css";

createApp(App)
  .use(createPinia())
  .component("Collapse", Collapse)
  .use(print)
  .use(CKEditor)
  .use(router)
  .use(Toast)
  .use(Antd)
  .mount("#app");
