<template lang="">
	<div class="offcanvas offcanvas-end" tabindex="-1" id="offNuevoCliente" aria-labelledby="offcanvasExampleLabel">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title" id="offcanvasExampleLabel">Nuevo cliente</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<div>
				Rellene los datos para crear un nuevo cliente
			</div>
			<label for="">Apellidos</label>
			<input type="text" v-model="cliente.apellidos" class="form-control">
			<label for="">Nombres</label>
			<input type="text" v-model="cliente.nombres" class="form-control">
			<label for="">D.N.I.</label>
			<input type="text" v-model="cliente.dni" class="form-control">
			<label for="">Celular</label>
			<input type="text" v-model="cliente.celular" class="form-control">
			<label for="">Sexo</label>
			<select name="sltSexo" id="sltSexo" class="form-select">
				<option value="2">Sin especificar</option>
				<option value="0">Femenino</option>
				<option value="1">Masculino</option>
			</select>
			<label for="">Fecha de nacimiento</label>
			<input type="date" v-model="cliente.fechaNacimiento" class="form-control">
			<button type="button" class="btn btn-outline-primary mt-2" v-if="cliente.id==-1" @click="registrar()"><i class="bi bi-person-add"></i> Registrar cliente</button>
			<button type="button" class="btn btn-outline-success mt-2" v-else @click="actualizar()"><i class="bi bi-arrow-clockwise"></i> Actualizar cliente</button>

		</div>
	</div>
		
</template>
<script>
export default {
	data() {
		return {
			cliente:{ id:-1,
				nombres:'', apellidos:'', dni:'', celular:'', sexo:2, fechaNacimiento: null
			}
		}
	},
	props:['clienteEditar'],
	methods: {
		registrar(){
			const datos = new FormData()
			datos.append('pedir', 'registrar')
			datos.append('cliente', JSON.stringify(this.cliente))
			this.axios.post(this.servidor+'Clientes.php', datos )
			.then(resp => {
				console.log(resp.data)
				const closeButton = document.querySelector('#offNuevoCliente .btn-close');
				closeButton.click();
				this.$emit('actualizarLista')
			})
		},
		actualizar(){
			const datos = new FormData()
			datos.append('pedir', 'actualizar')
			datos.append('cliente', JSON.stringify(this.cliente))
			this.axios.post(this.servidor+'Clientes.php', datos )
			.then(resp => {
				console.log(resp.data)
				const closeButton = document.querySelector('#offNuevoCliente .btn-close');
				closeButton.click();
				this.$emit('actualizarLista')
			})
		},
	},
	watch:{
		'clienteEditar'(newValue){ 
			this.cliente.id = newValue.id
			this.cliente.nombres = newValue.nombres
			this.cliente.apellidos = newValue.apellidos
			this.cliente.dni = newValue.dni
			this.cliente.celular = newValue.celular
			this.cliente.sexo = newValue.sexo
			this.cliente.fechaNacimiento = newValue.fechaNacimiento
		}
	}
}
</script>
<style scoped>
	label{ margin-top:5px;}
</style>