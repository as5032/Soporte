<?php


    /*
    $target_dir = "ruta/del/destino/"; // Ruta de la carpeta de destino
    $target_file = $target_dir . "Normal.dotm"; // Establecer el nombre predeterminado del archivo
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    */

    $target_dir = "/var/www/html/plantillas/"; // Ruta de la carpeta de destino
    $target_file = $target_dir . "Normal.dotm";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Comprobar si el archivo ya existe en la carpeta de destino y si se permite sobrescribir
    /*
      if (file_exists($target_file)) {
          echo "El archivo ya existe en la carpeta de destino.";
          $uploadOk = 0;
      }
    */
    // Comprobar si se ha subido un archivo válido
    if ($_FILES["archivo"]["size"] > 500000)
    {
        echo "El archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir solo ciertos tipos de archivo (puedes ajustarlos según tus necesidades)
    $allowedExtensions = array("dotm");
    if (!in_array($imageFileType, $allowedExtensions))
    {
        echo "Solo se permiten archivos dotm.";
        $uploadOk = 0;
    }

    // Comprobar si $uploadOk está establecido a 0 por algún error
    if ($uploadOk == 0)
    {
        echo "El archivo no se cargó.";
    } else {
        // Intentar mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file))
        {
            echo "El archivo " . basename($_FILES["archivo"]["name"]) . " se ha cargado y sobrescrito correctamente.";
        } else
        {
            echo "Ha ocurrido un error al cargar el archivo.";
        }
    }

?>
