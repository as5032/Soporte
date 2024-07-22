<!DOCTYPE html>
<html lang="en">
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  session_start();
  include('./db_connect.php');
  include("libs/functions.php");
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mesa de Ayuda</title>
  <!-- <script src="js/jquery.min.js" type="text/javascript"></script> -->
  <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="  crossorigin="anonymous"></script>
  <script src= "https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js " integrity= "sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk= " crossorigin= "anonymous "></script>
  <link rel= "stylesheet " href= "https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css " integrity= "sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg= " crossorigin= "anonymous " />

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Customer Support System</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/dist/css/styles.css">
	<!-- <script src="assets/plugins/jquery/jquery.min.js"></script> -->
 <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">


<?php

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    position: fixed;
	    top:0;
	    left: 0;
      background-image: url('images/backgreen.jpg');
	   /* background: #007bff; */

	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;
	}


.container-login100 {
  width: 100%;
  min-height: 100vh;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  padding: 15px;
  background: #2575fc;
  background: -webkit-linear-gradient(left, #35c73c, #2575fc);
  background: -o-linear-gradient(left, #35c73c, #2575fc);
  background: -moz-linear-gradient(left, #35c73c, #2575fc);
  background: linear-gradient(left, #35c73c, #2575fc);
}

</style>

<body class="bg-dark">


  <main id="main" >

  		<div class="align-self-center w-100">
		<h1 class="text-white text-center"><b>Mesa de Ayuda DTIC</b></h1>
  		<div id="login-center" class="row justify-content-center">
  			<div class="card col-md-4">
  				<div class="card-body">
  					<form id="myForm" >
  						<div class="form-group">
  							<label for="username" class="control-label text-dark">Nombre</label>
                <?php
                  $queryPersonal = "SELECT idtrab, concat(nombre,' ',paterno,' ',materno) as nombrecompleto FROM personal_cjef order by nombrecompleto asc ";
                  drop_down($queryPersonal,"username","username","","idtrab","nombrecompleto","form-control" ,"required");
                ?>
  						</div>
  						<div class="form-group">
  							<label for="categoria" class="control-label text-dark">Categoría</label>
                <?php
                  $queryRe = "SELECT id_tema, tema FROM cat_temas WHERE status = 1";
                  drop_down($queryRe,"categoria","categoria","","id_tema","tema","form-control" ,"required");
                ?>
  						</div>
              <div class="form-group">
  							<label for="categoria" class="control-label text-dark">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control form-control-sm" rows="10" required></textarea>
  						</div>

  						<center> <input type="submit" name="add" id="add" value="Guardar" class="btn-sm btn-block btn-wave col-md-4 btn-primary"/>  </center>
  					</form>
            <center> <h3> <div id="postData"></div> </h3> </center>
  				</div>
  			</div>
  		</div>
  		</div>
  </main>

  <script type="text/javascript">
      $(document).ready(function(){
          $('#myForm').submit(function(e){
          $("#add", this).attr('disabled', 'disabled');

              e.preventDefault();
              $.ajax({
                  url: "ajaxOnly.php",
                  type: "POST",
                  data: $(this).serialize(),
                  success: function(data){
                      $("#postData").html(data);
                  },
                  error: function(){
                      alert("Form submission failed!");
                  }
              });
          });

      });
      </script>

      <script>

  $(document).ready(function () {
    $('select').selectize({
        sortField: 'text'
    });
});


</script>




</body>

</html>
