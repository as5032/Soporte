<?php
if (!isset($conn)) {
	include 'db_connect.php';
}

include('xcrud/xcrud.php');
$xcrud = Xcrud::get_instance();
$xcrud->table('tickets');

$xcrud->columns('id,customer_id, staff_id, subject,  description, status, solucion_dtic, evidencia, date_created, date_closed'); // columns in grid
$xcrud->fields('id,customer_id, staff_id, subject, description, status,solucion_dtic, evidencia, date_created, date_closed'); // columns in form
$xcrud->relation('customer_id', 'personal_cjef', 'idtrab', array('nombre', 'paterno', 'materno'));
$xcrud->relation('staff_id', 'cat_personal', 'idtrab', array('nombre', 'paterno'), 'status>0');
$xcrud->relation('subject', 'cat_temas', 'id_tema', 'tema');
$xcrud->relation('status', 'cat_status', 'id_status', 'descripcion_status');
$xcrud->label('customer_id', 'Usuario');
$xcrud->label('description', 'Descripción');
$xcrud->unset_remove();
$xcrud->pass_var('admin_id', $_SESSION['login_id']);
$xcrud->order_by('date_created', 'desc');
$xcrud->label('date_created', 'Fecha de Creación');
$xcrud->label('staff_id', 'Personal DTIC');
$xcrud->label('subject', 'Categoría');
$xcrud->label('status', 'Estado del Ticket');
$xcrud->label('id', 'Ticket');
$xcrud->label('solucion_dtic', 'Solucion DTIC');
$xcrud->label('date_closed', 'Fecha Cierre');
$xcrud->disabled('date_created, date_closed');
$xcrud->hide_button('save_edit');
$xcrud->hide_button('save_new');
$xcrud->after_update('actualiza_estatus');
$xcrud->change_type('evidencia', 'image');
//$xcrud->unset_title();
$xcrud->table_name('Listado de Tickets');
$xcrud->validation_required('solucion_dtic');
/*$xcrud->set_logging(true);
$xcrud->after_insert('alogs');
$xcrud->after_update('alogs');
$xcrud->after_remove('alogs');*/

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
<script>
	// Función para refrescar la página cada 4 minutos
	function refrescarPagina() {
		location.reload(); // Recargar la página actual
	}

	// Llamar a la función para refrescar la página cada 4 minutos
	setInterval(refrescarPagina, 4 * 60 * 2000); // 4 minutos en milisegundos
</script>