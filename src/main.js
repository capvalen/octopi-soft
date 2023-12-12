import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import VueAxios from 'vue-axios'
import axios from "axios";

const app = createApp(App)
app.config.globalProperties.servidor = 'http://localhost/octopi/api/';

app
.use(VueAxios, axios)
.use(router)
.mount('#app')