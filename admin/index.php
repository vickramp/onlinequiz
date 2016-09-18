<?php
require_once '../init/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if($_POST['email']=='techclubcse@gmail.com'&&$_POST['pass']=='@Techclubcse'){
  $_SESSION['admin']=1;
  $_SESSION['userid']=0;
  $_SESSION[pos]=-1;
  header("location: /admin");
  exit;
}
else{
  header("location: /");
  exit;
}
}
    if(!isset($_SESSION['admin']))
      require 'login.php';
    else
      require 'admin.php';
    require_once '../init/footer.php';
 ?>
