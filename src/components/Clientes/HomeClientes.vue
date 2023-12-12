<template lang="">
	<div>
		<h1>Clientes</h1>
		<div class="row g-3 align-items-center">
			<div class="col-6 mb-3 ">
				<label for="exampleFormControlInput1" class="form-label"><i class="bi bi-funnel"></i> Filtro</label>
				<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Buscar por DNI, Nombre, celular" v-model="texto" @keyup.enter="buscar()">
			</div>
			<div class="col-auto ">
				<button class="btn btn-outline-primary mt-3" @click="buscar()"><i class="bi bi-search"></i> Buscar</button>
				<button class="btn btn-outline-success mt-3 ms-2" data-bs-toggle="offcanvas" href="#offNuevoCliente" @click="cliente=[]"><i class="bi bi-plus-circle"></i> Nuevo Cliente</button>
			</div>
		</div>
		<p v-show="texto==''" class="text-muted">Últimos 30 clientes registrados:</p>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>N°</th>
					<th>Apellidos y nombres</th>
					<th>DNI</th>
					<th>Celular</th>
					<th>Dirección</th>
					<th>@</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(cliente, index) in clientes" :key="cliente.id">
					<td>{{ index+1 }}</td>
					<td class="text-capitalize">{{cliente.apellidos}} {{ cliente.nombres }} </td>
					<td>{{cliente.dni}} </td>
					<td>{{cliente.celular}} </td>
					<td>{{cliente.direccion}} </td>
					<td class="d-grid d-md-block">
						<button class="btn btn-sm btn-outline-secondary mx-1" title="Registrar medidas" @click="irAReceta(cliente.id)"><i class="bi bi-eyeglasses"></i></button>
						<button class="btn btn-sm btn-outline-primary mx-1" data-bs-toggle="offcanvas" href="#offNuevoCliente" @click="editarCliente(cliente)"><i class="bi bi-feather"></i></button>
						<button class="btn btn-sm btn-outline-danger mx-1" @click="eliminarCliente(cliente.id)"><i class="bi bi-trash2"></i></button>
					</td>
				</tr>
			</tbody>
		</table>
		<p v-if="clientes.length==0">No hay clientes registrados aún</p>
	</div>
	<offNuevoCliente @actualizarLista="actualizarLista()" :clienteEditar="cliente"></offNuevoCliente>
</template>
<script >
import offNuevoCliente from './NuevoCliente.vue'
export default {
	name: 'Clientes',
	data() {
		return {
			texto:'', clientes:[], cliente:[]
		}
	},
	components: {
		offNuevoCliente,
	},
	methods: {
		actualizarLista(){ this.cargarDatos(); },
		buscar(){
			if(this.texto=='') this.cargarDatos()
			else{
				let datos = new FormData();
				datos.append('pedir', 'buscar')
				datos.append('texto', this.texto)
				this.axios.post(this.servidor +'Clientes.php', datos)
				.then((response) => {
					this.clientes = response.data;
				});
			}
		},
		cargarDatos(){
			let datos = new FormData();
			datos.append('pedir', 'listar')
			this.axios.post(this.servidor +'Clientes.php', datos)
			.then((response) => {
				this.clientes = response.data;
			});
		},
		editarCliente(cliente){
			this.cliente = cliente
		},
		eliminarCliente(id){
			if(confirm('¿Deseas borrar al cliente?')){
				let datos = new FormData()
				datos.append('pedir', 'eliminar')
				datos.append('id', id)
				this.axios.post(this.servidor+ 'Clientes.php', datos)
				.then(()=> this.actualizarLista() )
			}
		},
		irAReceta(id){ this.$router.push({ name: 'recetaLentes', params: { idCliente:id } }); }
	},
	mounted(){
		this.cargarDatos()
	}
}
</script>
<style lang="">
	
</style>