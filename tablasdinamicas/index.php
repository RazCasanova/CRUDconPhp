<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tablas dinamicas</title>
	<?php require_once "scripts.php"; ?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="card text-left">
					<div class="card-header text-center bg-info text-white">
						<h3>Tablas dinamicas con DataTable y php</h3>
					</div>
					<div class="card-body">
						<span class="btn btn-primary" data-toggle="modal" data-target="#agregarNuevosDatosModal">Agregar nuevo <span class="fas fa-plus-circle"></span></span>
						<hr>
						<div id ="tablaDatatable"></div>

					</div>
					<div class="card-footer text-muted text-center">
						By Casanova Rosas Raziel
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="agregarNuevosDatosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Agregar nuevo celular</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" id="frmnuevo">
						<lable>Nombre</lable>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<lable>Año</lable>
						<input type="text" class="form-control input-sm" id="anio" name="anio">
						<lable>Empresa</lable>
						<input type="text" class="form-control input-sm" id="empresa" name="empresa">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="btnAgregarNuevo">Agregar nuevo</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="editarDatosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar celular</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" id="frmactualizar">
						<input type="text" hidden="" id="idcelular" name="idcelular">
						<lable>Nombre</lable>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
						<lable>Año</lable>
						<input type="text" class="form-control input-sm" id="anioU" name="anioU">
						<lable>Empresa</lable>
						<input type="text" class="form-control input-sm" id="empresaU" name="empresaU">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-warning text-white" id="btnActualizar">Actualizar datos</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#btnAgregarNuevo').click(function(){
			datos=$('#frmnuevo').serialize();

			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/agregar.php",
				success:function(r){
					if (r==1) {
						$('#frmnuevo')[0].reset();
						$('#tablaDatatable').load('tabla.php');
						alertify.success("Agregado con exito");
					}else{
						alertify.error("Fallo al agregar");
					}
				}
			});
		});

		$('#btnActualizar').click(function(){
			datos=$('#frmactualizar').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/actualizar.php",
				success:function(r){
					if (r==1) {
						$('#tablaDatatable').load('tabla.php');
						alertify.success("Actualizado con exito");
					}else{
						alertify.error("Fallo al actualizar");
					}
				}
			});
		});
	});	
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaDatatable').load('tabla.php');
	});
</script>

<script type="text/javascript">
	function agregaFrmActualizar(idcelular){
		$.ajax({
			type:"POST",
			data:"idcelular="+ idcelular,
			url:"procesos/obtenerDatos.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idcelular').val(datos['id_celular']);
				$('#nombreU').val(datos['nombre']);
				$('#anioU').val(datos['anio']);
				$('#empresaU').val(datos['empresa']);
			}
		});
	}

	function eliminarDatos(idcelular){
		alertify.confirm('Eliminar un celular', '¿Esta seguro de eliminar este celular?', function(){ 
				$.ajax({
				type:"POST",
				data:"idcelular=" + idcelular,
				url:"procesos/eliminar.php",
				success:function(r){
					if(r==1){
						$('#tablaDatatable').load('tabla.php');
						alertify.success("Eliminado con exito");
					}else{
						alertify.error("Fallo al eliminar");
					}
				}
			});
			}
                , function(){ alertify.error('Se cancelo la eliminacion')});
	}
</script>