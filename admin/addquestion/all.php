  <a class="waves-effect waves-green btn-flat left" href="/admin">Go Back</a>
<div class="container"><br/><br/><br/><br/>

<?php
if(!isset($_SESSION))
  session_start();
if(!isset($_SESSION['admin']))
  {
    header("location: /");
    exit;
  }
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  require '../../init/dbconfig.php';
  $con=connectdb("test");
  $sql='delete from question where id='.$_POST['id'];
  $con->query($sql);
  $con->close();
  exit;
}
require '../../init/dbconfig.php';
$con=connectdb("test");
$sql='select * from question';
$ans=$con->query($sql);
$count=1;
while($sol=$ans->fetch_assoc()){
  echo'<div class="col s12 " id="card'.$count.'">
     <div class="card horizontal">
     <div class="card-stacked">
       <div class="row">
         <div class="col l1">
           <div class="center">  '.$count.'</div>
         </div>
         <div class="col l10">
           <pre class="card-content " style="font-size:25px" id="question" >'.$sol['question'].'</pre>
         </div>
         <div class="l1">
             <a onclick="removeElement('.$sol['id'].','.$count++.')" class="btn-floating btn red"><i class="material-icons">delete</i></a>
         </div>
       </div>
       <div class="card-action ">
         <div class="row">
           <div class="col s12 l6">
           <div id="labans1" style="font-size:20px" for="ans1">A '.$sol['opt1'].'</div>
         </div>
           <div class="col s12 l6">
             <div id="labans2" style="font-size:20px" for="ans2">B '.$sol['opt2'].'</div>
           </div>
            <div class="col s12 l6">

  <div id="labans3" style="font-size:20px" for="ans3">C '.$sol['opt3'].'</div>    </div>
  <div class="col s12 l6">
   <div id="labans4" style="font-size:20px" for="ans4">D '.$sol['opt4'].'</div></div>
<div class="col l12">Ans: '.getAns($sol['ans']&15).'</div>
  </div> </div></div>  </div>

  </div>';



}
$con->close();
function getAns($i){
  switch($i){
    case 1: return 'A';
    case 2: return 'B';
    case 3:return 'C';
    case 4: return 'D';
  }
}
?>
</div>
 <script>
function removeElement(i,j){
    var request = $.ajax({
      url: "./all.php",
      method: "POST",
      data: { id: i }   });
    request.done(function( msg ) {
      $('#card'+j).remove();
    });
    request.fail(function( jqXHR, textStatus ) {removeElement(i,j)});
}
</script>
<?php require '../../init/footer.php' ?>
