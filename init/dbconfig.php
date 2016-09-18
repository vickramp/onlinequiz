<?php

function connectdb($name){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = $name;
  $dbport = 3306;
return  new mysqli($servername, $username, $password, $database, $dbport);
}

 ?>
