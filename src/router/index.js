import { createRouter, createWebHistory } from 'vue-router'
//import HomeView from '../views/HomeView.vue'
import HomeView from '../components/Plantillas/Bienvenido.vue'
import RecetaLentes from '../components/Clientes/RecetaLentes.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/clientes',
    name: 'clientes',
    component: () => import(/* webpackChunkName: "about" */ '../components/Clientes/HomeClientes.vue'),
  },
	{
		path: '/clientes/receta-lentes/:idCliente',
		name:'recetaLentes',
		component: RecetaLentes
	},
	{
		path: '/receta/pdf/',
		name:'recetaPDF',
		component: () => import( '../components/Recetas/PDF.vue'),
	}
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
