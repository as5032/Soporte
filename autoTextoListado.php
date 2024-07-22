<?php
if(!isset($conn)){
	include 'db_connect.php';
}

	include('xcrud/xcrud.php');
	$xcrud = Xcrud::get_instance();
	Xcrud_config::$search_on_typing = true;
	$xcrud->table('autotexto_listado');

	// id, area, version, archivo, fecha, idtrab, status

	$xcrud->columns('id, area, version, archivo, observaciones, fecha, idtrab'); // columns in grid
	$xcrud->fields('area, archivo, observaciones'); // columns in form
	$xcrud->relation('area','cat_direcciones_areas','id_direcc','nombre_direcc');
	$xcrud->relation('idtrab','users','id','firstname');

	//$xcrud->relation('status','cat_estado_usuarios','id_estado','estado');
//./index.php?page=staffList
	//$xcrud->button('index.php?page=fichaDispositivos2?var={idtrab}','Resguardos','far fa-file','',array('target'=>'_self'));
	$xcrud->pass_var('idtrab',$_SESSION['login_id']);
	$xcrud->change_type('archivo', 'file', '', array('not_rename'=>true));
	$xcrud->hide_button('save_edit');
	$xcrud->hide_button('save_new');
	$xcrud->unset_remove();
	$xcrud->group_by_columns('area');


?>


<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<table class="table table-bordered table-striped">
				<thead>
				<tr>
					<th> Area </td>
					<th> Archivo </td>
				</tr>
			</thead>
			<tr>
				<td>Amparo </td>
				<td><a href="#"> Archivo BAT </a> </td>
			</tr>
			<tr>
				<td>Contencioso </td>
				<td><a href="#"> Archivo BAT </a> </td>
			</tr>
			<tr>
				<td>Controversias </td>
				<td><a href="#"> Archivo BAT </a> </td>
			</tr>

			</table>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">

			<?php

				//	print_r($_SESSION);
					echo $xcrud->render();


			?>
		</div>
	</div>
</div>
