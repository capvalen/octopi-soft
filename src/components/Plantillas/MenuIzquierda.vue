
<template lang="es">
	<main class="d-flex flex-nowrap">
		<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary" style="width: 280px;">
			<a href="/" class=" mb-3 mb-md-0  link-body-emphasis text-decoration-none">
				<img src="@/assets/logo.jpg" class="img-fluid">
				<p class="text-center"><span class="fs-4">Octopi Softw.</span></p>
			</a>
			<hr>
			<ul class="nav nav-pills flex-column mb-auto">
				<li class="nav-item">
					<router-link class="nav-link" to="/" :class="{ active: $route.path === '/', 'link-body-emphasis': $route.path !== '/'}"><i class="bi bi-house"></i> Inicio</router-link>
				</li>
				<li class="nav-item">
						<router-link class="nav-link" to="/clientes" :class="{ active: $route.path === '/clientes', 'link-body-emphasis': $route.path !== '/clientes'}"><i class="bi bi-person"></i> Clientes</router-link>
				</li>
				<li class="nav-item">
					<router-link class="nav-link" to="/pedidos" :class="{ active: $route.path === '/pedidos', 'link-body-emphasis': $route.path !== '/pedidos'}"><i class="bi bi-bag-check"></i> Pedidos</router-link>
				</li>
				<li class="nav-item">
					<router-link class="nav-link" to="/productos" :class="{ active: $route.path === '/productos', 'link-body-emphasis': $route.path !== '/productos'}"><i class="bi bi-box"></i> Productos</router-link>
				</li>
				<li class="nav-item">
					<router-link class="nav-link" to="/configuraciones" :class="{ active: $route.path === '/configuraciones', 'link-body-emphasis': $route.path !== '/configuraciones'}"><i class="bi bi-gear-fill"></i> Configuraciones</router-link>
				</li>
			</ul>
			<hr>
			<div class="dropdown">
				<a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
					<img src="https://avatars.githubusercontent.com/u/12069172?v=4" alt="" width="32" height="32" class="rounded-circle me-2">
					<strong>Sistema administrador</strong>
				</a>
				<ul class="dropdown-menu text-small shadow">
					<li><a class="dropdown-item" href="#">Cambiar contraseña</a></li>
					<li><a class="dropdown-item" href="#">Perfil</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="#">Salir del sistema</a></li>
				</ul>
			</div>
		</div>
		<div class="b-example-divider b-example-vr"></div>
		<section id="routerview" class="container-fluid p-4">
			<router-view />
		</section>
	</main>
</template>
<script>
export default {
	name: 'MenuIzquierda'
	
}
</script>
<style>
.bd-placeholder-img {
		font-size: 1.125rem;
		text-anchor: middle;
		-webkit-user-select: none;
		-moz-user-select: none;
		user-select: none;
	}

	@media (min-width: 768px) {
		.bd-placeholder-img-lg {
			font-size: 3.5rem;
		}
	}

	.b-example-divider {
		width: 100%;
		height: 3rem;
		background-color: rgba(0, 0, 0, .1);
		border: solid rgba(0, 0, 0, .15);
		border-width: 1px 0;
		box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
	}

	.b-example-vr {
		flex-shrink: 0;
		width: 1.5rem;
		height: 100vh;
	}

	.bi {
		vertical-align: -.125em;
		fill: currentColor;
	}

	.nav-scroller {
		position: relative;
		z-index: 2;
		height: 2.75rem;
		overflow-y: hidden;
	}

	.nav-scroller .nav {
		display: flex;
		flex-wrap: nowrap;
		padding-bottom: 1rem;
		margin-top: -1px;
		overflow-x: auto;
		text-align: center;
		white-space: nowrap;
		-webkit-overflow-scrolling: touch;
	}

	.btn-bd-primary {
		--bd-violet-bg: #712cf9;
		--bd-violet-rgb: 112.520718, 44.062154, 249.437846;

		--bs-btn-font-weight: 600;
		--bs-btn-color: var(--bs-white);
		--bs-btn-bg: var(--bd-violet-bg);
		--bs-btn-border-color: var(--bd-violet-bg);
		--bs-btn-hover-color: var(--bs-white);
		--bs-btn-hover-bg: #6528e0;
		--bs-btn-hover-border-color: #6528e0;
		--bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
		--bs-btn-active-color: var(--bs-btn-hover-color);
		--bs-btn-active-bg: #5a23c8;
		--bs-btn-active-border-color: #5a23c8;
	}

	.bd-mode-toggle {
		z-index: 1500;
	}

	.bd-mode-toggle .dropdown-menu .active .bi {
		display: block !important;
	}
</style>