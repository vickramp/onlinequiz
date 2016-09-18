<?php
require '../../init/header.php';
if(isset($_SESSION['userid'])){
    header("location: /");
    exit;
}
if(isset($_GET['check'])){
  require '../../init/dbconfig.php';
  $dbobj=connectdb("test");
  $sql='select count(*) from users where reg1=\''.$_POST['reg1'].'\' or reg2=\''.$_POST['reg1'].'\'';
  $res=$dbobj->query($sql);
  $ans=$res->fetch_assoc();
  if($ans['count(*)']!='0')
    echo'reg1';
  $sql='select count(*) from users where reg1=\''.$_POST['reg2'].'\' or reg2=\''.$_POST['reg2'].'\'';
  $res=$dbobj->query($sql);
  $ans=$res->fetch_assoc();
  if($ans['count(*)']!='0')
    echo'reg2';
  $sql='select count(*) from users where email=\''.$_POST['email'].'\' ';
  $res=$dbobj->query($sql);
  $ans=$res->fetch_assoc();
  if($ans['count(*)']!='0')
    echo'email';
  $sql='select count(*) from users where phone='.$_POST['phno'].' ';
  $res=$dbobj->query($sql);
  $ans=$res->fetch_assoc();
  if($ans['count(*)']!='0')
    echo'phno';
    $dbobj->close();
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if(!check(strtolower($_POST['reg1']))){
  echo'<script>swal(
  \'Oops...\',
  \''.$_POST['reg1'].' is an invalid Registration number\',
  \'error\'
)</script>';
}
else if(!check(strtolower($_POST['reg2']))){
  echo'<script>swal(
  \'Oops...\',
  \''.$_POST['reg2'].' is an invalid Registration number\',
  \'error\'
)</script>';
}
else{
  require_once '../../init/dbconfig.php';
  $con=connectdb('test');
$sql='insert into users(password,name1,name2,reg1,reg2,email,phone,branch,year)values(\''.crypt($_POST['pass'],'thisisapassword').'\',\''.mysqli_real_escape_string($con, $_POST['name1']).'\',\''.mysqli_real_escape_string($con, $_POST['name2']).'\',\''.mysqli_real_escape_string($con, $_POST['reg1']).'\',\''.mysqli_real_escape_string($con, $_POST['reg2']).'\',\''.mysqli_real_escape_string($con, $_POST['email']).'\','.$_POST['phno'].','.$_POST['branch'].','.$_POST['year'].')';
if($con->query($sql)===true){
  $q='select password,id,pos from users where email=\''.$_POST['email'].'\'';
  $result=$con->query($q);
  $row=$result->fetch_assoc();
  $_SESSION['userid']=$row['id'];
  $_SESSION['pos']=$row['pos'];
  $con->close();
  header("location: /");
  exit;
}
else {
  echo'<script>swal(
  \'Oops...\',
  \'Data Base Error Try Again ! '.mysqli_real_escape_string($con,$con->error).'\',
  \'error\'
)</script>';}
}
}
function check($id){
  if($id[0]!='l'&&$id[0]!='y')
  return false;
  if($id[1]!='1')
  return false;
  if($id[2]!='1'&&$id[2]!='2'&&$id[2]!='3'&&$id[2]!='4'&&$id[2]!='5'&&$id[2]!='6')
  return false;
  if(!(($id[3]=='c'&&$id[4]=='s')||($id[3]=='c'&&$id[4]=='e')||($id[3]=='c'&&$id[4]=='h')||($id[3]=='e'&&$id[4]=='e')||($id[3]=='m'&&$id[4]=='e')||($id[3]=='i'&&$id[4]=='t')||($id[3]=='e'&&$id[4]=='c')))
  return false;
  if($id[5]!='1'&&$id[5]!='8'&&$id[5]!='9')
  return false;
  if($id[6]<'0'||$id[6]>'9')
  return false;
  if($id[7]<'0'||$id[7]>'9')
  return false;
  if($id[5]=='1'){
    if($id[6]!='0')
      return false;
    if($id[8]<'0'||$id[8]>'9')
      return false;
  }
  return true;
}
?>
<br/>
<h4 class="center">Registration Form</h4>
<div class="container">
  <br/><br/>
  <div class="row">
  <form id="form" action="" method="post">
    <div class="z-depth-3 row"><br/>
        <div class="input-field col l6 s12 ">
          <i class="material-icons prefix">account_circle</i>
        <input  type="text" name="reg1" id="reg1" required="required" class="validate"   >
        <label for="id1">Student #1 : Regd. No </label>
        </div>
        <div class="input-field col l6 s12">
          <i class="material-icons prefix">account_circle</i>
        <input  type="text" name="reg2" id="reg2" required="required" class="validate" >
        <label for="id2">Student #2 : Regd. No </label>
        </div>
        <div class="input-field col l6 s12">
          <i class="material-icons prefix">account_box</i>
        <input  type="text" name="name1" id="name1" required="required" class="validate" >
        <label for="name1">Student #1 : Full Name </label>
        </div>
        <div class="input-field col l6 s12">
          <i class="material-icons prefix">account_box</i>
        <input  type="text" name="name2" id="name2" required="required" class="validate" >
        <label for="name2">Student #2 : Full Name  </label>
        </div>
        <div class="input-field col l6 s12">
          <i class="material-icons prefix" >contact_mail</i>
        <input class="tooltipped validate" type="email" data-parsley-type="email"  name="email" id="email" data-tooltip="Password will be mailed" required="required"  >
        <label for="email">Student ## : Email </label>
        </div>
        <div class="input-field col l6 s12">
        <i class="material-icons prefix">contact_phone</i>
        <input  type="number" name="phno" id="phno" required="required" class="validate" >
        <label for="phno">Student ## : Phone Number  </label>
        </div>
        <div class="input-field col s12 l6">
          <i class="material-icons prefix">lock_outline</i>
        <input  type="password"  id="pass" required="required" data-parsley-minlength="6" class="validate" >
        <label for="username">Enter New Password </label>
        </div>
        <div class="input-field col s12 l6">
          <i class="material-icons prefix">lock</i>
        <input  type="password" name="pass" id="password" required="required" class="validate" >
        <label for="password">Re-enter Password</label>
      </div>
        <div class="input-field col l6 s12">
            <select name="year" id="year" required="required" class="validate" >
              <option value="" disabled selected>Year of Study</option>
              <option value="1">I/IV</option>
              <option value="2">II/IV</option>
              <option value="3">III/IV</option>
              <option value="3">IV/IV</option>
            </select>
          </div>
          <div class="input-field col l6 s12">
              <select name="branch" id="branch" required="required" class="validate" >
                <option value="" disabled selected>Branch of Study</option>
                <option value="1">Chemical</option>
                <option value="2">Civil</option>
                <option value="3">Computer Science</option>
                <option value="4">Electrical &amp; Communication </option>
                <option value="5">Electrical &amp; Electronics</option>
                <option value="6">Information Technology</option>
              </select>
            </div>
    </div>
    <center>
      <a id="submit" onclick="validate()" class="btn waves-effect waves-light z-depth-3" >Register
        <i class="material-icons right">send</i>
      </a>
      </center>
  </form>
</div>
</div>
<script>
document.title="Registration Form";
var flag=false;
function validate(){
  if($("#password").val()!=""&&$("#pass").val()!=""&&$("#reg1").val()!=""&&$("#reg2").val()!=""&&$("#email").val()!=""&&$("#phno").val()!=""&&$("#name1").val()!=""&&$("#name2").val()!=""&&$("#year").val()!=""&&$("#branch").val()!=""){
    if($("#pass").val()!=$("#password").val())
    {
      swal('Oops...','Passwords Doesn\'t match','error');
        return flag;
    }
    else
   check($("#reg1").val(),$("#reg2").val(),$("#email").val(),$("#phno").val());
 }
   else {
     $('#form').submit();
   }
   return flag;
}
function check(reg1,reg2,email,phno){
  var request = $.ajax({
    url: "./?check=1",
    method: "POST",
    data: { reg1 : reg1, reg2:reg2, email:email, phno:phno },
    dataType: "html"
  });
  request.done(function( msg ) {
    flag=true;
    data="";
    if($('#reg1').val()==$('#reg2').val()){
      flag=false;
      data="Same Registration Id's<br/>"
      }
    if(msg.includes("reg1")){
      flag=false;
        data+=$('#reg1').val()+" Already Registered.<br/>";
      $('#reg1').val('');
    }
    if(msg.includes("reg2")){
      flag=false;
      data+=$('#reg2').val()+" Already Registered.<br/>";
      $('#reg2').val("");
    }
    if(msg.includes("email")){
      flag=false;
      data+=$('#email').val()+" Already Registered.</br>";
      $('#email').val("");
    }
    if(msg.includes("phno")){
      flag=false;
      data+=$('#phno').val()+" Already Registered.<br/>";
      $('#phno').val("");
    }
    if(flag==false)
    swal({
  title: 'Errors Encountered',
  text: data,
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Ask Volunteer'
});
    else
    $('#form').submit();
  });
  request.fail(function( jqXHR, textStatus ) {
    check(reg1,reg2,email,phno);
  });
}
</script>
<?php require '../../init/footer.php';?>
