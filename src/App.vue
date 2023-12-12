<template>
  <!-- <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
  </nav>
  <router-view/> -->
	<MenuIzquierda></MenuIzquierda>

</template>
<script>

import MenuIzquierda from './components/Plantillas/MenuIzquierda.vue'

export default {
	components: {MenuIzquierda},
	mounted() {
		//console.log(process.env.VUE_APP_SERVIDOR)
	},
};
</script>