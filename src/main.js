import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import VueAxios from 'vue-axios'
import axios from "axios";
import jQuery from "jquery";

const app = createApp(App)
app.config.globalProperties.servidor = 'http://localhost/vegavision/api/';

app
.use(VueAxios, axios)
.use(jQuery)
.use(router)
.mount('#app')