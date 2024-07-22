<?php
if(!isset($conn)){
	include 'db_connect.php';
}


?>


<div class="container mt-5">
        <h1>Cargar archivo</h1>
        <form id="uploadForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="archivo">Selecciona un archivo:</label>
                <input type="file" class="form-control-file" id="archivo" name="archivo">
            </div>
            <button type="submit" class="btn btn-primary">Cargar</button>
        </form>
        <div id="mensaje" class="mt-3"></div>
    </div>

    <script>
        $(document).ready(function() {
            // Enviar el formulario al hacer clic en el botón de carga
            $("#uploadForm").on('submit', function(event) {
                event.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "procesar.php", // Archivo PHP para procesar la carga
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#mensaje").html(data); // Mostrar mensaje de éxito/error
                    }
                });
            });
        });
    </script>


<div class="col-lg-12">
	<div class="card">
		<div class="card-body">

			<?php




			?>
		</div>
	</div>
</div>
