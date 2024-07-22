<?php
if(!isset($conn))
{
	include 'db_connect.php';
}

include('xcrud/xcrud.php');
$xcrud = Xcrud::get_instance();
$xcrud->table('users');
$xcrud->columns('id ,firstname,middlename,lastname,username,password,background'); // columns in grid
$xcrud->fields('id ,firstname,middlename,lastname,username,password'); // columns in form
$xcrud->where('id =', $_SESSION['login_id']);
$xcrud->unset_remove();
$xcrud->unset_csv();
$xcrud->unset_print();
$xcrud->unset_title();
$xcrud->unset_add();
$xcrud->hide_button('save_new');
$xcrud->hide_button('save_edit');
$xcrud->change_type('password','password','md5');
$xcrud->disabled('firstname,middlename,lastname,username');
?>
<div class="container-fluid">
	<div id="msg"></div>

	<?php echo $xcrud->render('edit',$_SESSION['login_id']); ?>

</div>
