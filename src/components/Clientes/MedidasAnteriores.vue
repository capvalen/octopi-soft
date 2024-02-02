<template lang="">
<div class="modal fade" id="modalAnteriores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h1 class="modal-title fs-5" id="exampleModalLabel">Medidas anteriores</h1>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<p>Medidas anteriores registradas</p>
			<table class="table">
				<thead>
					<tr>
						<th>N°</th>
						<th>Fecha</th>
						<th>Diagnóstico</th>
						<th>PDF</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(anterior, index) in anteriores" :key="anterior.id">
						<td>{{index+1}}</td>
						<td>{{anterior.registro}}</td>
						<td>{{anterior.diagnostico}}</td>
						<td>
							<a :href="'http://localhost/vegavision/api/impresion.php?idReceta='+anterior.id" target="_blank" class="btn btn-outline-secondary" >PDF</a>
						</td>
					</tr>
				</tbody>

			</table>
		</div>
	</div>
	</div>
</div>
</template>
<script>
export default {
	name:'modalAnteriores',
	props:['anteriores'],
	data() {
		return {
			
		}
	},
}
</script>
<style lang="">
	
</style>