<?php
if(!isset($conn)){
	include 'db_connect.php';
}

	include('xcrud/xcrud.php');
	$xcrud = Xcrud::get_instance();
	$xcrud->table('tickets');

	$xcrud->columns('subject, customer_id, department_id, description'); // columns in grid
	$xcrud->fields('subject, customer_id, department_id, description'); // columns in form
	$xcrud->relation('customer_id','customers','id',array('firstname','lastname'));
	$xcrud->relation('department_id','departments','id','name');
	$xcrud->label('subject','Tema');
  $xcrud->label('customer_id','Usuario');
  $xcrud->label('department_id','Área');
  $xcrud->label('description','Descripción');
	$xcrud->unset_remove();
	$xcrud->pass_var('admin_id', $_SESSION['login_id']);
	$xcrud->set_logging(true);
	$xcrud->after_insert('alogs');
	$xcrud->after_update('alogs');
	$xcrud->after_remove('alogs');

	print_r($_SESSION);

/*

	$xcrud->relation('situacion_contribuyente','cat_situacion','id_situacion','descripcion_situacion');
	$xcrud->relation('entidad_federativa','cat_entidades','id_entidad','entidad');
	$xcrud->relation('status','cat_status','id_status','desc_status');

	idcliente, rfc, curp, nombre, paterno, materno, fecha_nacimiento, situacion_contribuyente, entidad_federativa, municipio_alcaldia, colonia, tipo_vialidad,
	nombre_vialidad, num_ext, num_int, cp, regimen_1, fecha_alta1, regimen_2, fecha_alta2, status
	*/
	//$xcrud->relation('officeCode','offices','officeCode','city');
?>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<?php echo $xcrud->render(); ?>
		</div>
	</div>
</div>
<script>
	$('#manage_ticket').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_ticket',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=ticket_list')
					},750)
				}
			}
		})
	})
</script>
