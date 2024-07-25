<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include('./db_connect.php');
include("libs/functions.php");
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Mesa de Ayuda</title>
  <script src="js/jquery-1.12.4.js"></script>
  <script src="js/selectize.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/selectize.css" media="screen" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home | Customer Support System</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/dist/css/styles.css">
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
</head>
<style>
  body {
    width: 100%;
    height: calc(100%);
    position: fixed;
    top: 0;
    left: 0;
    background-image: url('images/Wallpaper_Firma.jpg');
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
  }

  main#main {
    width: 100%;
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

  .fa-arrow-up,
  .fa-arrow-down {
    color: #000;
  }
</style>

<body class="bg-dark">
  <main id="main">
    <div class="align-self-center w-100">
      <h1 class="text-white text-center"><b>Mesa de Ayuda DTIC</b></h1>
      <div id="login-center" class="row justify-content-center">
        <div class="card col-md-4">
          <div class="card-body">
            <form id="myForm">
              <div class="form-group">
                <label for="username" class="control-label text-dark">Nombre</label>
                <?php
                $queryPersonal = "SELECT idtrab, concat(nombre,' ',paterno,' ',materno) as nombrecompleto
                FROM personal_cjef where status = 1
                ORDER BY nombrecompleto asc ";
                drop_down($queryPersonal, "username", "username", "", "idtrab", "nombrecompleto", "form-control", "required");
                ?>
              </div>
              <div class="form-group">
                <label for="categoria" class="control-label text-dark">Categoría</label>
                <?php
                $queryRe = "SELECT id_tema, tema FROM cat_temas WHERE status = 1";
                drop_down($queryRe, "categoria", "categoria", "", "id_tema", "tema", "form-control", "required");
                ?>
              </div>
              <div class="form-group">
                <label for="categoria" class="control-label text-dark">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control form-control-sm" rows="10" required></textarea>
              </div>
              <input type="submit" name="add" id="add" value="Guardar" class="btn-sm btn-block btn-wave col-md-4 btn-primary" />
              <br>
              <label for="categoria" class="control-label text-dark">En atención:</label>
              <ul class="ta5" id="ticketList">
                <!-- Aquí se cargarán los tickets -->
              </ul>
            </form>
            <h3>
              <div id="postData"></div>
            </h3>
          </div>
        </div>
      </div>
  </main>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#myForm').submit(function(e) {
        $("#add", this).attr('disabled', 'disabled');
        e.preventDefault();
        $.ajax({
          url: "guardaTicket.php",
          type: "POST",
          data: $(this).serialize(),
          success: function(data) {
            $("#postData").html(data);
          },
          error: function() {
            alert("Form submission failed!");
          }
        });
      });

      function loadTickets() {
        $.ajax({
          url: 'get_tickets.php',
          type: 'GET',
          success: function(data) {
            $('#ticketList').html(data);
          },
          error: function() {
            alert("Failed to load tickets!");
          }
        });
      }

      // Cargar tickets al cargar la página
      loadTickets();

      // Actualizar tickets cada 5 minutos
      setInterval(loadTickets, 300000);
    });
  </script>
  <?php if ($no_registros > 2) {  ?>
    <script src="js/jquery.newsTicker.js"></script>
  <?php }  ?>
  <script>
    var nt_example1 = $('#nt-example1').newsTicker({
      row_height: 70,
      max_rows: 2,
      duration: 4000,
      prevButton: $('#nt-example1-prev'),
      nextButton: $('#nt-example1-next')
    });
  </script>
  <script>
    $(document).ready(function() {
      $('select').selectize({
        sortField: 'text'
      });
    });
  </script>
</body>

</html>