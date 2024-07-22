<?php


	/**
	 * Script que tiene todas las funciones que se van a usar.
	 *
	 *
	 */





	/**
	 * Función que construye un <select> a partir de una sentencia sql
	 *
	 * $query = Sentencia sql para extraer los datos.
	 * $nombre = Nombre de como se va a llamar el <select>.
	 * $id = Id del <select>.
	 * $javascript = Script que lleva el <select>.
	 * $campo1 = Nombre del campo que va en value del <select>.
	 * $campo2 = Nombre del campo que se va a mostrar del <select>.
	 * $class = Nombre de alguna clase para ponerle estilos.
	 *
	 * @param varchar $query
	 * @param varchar $nombre
	 * @param varchar $id
	 * @param varchar $javascript
	 * @param varchar $campo1
	 * @param varchar $campo2
	 * @param varchar $class
	 * @param varchar $opciones
	 */


function drop_down($query, $nombre, $id, $javascript,$campo1,$campo2,$class, $opciones)
{

	$servername = "localhost";
	$username = "root";
	$password = "4dm1n1str4d0r";
	$dbname = "css_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
	$result = mysqli_query($conn, $query );
	//echo "<!-- $query  :) -->";
	echo "<select name=\"$nombre\" id=\"$id\"  $javascript class=\"$class\" $opciones >
		  	<option value=\"\"> -- Seleccionar -- </option>";
	while($row = mysqli_fetch_array($result))
		echo "<option value=".$row[$campo1].">".$row[$campo2]."</option>";

	echo"</select>";
	//mysqli_close($conn);
}


function drop_down2($query, $nombre, $id, $javascript,$campo1,$campo2,$class, $opciones)
{

	/// conexion nueva

	include_once("conecta.php");
	$filas = $dbCoordinadores->get_results($query);



	echo "<select name=\"$nombre\" id=\"$id\"  $javascript class=\"$class\" $opciones >
		  	<option value=\"\"> -- Seleccionar -- </option>";

	foreach ($filas as $dato)
	{

		//$dato->$campo1;
		echo "<option value=".$dato->id.">".$dato->$folio."</option>";

		/*
		echo '<ul>';
	    	echo '<li>'.$usuario->nombre;
	    	echo $usuario->email.'</li>';
		echo '</ul>';
		 */
	}
	echo"</select>";



	//include_once("conexionserv.php");
	/*
	$resultado = mysql_query($query);
	//echo "<!-- $query  :) -->";

	echo "<select name=\"$nombre\" id=\"$id\"  $javascript class=\"$class\" $opciones >
		  	<option value=\"\"> -- Seleccionar -- </option>";
	while($fila = mysql_fetch_array($resultado))
		echo "<option value=".$fila[$campo1].">".$fila[$campo2]."</option>";

	echo"</select>";
	 */
}





function drop_down_utf8($query, $nombre, $id, $javascript,$campo1,$campo2,$class, $opciones)
{

	$servername = "localhost";
	$username = "root";
	$password = "4dm1n1str4d0r";
	$dbname = "css_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
	$result=mysqli_query($conn,$query);

	echo "<select name=\"$nombre\" id=\"$id\"  $javascript class=\"$class\" $opciones >
		  	<option value=\"\"> -- Seleccionar -- </option>";
	while($row=mysqli_fetch_array($result))
		echo "<option value=".$row[$campo1].">".utf8_decode($row[$campo2])."</option>";

	echo"</select>";
}

function drop_down_utf8_encode($query, $nombre, $id, $javascript,$campo1,$campo2,$class, $opciones)
{

	$servername = "localhost";
	$username = "root";
	$password = "4dm1n1str4d0r";
	$dbname = "css_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
	$result=mysqli_query($conn, $query);

	echo "<select name=\"$nombre\" id=\"$id\"  $javascript class=\"$class\" $opciones >
		  	<option value=\"\"> -- Seleccionar -- </option>";
	while($row=mysqli_fetch_array($result))
		echo "<option value=".$row[$campo1].">".utf8_encode($row[$campo2])."</option>";

	echo"</select>";
}



/**
	 * Función que construye un <select> a partir de una sentencia sql pero ya con un
 	 * dato pre seleccionado
	 *
	 * $query = Sentencia sql para extraer los datos.
	 * $nombre = Nombre de como se va a llamar el <select>.
	 * $id = Id del <select>.
	 * $javascript = Script que lleva el <select>.
	 * $campo1 = Nombre del campo que va en value del <select>.
	 * $campo2 = Nombre del campo que se va a mostrar del <select>.
	 * $selected = Dato que va a estar preseleccionado.
 	 * $class = Nombre de alguna clase para ponerle estilos.
	 *
	 * @param varchar $query
	 * @param varchar $nombre
	 * @param varchar $id
	 * @param varchar $javascript
	 * @param varchar $campo1
	 * @param varchar $campo2
	 * @param varchar $class
   * @param varchar $selected
	 * @param varchar $opciones
	 */
function drop_down_selected($query, $nombre, $id, $javascript,$campo1,$campo2,$class, $selected, $opciones)
{

	$servername = "localhost";
	$username = "root";
	$password = "4dm1n1str4d0r";
	$dbname = "asesores";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$result=mysqli_query($conn, $query);
	//echo "$selected <br>";
	echo "<select name=\"$nombre\" id=\"$id\"  $javascript class=\"$class\" $opciones>
		  	<option value=\"\"> -- Seleccionar -- </option>";
	while($row=mysqli_fetch_array($result))
	{

		if ($row[$campo1] == $selected )
		{
			echo "<option value=".$row[$campo1]." selected >".$row[$campo2]."</option>";
		}
		else
		{
			echo "<option value=".$row[$campo1]." >".$row[$campo2]."</option>";
		}
	}

	echo"</select>";
}


function drop_down_selected_utf8($query, $nombre, $id, $javascript,$campo1,$campo2,$class, $selected, $opciones)
{

	$servername = "localhost";
	$username = "root";
	$password = "4dm1n1str4d0r";
	$dbname = "asesores";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$result=mysqli_query($conn, $query);


	//echo "$selected <br>";
	echo "<select name=\"$nombre\" id=\"$id\"  $javascript class=\"$class\" $opciones>
		  	<option value=\"\"> -- Seleccionar -- </option>";
	while($row=mysqli_fetch_array($result))
	{

		if ($row[$campo1] == $selected )
		{
			echo "<option value=".$row[$campo1]." selected >".utf8_encode($row[$campo2])."</option>";
		}
		else
		{
			echo "<option value=".$row[$campo1]." >".utf8_encode($row[$campo2])."</option>";
		}
	}

	echo"</select>";
}



/**
 * Función que limpia un valor que le va a llegar a una consulta de SQL
 *
 * @param string $value
 * @return string
 */

function sql_quote( $value )
{
    if( get_magic_quotes_gpc() )
    {
          $value = stripslashes( $value );
    }
    //check if this function exists
    if( function_exists( "mysql_real_escape_string" ) )
    {
          $value = mysql_real_escape_string( $value );
    }
    //for PHP version < 4.3.0 use addslashes
    else
    {
          $value = addslashes( $value );
    }
    return $value;
}




	function insert($info, $table)
	{
		if (!is_array($info)) { die("insert member failed, info must be an array"); }
		  //build the query
		  $sql = "INSERT INTO ".$table." (";
		  for ($i=0; $i<count($info); $i++) {
			 //we need to get the key in the info array, which represents the column in $table
		 $sql .= key($info);
		//echo commas after each key except the last, then echo a closing parenthesis
		 if ($i < (count($info)-1)) {
			$sql .= ", ";
		 } else $sql .= ") ";
		 //advance the array pointer to point to the next key
			next($info);
		 }
		 //now lets reuse $info to get the values which represent the insert field values
		 reset($info);
		 $sql .= "VALUES (";
		 for ($j=0; $j<count($info); $j++) {
			$sql .= "'".current($info)."'";
			if ($j < (count($info)-1)) {
			   $sql .= ", ";
			} else $sql .= ") ";
			next($info);
		 }
		//execute the query
		 echo "<!-- $sql -->";

		 mysql_query($sql) or die("query failed ".mysql_error());
		 	 return mysql_insert_id();
      }


    function drop_down_muchos($nombre, $id, $javascript,$campo1,$campo2,$class,$cuantasVeces)
	{
		echo "<select name=\"$nombre\" id=\"$id\"  $javascript class=\"$class\" >
				<option value=\"\"> -- Seleccionar -- </option>";
		for($i=1; $i <= $cuantasVeces; $i++)
		{
			echo "<option value=".$i.">".$i."</option>";
		}
		echo"</select>";
	}


	function drop_down_muchos_selected($nombre, $id, $javascript,$campo1,$campo2,$class,$cuantasVeces,$selected	)
	{
		echo "<select name=\"$nombre\" id=\"$id\"  $javascript class=\"$class\" >
				<option value=\"\"> -- Seleccionar -- </option>";
		for($i=1; $i <= $cuantasVeces; $i++)
		{
			if ($i == $selected)
			{
				echo "<option value=".$i." selected>".$i."</option>";
			}
			else
			{
				echo "<option value=".$i.">".$i."</option>";
			}

		}
		echo"</select>";
	}

	function get_Areas($idArea)
	{
		include("conexionserv.php");

		$query = "SELECT descripcion FROM cat_depto where id = $idArea limit 1";
		$result=mysql_query($query);

		while($row=mysql_fetch_array($result))
		{
			$descripcion =$row['descripcion'] ;
		}

		return $descripcion;


	}

	function genera_consecutivo($area)
	{
		include("conexionserv.php");

		$yearKnow = date('Y');
		$yearKnowShort = date('y');
		$contador = 0;
		$query = "SELECT count(*) as contador
				  FROM folios
				  WHERE year = $yearKnow
				  AND area = $area ";

		$result=mysql_query($query);

		while($row=mysql_fetch_array($result))
		{
			$contador = $row['contador'];
		}

		if( $contador == 1)
		{

			$queryConsecutivo = "SELECT consecutivo
				  				 FROM folios
				  				 WHERE year = $yearKnow
				  				 AND area = $area ";

			$result=mysql_query($queryConsecutivo);
			while($valor=mysql_fetch_array($result))
			{
				$folio = $valor['consecutivo'];
			}

			$folioUpdate = $folio + 1;
			$update = "UPDATE folios set consecutivo = $folioUpdate  WHERE year = $yearKnow AND area = $area limit 1";
			mysql_query($update);

		}
		elseif($contador == 0)
		{
			$folio = 1;
			$insert = "INSERT into folios values ($yearKnow,$folio,$area)";
			mysql_query($insert);
		}

		$ceros = 3;
		switch ($area) {

			case 100:     // COORDINACIÓN DE ASESORES (CA)
				$folioGenerado = "CA-$folio/$yearKnow";
				break;

			case 111:
				$folioGenerado = "$folio/$yearKnow";
				break;

			case 112:	 // CONSEJERÍA ADJUNTA de CONSULTA Y ESTUDIOS CONSTITUCIONALES (CACEC)
				$folioGenerado = "CACEC-$folio/$yearKnowShort";
				break;

			case 113:    // GENERA NÚMEROS CONSECUTIVOS

				$folio = sprintf("%0".$ceros."s", $folio );
				$folioGenerado = "$folio / $yearKnow";
				break;

			case 213:     // GENERA EXPEDIENTES DE CALEN
				$folioGenerado = "CALEN-$folio/$yearKnow";
				break;
		}



		return $folioGenerado;
	}




	function extracto ( $contenido, $cantidadPalabras )
	{
		$contenido = explode(' ', $contenido);
		$contenido = array_slice($contenido, 0, $cantidadPalabras);
		$contenido = implode(' ', $contenido);
		return $contenido;
	}

	function genera_consecutivo_expediente($serie, $subserie, $idInterno)
	{
		include("conexionserv.php");

		$yearKnow = date('Y');
		$yearKnowShort = date('y');

		$comodin = $serie;
		$condicion = " where seccion = '$comodin' ";

		if($subserie != "")
		{
			$comodin = $subserie;
			$condicion = " where subcategoria = '$comodin' ";
		}

		$query = "SELECT count(*) as contador
				  FROM expediente2
				  $condicion";

		echo " <!-- $query  <- cuenta primero --> ";
		$result=mysql_query($query);

		while($row=mysql_fetch_array($result))
		{
			$numeroMaximo =$row['contador'];
		}

		$concatenado = $comodin."-".($numeroMaximo + 1);
		$concatenado = $concatenado."/".$yearKnowShort;

		if ($idInterno != -1)
		{
			$update = "UPDATE expediente2 set consecutivo_numero = '$concatenado'
					   WHERE id = $idInterno limit 1";

			echo "<!-- Concatenado es: $concatenado <br> El update:   $update <br> $query  -->";
			mysql_query($update);
		}
		else
		{
			return $concatenado;
		}
	}


    function genera_consecutivo_expediente_calen($serie, $subserie, $idInterno)
    {
        include("conexionserv.php");

        $yearKnow = date('Y');
        $yearKnowShort = date('y');

        $comodin = $serie;
        $condicion = " where seccion = '$comodin' ";

        if($subserie != "")
        {
            $comodin = $subserie;
            $condicion = " where subcategoria = '$comodin' ";
        }

        $query = "SELECT count(*) as contador
                  FROM expediente2
                  $condicion

                  AND bandera_calen = 1";

        //echo " <!-- $query  <- cuenta primero --> ";
        $result=mysql_query($query);

        while($row=mysql_fetch_array($result))
        {
            $numeroMaximo =$row['contador'];
        }

        $concatenado = $comodin."-".($numeroMaximo + 1);
        $concatenado = $concatenado."/".$yearKnowShort;

        if ($idInterno != -1)
        {
            $update = "UPDATE expediente2 set consecutivo_numero = '$concatenado'
                       WHERE id = $idInterno limit 1";

            echo "<!-- Concatenado es: $concatenado <br> El update:   $update <br> $query  -->";
            mysql_query($update);
        }
        else
        {
            return $concatenado;
        }
    }





	/**
	 * Función que regresa el nombre completo del usuario, se le pasa como
	 * parámetro el id del usuario
	 *
	 * @param int $idTrab
	 * @return string
	 */
	function usuarios_datos($idTrab)
	{
		$sql = "SELECT concat(nombre,' ',paterno,' ',materno) as nombre_completo
		        FROM usuarios
		        WHERE idtrab = $idTrab";
		$result=mysql_query($sql);

		while($row=mysql_fetch_array($result))
		{
			$nombreCompleto = $row['nombre_completo'];
		}
		return $nombreCompleto;
	}

	function usuario_puesto($idTrab)
	{
		$sql = "SELECT a.id_puesto, b.descripcion
		        FROM usuarios a
		        LEFT OUTER JOIN cat_puestos b ON a.id_puesto = b.clave
		        WHERE idtrab = $idTrab";
		$result=mysql_query($sql);

		while($row=mysql_fetch_array($result))
		{
			$puesto = $row['descripcion'];
		}
		return $nombreCompleto;
	}




	function time_drop_down_selected($horaMinuto,$valor,$nombre,$class)
	{
		$contador = 23;
		if($horaMinuto == 2)
		{
			$contador = 59;
		}

		echo "<select name=\"$nombre\" id=\"$nombre\"  class=\"$class\" >";


		for($i = 0; $i <= $contador; $i++)
		{
			if ($i == $valor)
			{
				echo "<option value='$i' selected >$i</option>";
			}
			else
			{
				echo "<option value='$i'>$i</option>";
			}
		}
		echo"</select>";
	}

	/**
	 * Función que arregla el formato de la fecha para insertarlo en mysql
	 * el formato es dd/mm/aaaa se cambia a aaaa-mm-dd
	 * @date
	 *
	 * return @string
	 *
	 *
	 */
	function fix_date($date)
	{
		$date = explode('-',str_replace('/','-',$date));
		return $date[2].'-'.$date[1].'-'.$date[0];
	}

	function ceros($numero, $ceros=2)
	{
    	return sprintf("%0".$ceros."s", $numero );
	}

	/**
	 *  Función que detecta el tipo de codificación y lo arregla
	 *
	 *  var @string
	 *  return @string
	 */
	function fixUtf8($cadena)
	{
		$nuevo = $cadena;
		$detecto = mb_detect_encoding($cadena, "UTF-8", "UTF-8, ISO-8859-9");
		if ($detecto != "UTF-8")
		{
			$nuevo = utf8_encode($cadena);
		}

		return $nuevo;
	}

	/**
     * Función que busca caracteres mal codificados
     *
     */
	function convertToUTF8($str)
	{
    	$enc = mb_detect_encoding($str);

	    if ($enc != 'UTF-8')
	    {
	        return iconv($enc, 'UTF-8', $str);
	    }
	    else
	    {
	        return $str;
	    }
	}



	function update_to_UTF8($palabra,$tabla,$campo, $expediente)
	{
		include_once("conectaUTF8.php");




		$umlaute = array( 'Ã¼'=>'ü', 'Ã¤'=>'ä', 'Ã¶'=>'ö', 'Ã–'=>'Ö', 'ÃŸ'=>'ß', 'Ã '=>'à', 'Ã¡'=>'á', 'Ã¢'=>'â', 'Ã£'=>'ã', 'Ã¹'=>'ù', 'Ãº'=>'ú', 'Ã»'=>'û', 'Ã™'=>'Ù', 'Ãš'=>'Ú',
 	 			   'Ã›'=>'Û', 'Ãœ'=>'Ü', 'Ã²'=>'ò', 'Ã³'=>'ó', 'Ã´'=>'ô', 'Ã¨'=>'è', 'Ã©'=>'é', 'Ãª'=>'ê', 'Ã«'=>'ë', 'Ã€'=>'À', 'Ã'=>'Á', 'Ã‚'=>'Â', 'Ãƒ'=>'Ã', 'Ã„'=>'Ä',
 	 			   'Ã…'=>'Å', 'Ã‡'=>'Ç', 'Ãˆ'=>'È', 'Ã‰'=>'É', 'ÃŠ'=>'Ê', 'Ã‹'=>'Ë', 'ÃŒ'=>'Ì', 'Ã'=>'Í', 'ÃŽ'=>'Î', 'Ã'=>'Ï',
 	 			   'Ã‘'=>'Ñ', 'Ã’'=>'Ò', 'Ã“'=>'Ó', 'Ã”'=>'Ô', 'Ã•'=>'Õ', 'Ã˜'=>'Ø', 'Ã¥'=>'å', 'Ã¦'=>'æ', 'Ã§'=>'ç', 'Ã¬'=>'ì',
 	 			   'Ã­'=>'í', 'Ã®'=>'î', 'Ã¯'=>'ï', 'Ã°'=>'ð', 'Ã±'=>'ñ', 'Ãµ'=>'õ', 'Ã¸'=>'ø', 'Ã½'=>'ý', 'Ã¿'=>'ÿ', 'â‚¬'=>'€', 'Ã©'=>'é', 'Ã³'=>'ó'  );
		$limpia = $palabra;
		foreach ($umlaute as $key => $value)
		{
			//$limpia = str_replace($key, $value, $palabra);

            $posicion_coincidencia = strrpos($palabra, $key);
            if ($posicion_coincidencia === FALSE)
            {
              //  echo "**** no encontro nada **** <br>";
            }
            else
            {
                //echo "Si encontro algo $key <br> ";
                $bandera = 1;
                $limpia = str_replace($key, $value, $limpia);

                $updateSQL = "update $tabla set $campo = replace($campo, $key, $value) where id = $expediente limit 1;";
                mysql_query($updateSQL);




            }
		}
		return $limpia;
	}

	function Sanitizacion($var)
	{
		//$var = htmlentities($var);
		$var = htmlspecialchars($var, ENT_QUOTES, "UTF-8");
		if(!get_magic_quotes_gpc())
			$var  = addslashes($var);

		return $var;
	}

    /*
    function update_to_UTF8_tabla($expediente)
    {
        include_once("conectaUTF8.php");


        $campos = array ( 0=> 'asunto', 1=> 'remitente', 2=> 'cargo', 3=>'institucion', 4=> 'tema_asunto_calen', 5=> 'etiquetas' );

        $umlaute = array( 'Ã¼'=>'ü', 'Ã¤'=>'ä', 'Ã¶'=>'ö', 'Ã–'=>'Ö', 'ÃŸ'=>'ß', 'Ã '=>'à', 'Ã¡'=>'á', 'Ã¢'=>'â', 'Ã£'=>'ã', 'Ã¹'=>'ù', 'Ãº'=>'ú', 'Ã»'=>'û', 'Ã™'=>'Ù', 'Ãš'=>'Ú',
                   'Ã›'=>'Û', 'Ãœ'=>'Ü', 'Ã²'=>'ò', 'Ã³'=>'ó', 'Ã´'=>'ô', 'Ã¨'=>'è', 'Ã©'=>'é', 'Ãª'=>'ê', 'Ã«'=>'ë', 'Ã€'=>'À', 'Ã'=>'Á', 'Ã‚'=>'Â', 'Ãƒ'=>'Ã', 'Ã„'=>'Ä',
                   'Ã…'=>'Å', 'Ã‡'=>'Ç', 'Ãˆ'=>'È', 'Ã‰'=>'É', 'ÃŠ'=>'Ê', 'Ã‹'=>'Ë', 'ÃŒ'=>'Ì', 'Ã'=>'Í', 'ÃŽ'=>'Î', 'Ã'=>'Ï',
                   'Ã‘'=>'Ñ', 'Ã’'=>'Ò', 'Ã“'=>'Ó', 'Ã”'=>'Ô', 'Ã•'=>'Õ', 'Ã˜'=>'Ø', 'Ã¥'=>'å', 'Ã¦'=>'æ', 'Ã§'=>'ç', 'Ã¬'=>'ì',
                   'Ã­'=>'í', 'Ã®'=>'î', 'Ã¯'=>'ï', 'Ã°'=>'ð', 'Ã±'=>'ñ', 'Ãµ'=>'õ', 'Ã¸'=>'ø', 'Ã½'=>'ý', 'Ã¿'=>'ÿ', 'â‚¬'=>'€', 'Ã©'=>'é', 'Ã³'=>'ó'  );
        $limpia = $palabra;

        foreach ($campos as $key => $value1)
        {

            foreach ($umlaute as $key => $value)
            {
                //$limpia = str_replace($key, $value, $palabra);

                $posicion_coincidencia = strrpos($palabra, $key);
                if ($posicion_coincidencia === FALSE)
                {
                  //  echo "**** no encontro nada **** <br>";
                }
                else
                {
                    //echo "Si encontro algo $key <br> ";
                    $bandera = 1;
                    $limpia = str_replace($key, $value, $limpia);

                    $updateSQL = "update expediente2 set $campo = replace($campo, $key, $value) where id = $expediente limit 1;";
                    mysql_query($updateSQL);

                }
            }


        }


        return $limpia;
    }
	*/

	/**
     * Función que pasa la fecha a español en el formato 12/Ago/2014
     * Recibe la fecha en formato mysql yyyy/mm/dd   2014/12/25
     *
     *
     */
    function fecha_esp($fechaMysql)
    {
        $dias = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Noviembre", "Diciembre");
        $mesesShort = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");

        $fechaPartes = explode('-',str_replace('/','-',$fechaMysql));
        $rest = substr("abcdef", -2);
        $yearShort = substr($fechaPartes[0],-2);
        $fechaFormateada = $fechaPartes[2]."/".$mesesShort[$fechaPartes[1]]."/".$yearShort;




    }

?>
