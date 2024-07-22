<?php
	if(!isset($conn)){
		include 'db_connect.php';
	}

	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include('xcrud/xcrud.php');

	$query = "SELECT concat(a.nombre,' ',a.paterno,' ', a.materno) as nombreCompleto  , b.abreviatura
						FROM personal_cjef a, cat_areas b
						WHERE a.areas = b.id";

	$resultPorStaff = $conn->query($query);
	while($rowTotalStaff = $resultPorStaff->fetch_assoc())
	{
	  $nombre = $rowTotalStaff['nombreCompleto'];
	  $area = $rowTotalStaff['abreviatura'];
	}

	$xcrud1 = Xcrud::get_instance();
	$xcrud1->table('dispositivos_usuarios');
	$xcrud1->unset_title();

	/**
	`id_dispositivos`, `idtrab`, `id_tipo_dispositivo`, `ip`, `observaciones`, `fecha`, `usuario_alta`, `status`
	*/
	$xcrud1->relation('id_tipo_dispositivo','cat_dispositivos','id_dispositivo','descripcion');
	$xcrud1->columns('id_tipo_dispositivo,ip,documento,observaciones');
	$xcrud1->unset_edit()->unset_view();
	$xcrud1->hide_button('add');
	$xcrud1->where('idtrab =',$idtrab);
	$xcrud1->change_type('documento', 'file', '', array('not_rename'=>true));
	$xcrud1->label('id_tipo_dispositivo','Tipo de Equipo');




	$xcrud2 = Xcrud::get_instance();
	$xcrud2->table('dispositivos_usuarios');
	$xcrud2->unset_title();
	$xcrud2->relation('id_tipo_dispositivo','cat_dispositivos','id_dispositivo','descripcion');
	$xcrud2->fields('id_tipo_dispositivo,ip,documento,observaciones');
	$xcrud2->hide_button('save_return,return,save_edit');
	$xcrud2->set_lang('save_new','Publish');
	$xcrud2->where('idtrab =',$idtrab);
	$xcrud2->pass_var('idtrab',$idtrab);
	$xcrud2->change_type('documento', 'file', '', array('not_rename'=>true));
	//$pattern = '/^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/';
	$xcrud2->validation_pattern('ip', '^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$');
	$xcrud2->label('id_tipo_dispositivo','Tipo de Equipo');



?>




<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<?php echo "<h3>".utf8_encode($nombre)."<br> ".$area."</h3>"; ?>
		</div>
	</div>

	<div class="card">
		<div class="card-body">

			<?php

				echo $xcrud1->render();

				echo $xcrud2->render('create');



			?>
		</div>
	</div>
</div>
<script type="text/javascript">
window.onload = function(){
	 $(document).on("xcrudafterrequest",function(event,container){
			 if($(container).closest(".xcrud").prevAll(".xcrud").length){
					 Xcrud.reload(".xcrud:first");
			 }
	 });
}
</script>
