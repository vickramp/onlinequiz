<?php require'../../init/header.php';
if(!isset($_SESSION['admin']))
  {
    header("location: /");
    exit;
  }
?>
<a class="waves-effect waves-green btn-flat left" href="/admin">Go Back</a>
<div class="row">
<table class=" bordered col s12" >
        <thead>
          <tr>
              <th data-field="id1">Reg #1</th>
              <th data-field="name1">name #1</th>
              <th data-field="id2">Reg #2</th>
              <th data-field="name2">name #2</th>
              <th data-field="email">Email</th>
              <th data-field="score">Score</th>
              <th data-field="time left">Time Left</th>
          </tr>
        </thead>
        <tbody>
<?php
  require '../../init/dbconfig.php';
  $con=connectdb("test");
if(isset($_GET['selected'])){
$q='select id from users order by score,tme limit 25';
$res=$con->query($q);
$q='create table tmp(num int)';
$con->query($q);
while($ans=$res->fetch_assoc()){
  $q='insert into tmp values('.$ans['id'].')';
  $con->query($q);
}
for($i=1;$i<=6;$i++){
  $q='select id from users where branch='.$i.' order by score,tme limit 3';
  $res=$con->query($q);
  while($ans=$res->fetch_assoc()){
    $q='insert into tmp values('.$ans['id'].')';
    $con->query($q);
  }
}
  $sql='select distinct * from users where id in(select id from tmp) order by score,tme';
  $ans=$con->query($sql);
  $sql='drop table tmp';
  $con->query($sql);
}
else{
  $sql='select * from users order by score,tme';
  $ans=$con->query($sql);
}
  while($sol=$ans->fetch_assoc()){
      echo'<tr>
        <td>'.$sol['reg1'].'</td>
        <td>'.$sol['name1'].'</td>
        <td>'.$sol['reg2'].'</td>
        <td>'.$sol['name2'].'</td>
        <td>'.$sol['email'].'</td>
        <td>'.$sol['score'].'</td>
        <td>'.$sol['tme'].'</td>
      </tr>';
  }
  $con->close();
 ?>
      </tbody>
    </table>
</div>
<?php require '../../init/footer.php';?>
