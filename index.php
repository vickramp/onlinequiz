<?php
require 'init/header.php';
if(!isset($_SESSION['userid'])){
    header("location: accounts/signin/");
    exit;
}
switch($_SESSION['pos']){
  case '-1':header("location: /admin");exit;break;
  case '0':require'contest.php';break;
  case '1':require'finish.php';break;
}
 require 'init/footer.php'; ?>
