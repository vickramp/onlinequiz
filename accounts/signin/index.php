<?php
require '../../init/header.php';
if(isset($_SESSION['userid'])){
  header("location: /");
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  require'../../init/dbconfig.php';
  $email=trim($_POST['email']);
  $con=connectdb("test");
  $q='select password,id,pos from users where email=\''.$email.'\'';
  $result=$con->query($q);
  $row=$result->fetch_assoc();
  if(empty($row))
    echo'<script>sweetAlert(\'Oops...\',\'User Doesn\\\'t Exist\',\'error\')</script>';
  else{
      $val=$row['password'];
      if (password_verify($_POST['pass'],$val)){
        $_SESSION['userid']=$row['id'];
        $_SESSION['pos']=$row['pos'];
        $con->close();
        header("location: /");
        exit;
      }
      else
      $con->close();
        echo'<script>sweetAlert(\'Oops...\',\'Invalid Password\',\'error\')</script>';
      }
}
 ?>
<br/>
<h4 class="center">Log In</h4>
<div class="container">
  <br/><br/>
  <div class="row">
  <form id="form" action="" method="post">
    <div class="row">
      <div class="col s12 l6 offset-l3 z-depth-3"><br/>
      <div class="input-field col s12">
      <i class="material-icons prefix">person_outline</i>
      <input  type="text" name="email" id="username" required="required" class="validate" >
      <label for="username">Email </label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">lock_outline</i>
      <input  type="password" name="pass" id="password" required="required" class="validate" >
      <label for="password">Password</label><br/>
      </div>

      <a  href="../formgroup/" class="right waves-effect waves-grey btn-flat" >Form Group
        <i class="material-icons right">group_add</i>
      </a>
    </br></br></br></br></br></br></br></br><br/></br>
    </div>
  </div>
  <div class="row">
    <div class="col l6 s12 offset-l5 offset-s5">
      <a id="submit" onclick="validate()" class=" btn waves-effect waves-light z-depth-3" >Log In
        <i class="material-icons right">send</i>
      </a>
    </div>
  </div>
  </form>
</div>
<script>
document.title="Sign In";
function validate(){
  $('#form').submit();
}
</script>
</div>
<?php require '../../init/footer.php';?>
