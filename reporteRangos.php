<?php

date_default_timezone_set('America/Mexico_City');


?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/dist/css/charts.css" media="screen" />
<!-- Info boxes -->
<div class="col-12">
       <div class="card">
         <div class="card-body">

           <form name="myForm" id="myForm" >
             <label> Fecha de Inicio </label>
             <input type="date" name="fechaInicio" id="fechaInicio" required>

             <label> Fecha de Fin </label>
             <input type="date" name="fechaFin" id="fechaFin" required>
             <label> </label>
             <input type="button" id="submitFormData" onclick="SubmitFormData();" value="Submit" />
           </form>

         </div>
       </div>
   </div>

   <div id="results">
   	    <!-- All data will display here  -->
   </div>

   <script>
   function SubmitFormData() {
	var fechaInicio = $("#fechaInicio").val();
	var fechaFin = $("#fechaFin").val();


	$.post("ajaxRango.php", { fechaInicio: fechaInicio, fechaFin: fechaFin },
	   function(data) {
		 $('#results').html(data);
		 $('#myForm')[0].reset();
	   });
}

   </script>
