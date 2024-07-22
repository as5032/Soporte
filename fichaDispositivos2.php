<?php
if(!isset($conn)){
	include 'db_connect.php';
}

	include('xcrud/xcrud.php');

	$xcrud1 = Xcrud::get_instance();
	$xcrud1->table('dispositivos_usuarios');

	/**
	`id_dispositivos`, `idtrab`, `id_tipo_dispositivo`, `ip`, `observaciones`, `fecha`, `usuario_alta`, `status`
	*/

	$xcrud1->columns('id_tipo_dispositivo,ip,documento,observaciones');
	$xcrud1->unset_edit()->unset_view();
	$xcrud1->hide_button('add');


	$xcrud2 = Xcrud::get_instance();
	$xcrud2->table('dispositivos_usuarios');
	$xcrud2->fields('id_tipo_dispositivo,ip,documento,observaciones');
	$xcrud2->hide_button('save_return,return,save_edit');
	$xcrud2->set_lang('save_new','Publish');

?>




<div class="col-lg-12">
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
