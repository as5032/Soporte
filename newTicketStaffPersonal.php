<?php

	if(!isset($conn)){
		include 'db_connect.php';
	}

	include('xcrud/xcrud.php');
	$xcrud = Xcrud::get_instance();
	$xcrud->table('tickets');

	$xcrud->where('staff_id =', $_SESSION['login_id']);
	$xcrud->where('status <> 2');
	$xcrud->columns('id,customer_id, staff_id, subject,  description, status, date_created, date_closed'); // columns in grid
	$xcrud->fields('id,customer_id, staff_id, subject, description, status,date_created, date_closed'); // columns in form
	$xcrud->relation('customer_id','personal_cjef','idtrab',array('nombre','paterno','materno'));
	$xcrud->relation('staff_id','cat_personal','idtrab',array('nombre','paterno'));
	$xcrud->relation('subject','cat_temas','id_tema','tema');
	$xcrud->relation('status','cat_status','id_status','descripcion_status');
	$xcrud->label('customer_id','Usuario');
  $xcrud->label('description','Descripción');
	$xcrud->unset_remove();
	$xcrud->unset_add();
	$xcrud->pass_var('admin_id', $_SESSION['login_id']);
	$xcrud->order_by('date_created','desc');
	$xcrud->label('date_created','Fecha de Creación');
	$xcrud->label('staff_id','Personal DTIC');
	$xcrud->label('subject','Categoría');
	$xcrud->label('status','Estado del Ticket');
	$xcrud->label('id','No. Ticket');
	$xcrud->disabled('date_created, date_closed');
	$xcrud->hide_button('save_edit');
	$xcrud->hide_button('save_new');
	$xcrud->after_update('actualiza_estatus');
	$xcrud->set_logging(true);
	$xcrud->after_insert('alogs');
	$xcrud->after_update('alogs');
	$xcrud->after_remove('alogs');




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

			<?php

					echo $xcrud->render();


			?>
		</div>
	</div>
</div>
