<?php require '../../init/header.php';
if(isset($_GET['viewall'])){
  require 'all.php';
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
require'../../init/dbconfig.php';
$con=connectdb('test');
$sql="insert into question(question,opt1,opt2,opt3,opt4,ans) values('".trim(mysqli_real_escape_string($con, $_POST['question']))."','".trim(mysqli_real_escape_string($con, $_POST['optiona']))."','".trim(mysqli_real_escape_string($con, $_POST['optionb']))."','".trim(mysqli_real_escape_string($con, $_POST['optionc']))."','".trim(mysqli_real_escape_string($con, $_POST['optiond']))."',".$_POST['group1'].")";
if($con->query($sql)===true){
echo'<script>  swal(
  \'success!!\',
  \'Question has been added\',
  \'success\'
);
</script>';
}
else{
  $co=$con->error;
  echo'<script>  swal(
    \'failed!!\',
    \'Unable to add question'.mysqli_real_escape_string($con,$co).'\',
    \'error\'
  );
  </script>';
}
}
function printnum($num){
switch($num){
    case 1:return rand(32,65000)&96|1;
    case 2:return rand(32,65000)&96|2;
    case 3:return rand(32,65000)&96|3;
    case 4:return rand(32,65000)&96|4;
  }
}
?>
<div class="container">
<div class="row"><br/><br/><br/>
<form action="" method="post">
<div class="col s12 ">
    <div class="card horizontal">
      <div class="card-stacked">
        <div class="card-content center">
                  <div class="input-field col s12">
          <textarea id="question" name="question" class="materialize-textarea"></textarea>
            <label for="question">Question</label>
          </div>
        </div>

      <div class="card-action ">
      <div class="input-field col s12 l6">
          <div class="row">
          <div class="col s12">
            <input name="group1" type="radio" required="required" value="<?php echo printnum(1);?>"  id="test1" />
            <label for="test1"></label>
          </div>
          <div class="input-field   col s12">
            <textarea id="optiona" name="optiona" class="materialize-textarea"></textarea>
          <label for="optiona">Option - A</label>
        </div>
      </div>
        </div>

        <div class="input-field col s12 l6">
          <div class="row">
          <div class="col s12">
            <input name="group1" type="radio" required="required" value="<?php echo printnum(2);?>" id="test2" />
            <label for="test2"></label>
          </div>
          <div class="input-field   col s12">
            <textarea id="optionb" name="optionb" class="materialize-textarea"></textarea>
          <label for="optionb">Option - B</label>
        </div>
      </div>
        </div>

        <div class="input-field col s12 l6">
          <div class="row">
          <div class="col s12 ">
            <input name="group1" type="radio" required="required" value="<?php echo printnum(3);?>" id="test3" />
            <label for="test3"></label>
          </div>
          <div class="input-field   col s12">
            <textarea id="optionc" name="optionc" class="materialize-textarea"></textarea>
          <label for="optionc">Option - C</label>
        </div>
      </div>
        </div>


        <div class="input-field col s12 l6">
          <div class="row">
          <div class="col s12">
            <input name="group1" required="required" value="<?php echo printnum(4);?>" type="radio" id="test4" />
            <label for="test4"></label>
          </div>
          <div class="input-field   col s12">
            <textarea id="optiond" name="optiond" class="materialize-textarea"></textarea>
          <label for="optiond">Option - D</label>
        </div>
      </div>
        </div>



        </div>

      </div>
    </div>
    <a href="/admin" class=" waves-effect waves-light btn left"><i class="material-icons left" style="-webkit-transform: rotate(180deg);    -moz-transform: rotate(180deg);    -o-transform: rotate(180deg);    -ms-transform: rotate(180deg);    transform: rotate(180deg);">send</i>Go back</a>

 <button  type="submit" class=" waves-effect waves-light btn right"><i class="material-icons right">send</i>Add Question</button>
</div>

</form>
</div>
</div>



<?php require '../../init/footer.php';?>
