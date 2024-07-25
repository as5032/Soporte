<?php

  $servername = "localhost";
  $username = "root";
  $password = "4dm1n1str4ad0r";
  $dbname = "css_db";

  $conn= new mysqli($servername,$username,$password,$dbname)or die("Could not connect to mysql".mysqli_error($con));
  
