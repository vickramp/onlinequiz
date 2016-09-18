<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if(isset($_GET['mail']))
  $sql='delete from users where email=\''.$_POST['id'].'\'';
else
  $sql='delete from users where reg1=\''.$_POST['id'].'\' or reg2=\''.$_POST['id'].'\'';
require_once '../init/dbconfig.php';
echo $sql;
$con=connectdb('test');
$con->query($sql);
$con->close();
exit;
}
if(!isset($_SESSION))
  session_start();
if(!isset($_SESSION['admin']))
  {
    header("location: /");
    exit;
  }
 ?><br/><br/><br/>
 <div class="container">
   <div class="row">
     <div class="col s12 l6">
       <a class="col s12 waves-effect green darken-4 waves-light btn-large " href="./addquestion">Add Questions</a>
     </div>
     <div class="col s12 l6">
       <a class="col s12 waves-effect green darken-4 waves-light btn-large " href="./addquestion?viewall=1">View / Edit Questions</a>
     </div><br/><br/><br/>
     <div class="col s12 l6">
       <a class="col s12 waves-effect green darken-4 waves-light btn-large " href="./list">Complete Stats</a>
     </div>
     <div class="col s12 l6">
       <a class="col s12 waves-effect green darken-4 waves-light btn-large " href="./list?selected=1">Selected List</a>
     </div><br/><br/><br/>
     <div class="col s12 l6">
       <a onclick="configure(true)" class="col s12 waves-effect green darken-4 waves-light btn-large " >Cofigure DataBase</a>
     </div>
     <div class="col s12 l6">
       <a onclick="configure(false)" class="col s12 waves-effect green darken-4 waves-light btn-large " >Reset DataBase</a>
     </div>
   <br/><br/><br/>
   <div class="col s12 l6">
     <a onclick="resetuser()" class="col s12 waves-effect green darken-4 waves-light btn-large " >Reset user with Regd no.</a>
   </div>
   <div class="col s12 l6">
     <a onclick="resetemail()" class="col s12 waves-effect green darken-4 waves-light btn-large " >Reset user with Email</a>
   </div>
   </div>
</div>
</div>
<script>
function configure(i){
var str;
  if(i==true)
  str='../init/';
  else {
    str='../init/?destroy';
  }
  var request = $.ajax({
    url: str,
    method: "GET"   });
  request.done(function( msg ) {
    swal(
      'Good job!',
      'Done',
      'success'
    )
  });
  request.fail(function( jqXHR, textStatus ) {configure(i)});
}

  function resetuser(){
    swal({
      title: 'Reset using with regdno.',
      input: 'text',
      showCancelButton: true,
      confirmButtonText: 'Submit',
      showLoaderOnConfirm: true,
      preConfirm: function(email) {
        return new Promise(function(resolve, reject) {
          var request = $.ajax({
            url: "./admin.php?reg=1",
            method: "POST",
            data: { id: email }   });
          request.done(function( msg ) {
            swal(
              'Good job!',
              'Done',
              'success'
            )
          });
          request.fail(function( jqXHR, textStatus ) {
            swal(
              'Failed!',
              'Network Error',
              'error'
            )
          });

        });
      },
      allowOutsideClick: false
    });

  }
function resetemail(){  swal({
    title: 'Reset using with email.',
    input: 'email',
    showCancelButton: true,
    confirmButtonText: 'Submit',
    showLoaderOnConfirm: true,
    preConfirm: function(email) {
      return new Promise(function(resolve, reject) {
        var request = $.ajax({
          url: "./admin.php?mail=1",
          method: "POST",
          data: { id: email }   });
        request.done(function( msg ) {
          swal(
            'Good job!',
            'Done',
            'success'
          )
        });
        request.fail(function( jqXHR, textStatus ) {
          swal(
            'Failed',
            'Network Error',
            'error'
          )
        });

      });
    },
    allowOutsideClick: false
  });
}

</script>
