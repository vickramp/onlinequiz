<?php
if(!isset($_SESSION['userid']))
session_start();
if(!isset($_SESSION['score'])){
  require_once 'init/dbconfig.php';
  $con=connectdb("test");
  $sql='select score from users  where id='.$_SESSION['userid'];
  $res=$con->query($sql);
  $ans=$res->fetch_assoc();
  $_SESSION['score']=$ans['score'];
}
if(isset($_SESSION['selected'])){
  if($_SESSION['selected'])
    selected(true);
  else
    selected(false);
    exit;
}
else{
  require_once 'init/dbconfig.php';
  $con=connectdb("test");
  $sql='select count(*) from users where score >(select score from users where id='.$_SESSION['userid'].') and branch=(select branch from users where id='.$_SESSION['userid'].')';
  $res=$con->query($sql);
  $ans=$res->fetch_assoc();
  $ans=$ans['count(*)'];
  if($ans<3){
    $_SESSION['selected']=true;
    selected(true);
    $con->close();
    exit;
  }
  $sql='select count(*) from users where score >(select score from users where id='.$_SESSION['userid'].')';
  $res=$con->query($sql);
  $ans=$res->fetch_assoc();
  $ans=$ans['count(*)'];
  if($ans<25){
    $_SESSION['selected']=true;
    selected(true);
    $con->close();
    exit;
  }
  else{
    $_SESSION['selected']=false;
    selected(false);
    $con->close();
    exit;
  }
}
function selected($status){
  echo'<div class="row"><br/><br/><p class="center" style=" font-size:50px;-webkit-transform: rotate(90deg);    -moz-transform: rotate(90deg);    -o-transform: rotate(90deg);    -ms-transform: rotate(90deg);    transform: rotate(90deg);">';
    if($status)
      echo':)<p>';
      else {
        echo ':(</p><br/>';
      }
      if($status)
      echo'<h5 class="center green-text">This round isn\'t yet finished,but you are in lead and you might get through this round.<br/><br/>Contact any volunteer near you.</h5> ';
      else
      echo'<h5 class="center red-text">Sorry, your didn\'t make it to the next round, but we are very happy to see you here !!</h5>';
      echo '<br/><br/><br/><h4 class="center">Thank you for you participation.!!<br/><br/> your score is '.$_SESSION['score'].'</h4>';

}
 ?>
</div>
<script>document.title="Finished .."</script>
