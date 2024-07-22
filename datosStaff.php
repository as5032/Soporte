<?php
if(!isset($conn)){
	include 'db_connect.php';
}

	include('xcrud/xcrud.php');
	$xcrud = Xcrud::get_instance();
	$xcrud->table('users');

	$xcrud->columns('id ,firstname,middlename,lastname,username,password,background'); // columns in grid
	$xcrud->fields('id ,firstname,middlename,lastname,username,password,background'); // columns in form



	$xcrud->where('id =', $_SESSION['login_id']);
	$xcrud->unset_remove();
	$xcrud->unset_csv();
	$xcrud->unset_print();
	//$xcrud->unset_title();
	$xcrud->table_name('Cambio de contraseña');
	$xcrud->unset_add();
	$xcrud->hide_button('save_new');
	$xcrud->hide_button('return');

	$xcrud->hide_button('save_return');

	$xcrud->change_type('password','password','md5');
	$xcrud->change_type('background', 'file', '', array('not_rename'=>true));
	$xcrud->disabled('firstname,middlename,lastname,username');
	$xcrud->set_logging(true);
	$xcrud->after_insert('alogs');
	$xcrud->after_update('alogs');
	$xcrud->after_remove('alogs');

//print_r($_SESSION);

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

					echo $xcrud->render('edit',$_SESSION['login_id']);


			?>
		</div>
	</div>
</div>
