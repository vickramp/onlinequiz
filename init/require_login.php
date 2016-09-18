<?php
 if(isset($_SESSION['userid'])){
  header("location: ../accounts/signin/");
  exit;
}
 ?>
