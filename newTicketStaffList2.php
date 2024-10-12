<script>
	function reproducirSonido() {
		var audio = new Audio('aviso.mp3');
		audio.play();
	}
</script>
<?php
if (!isset($conn)) {
	include 'db_connect.php';
}

include('xcrud/xcrud.php');
$xcrud = Xcrud::get_instance();
$xcrud->table('tickets');
$xcrud->join('customer_id', 'usuarios_view', 'idtrab'); // Usamos la vista en lugar de la tabla directa
$xcrud->change_type('usuarios_view.fotos', 'image', false, array(
	'width' => 10,
	'path' => '/var/www/html/directorio/images/',
	'thumbs' => array(array(
		'height' => 60,
		'width' => 120,
		'crop' => true,
		'marker' => '_th'
	))
));
$xcrud->columns('id,customer_id, staff_id, subject,  description, status, solucion_dtic, evidencia, date_created, date_closed, usuarios_view.fotos'); // columns in grid
$xcrud->fields('id,customer_id, staff_id, subject, description, status,solucion_dtic, evidencia, date_created, date_closed, usuarios_view.fotos'); // columns in form
$xcrud->relation('customer_id', 'personal_cjef', 'idtrab', array('nombre', 'paterno', 'materno'));
$xcrud->relation('staff_id', 'cat_personal', 'idtrab', array('nombre', 'paterno'), 'status>0');
$xcrud->relation('subject', 'cat_temas', 'id_tema', 'tema');
$xcrud->relation('status', 'cat_status', 'id_status', 'descripcion_status');
$xcrud->label('customer_id', 'Usuario');
$xcrud->label('description', 'Descripción');

$xcrud->highlight('status', '=', '0', 'red');
$xcrud->highlight('solucion_dtic', '<', " ", 'red');

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
//$xcrud->validation_required('solucion_dtic', 10);
$xcrud->set_attr('solucion_dtic', array('', 'data-parsley-type' => 'digits', 'data-parsley-length' => "[5,15]"));


			$xcrud->table_name('Employees - Single click cell to edit!');
			$xcrud->set_attr('lastName', array('id' => 'user', 'data-role' => 'admin'));
			//Activate parslet validation
			$xcrud->parsley_active(true);
			//Make extension mandatory
			$xcrud->set_attr('extension', array('required' => 'required'));
			//Ensure First Name is alpha numeric    
			$xcrud->set_attr('firstName', array('data-parsley-trigger' => 'change', 'required' => 'required', 'id' => 'user', 'data-parsley-type' => 'alphanum'));
			$xcrud->set_attr('lastName', array('data-parsley-trigger' => 'change', 'required' => 'required', 'id' => 'user', 'data-parsley-type' => 'alphanum'));
			//ensure valid email and display "Email not valid"
			$xcrud->set_attr('email', array(
				'data-parsley-trigger' => 'change',
				'id' => 'user',
				'data-parsley-type' => 'email',
				'data-parsley-error-message' => "Email not valid"
			));
			//ensure office Code is between 3 and 5 number characters
			$xcrud->set_attr('reportsTo', array('id' => 'user', 'data-parsley-type' => 'digits', 'data-parsley-length' => "[3,5]"));
			$xcrud->relation('officeCode', 'offices', 'officeCode', 'city');
			$xcrud->fields_inline('lastName,firstName,extension,email,officeCode,reportsTo,jobTitle'); //set the fields to allow inline editing       
			$xcrud->set_logging(true);
			echo $xcrud->render();



/*$xcrud->set_logging(true);
$xcrud->after_insert('alogs');
$xcrud->after_update('alogs');
$xcrud->after_remove('alogs');*/
// Realizamos la consulta correctamente asignando el resultado a una variable.
$result = $conn->query("SELECT * 
FROM `tickets` 
WHERE STATUS = 0 
AND date_created >= NOW() - INTERVAL 12 HOUR
LIMIT 25");

// Verificamos si hay filas en el resultado
if ($result->num_rows > 0) {
	echo "<script>reproducirSonido();</script>";
}
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