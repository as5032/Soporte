<?php
if(!isset($conn)){
	include 'db_connect.php';
}

	include('xcrud/xcrud.php');
	$xcrud = Xcrud::get_instance();
	$xcrud->table('cat_personal');

	// idtrab, nombre, paterno, materno, type

	$xcrud->columns('idtrab, nombre, paterno, materno, type, status'); // columns in grid
	$xcrud->fields('idtrab, nombre, paterno, materno, type, status'); // columns in form
	$xcrud->relation('type','cat_tipo','id_tipo','descripcion_tipo');
	$xcrud->relation('status','cat_estado_usuarios','id_estado','estado');
	//$xcrud->unset_title();
	$xcrud->table_name('Listado de Sistemas');
	$xcrud->hide_button('save_edit');
	$xcrud->hide_button('save_new');
	$xcrud->unset_remove();	
	$xcrud->label('idtrab','Id');
	$xcrud->label('paterno', 'Apellido Paterno');
	$xcrud->label('materno', 'Apellido Materno');
	$xcrud->label('type', 'Tipo');
	$xcrud->label('status', 'Estatus');
	$xcrud->label('areas', 'Tipo');
	$xcrud->set_logging(true);
	$xcrud->after_insert('alogs');
	$xcrud->after_update('alogs');
	$xcrud->after_remove('alogs');
	//$xcrud->columns('idtrab, nombre, paterno, materno, type, status'); // columns in grid
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
