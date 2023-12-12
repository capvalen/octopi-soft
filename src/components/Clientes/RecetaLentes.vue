<template>
	<div v-if="cliente.id">
		<h1>Nueva receta de cliente: </h1>
		<p>A continuación puede rellenar o editar los valores para generar una receta</p>
		<div class="card">
			<div class="card-body">
				<h3 class="text-center">Receta de lentes</h3>
				<div class="ms-5">
					<p><strong>Apellidos y nombres: </strong> <span class="text-capitalize">{{cliente.apellidos}} {{ cliente.nombres }}</span></p>
					<p><strong>Edad:</strong> <span>{{edad}} años</span></p>
				</div>
				<table class="table ">
					<tr class="">
						<td class="" colspan="2"></td>
						<td class="text-center fw-bold" colspan="6">Prescripción de lentes</td>
					</tr>
					<tr class="">
						<td class="" colspan="2"></td>
						<td class="text-center fw-bold">Esfera</td>
						<td class="text-center fw-bold">Cilindro</td>
						<td class="text-center fw-bold">Eje</td>
						<td class="text-center fw-bold">AV</td>
						<td class="text-center fw-bold">DIP</td>
						<td class="text-center fw-bold">Prisma</td>
					</tr>
					<tr>
						<td class="fw-bold text-center" rowspan="2">LEJOS</td>
						<td class="fw-bold text-center">OD</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.odEsfera">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.odCilindro">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.odEje">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.odAv">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.odDip">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.odPrisma">
						</td>
					</tr>
					<tr>
						<td class="fw-bold text-center">OI</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.oiEsfera">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.oiCilindro">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.oiEje">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.oiAv">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.oiDip">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="lejos.oiPrisma">
						</td>
					</tr>
					<tr>
						<td class="fw-bold text-center" rowspan="2">CERCA</td>
						<td class="fw-bold text-center">OD</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.odEsfera">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.odCilindro">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.odEje">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.odAv">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.odDip">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.odPrisma">
						</td>
					</tr>
					<tr>
						<td class="fw-bold text-center">OI</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.oiEsfera">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.oiCilindro">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.oiEje">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.oiAv">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.oiDip">
						</td>
						<td>
							<input class="form-control text-center w-75 mx-auto my-1" type="text" v-model="cerca.oiPrisma">
						</td>
					</tr>
				</table>
				<div class="ms-5 w-75">
					<label class="mb-3"><strong>Diagnóstico</strong></label>
					<textarea class="form-control" id="" cols="30" rows="4" v-model="diagnostico"></textarea>
				</div>
			</div>
		</div>
		<div class="my-4">
			<button class="btn btn-outline-primary" @click="crearReceta()"><i class="bi bi-send-plus"></i> Registrar receta de lentes</button>
		</div>

	</div>
	<div v-else>
		<h1>Receta de cliente: </h1>
		<p>No existe un paciente válido</p>
	</div>
</template>
<script>
import moment from 'moment'
export default {
	name: 'RecetaLentes',
	data() {
		return {
			cliente:[],
			lejos:{odEsfera: '', odCilindro: '', odEje: '', odAv: '', odDip: '', odPrisma: '', oiEsfera: '',oiCilindro: '',oiEje: '',oiAv: '',oiDip: '',oiPrisma: '' },
			cerca:{odEsfera: '', odCilindro: '', odEje: '', odAv: '', odDip: '', odPrisma: '', oiEsfera: '',oiCilindro: '',oiEje: '',oiAv: '',oiDip: '',oiPrisma: ''}, diagnostico:[]
		}
	},
	mounted(){
		this.cargarDatos()
	},
	methods: {
		cargarDatos(){
			let datos = new FormData();
			datos.append('pedir', 'listar1Cliente')
			datos.append('id', this.$route.params.idCliente)
			this.axios.post(this.servidor +'Clientes.php', datos)
			.then((response) => {
				this.cliente = response.data;
			});
		},
		crearReceta(){
			let datos = new FormData();
			datos.append('pedir', 'crear')
			datos.append('idCliente', this.$route.params.idCliente)
			datos.append('lejos', JSON.stringify(this.lejos))
			datos.append('cerca', JSON.stringify(this.cerca))
			datos.append('diagnostico', JSON.stringify(this.diagnostico))
			this.axios.post(this.servidor +'Receta.php', datos)
			.then((resp) => {
				if(resp.data.mensaje == 'ok'){
					this.$router.push({ name: 'receta', params:{idReceta: resp.data.id} })
				}else
					alert('Hubo un error, inténtelo más tarde')
			});

		}
	},
	computed: {
		edad(){
			const nacimiento = moment(this.cliente.fechaNacimiento);
			const hoy = moment();
			const edad = hoy.diff(nacimiento, "years");
			return edad;
		}
	},
}
</script>
<style scoped>
td:hover{
	background-color:rgb(255, 247, 193);
}
.tdSimple{
	border-style: hidden; border-right-style: solid;border-right-width: 1px;
}
</style>