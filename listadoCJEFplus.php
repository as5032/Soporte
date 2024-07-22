<?php
if(!isset($conn)){
	include 'db_connect.php';
}

	include('xcrud/xcrud.php');
	$xcrud = Xcrud::get_instance();
	$xcrud->table('personal_cjef');

	// idtrab, nombre, paterno, materno, type

	$xcrud->columns('idtrab, nombre, paterno, materno, email, areas,status'); // columns in grid
	$xcrud->fields('idtrab, nombre, paterno, materno, email, areas ,status'); // columns in form
	$xcrud->relation('areas','cat_areas','id','abreviatura');
	$xcrud->relation('status','cat_estado_usuarios','id_estado','estado');
//./index.php?page=staffList
	$xcrud->button('index.php?page=fichaDispositivos2?idtrab={idtrab}','Registrar Resguardos','far fa-file','',array('target'=>'_self'));

	$xcrud->hide_button('save_edit');
	$xcrud->hide_button('save_new');
	$xcrud->unset_remove();
	$xcrud->label('idtrab','Id');
	$xcrud->label('paterno', 'Apellido Paterno');
	$xcrud->label('materno', 'Apellido Materno');
	$xcrud->label('areas', 'Áreas');
	$xcrud->label('status', 'Estatus');
	//$xcrud->unset_title();
	$xcrud->table_name('Usuarios CJEF');
	$xcrud->set_logging(true);
	$xcrud->after_insert('alogs');
	$xcrud->after_update('alogs');
	$xcrud->after_remove('alogs');

/*
	$xcrud->columns('id,customer_id, staff_id, subject,  description, status, date_created, date_closed'); // columns in grid
	$xcrud->fields('id,customer_id, staff_id, subject, description, status,date_created, date_closed'); // columns in form
	$xcrud->relation('customer_id','personal_cjef','idtrab',array('nombre','paterno','materno'));
	$xcrud->relation('staff_id','cat_personal','idtrab',array('nombre','paterno'));
	$xcrud->relation('subject','cat_temas','id_tema','tema');
	$xcrud->relation('status','cat_status','id_status','descripcion_status');

  $xcrud->label('customer_id','Usuario');

  $xcrud->label('description','Descripción');

	$xcrud->pass_var('admin_id', $_SESSION['login_id']);
	$xcrud->order_by('date_created','desc');
	$xcrud->label('date_created','Fecha de Creación');
	$xcrud->label('id','No. Ticket');
	$xcrud->disabled('date_created, date_closed');

	$xcrud->after_update('actualiza_estatus');



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
