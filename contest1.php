<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'&&isset($_GET['finish'])){
  session_start();
  require 'init/dbconfig.php';
  $con=connectdb("test");
  $sql='update users set pos=1 where id= '.$_SESSION['userid'];
  $res=$con->query($sql);
  $sql='update users set score='.$_POST['score'].' where id= '.$_SESSION['userid'];
  $res=$con->query($sql);
  $sql='update users set tme='.$_POST['tme'].' where id= '.$_SESSION['userid'];
  $res=$con->query($sql);
  $_SESSION['pos']=1;
  $con->close();
  require 'finish.php';
  exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
session_start();
  require 'init/dbconfig.php';
  $con=connectdb("test");
  $sql='select * from question order by rand() limit 30 ';
  $res=$con->query($sql);
echo ' { "id" : [ ';
while($ans=$res->fetch_assoc())
echo'{"question" : "'.htmlentities($ans['question'], ENT_QUOTES|ENT_HTML5, "UTF-8").'", "option1" : "'.htmlentities($ans['opt1'], ENT_QUOTES|ENT_HTML5, "UTF-8").'" , "option2" : "'.htmlentities($ans['opt2'],ENT_QUOTES| ENT_HTML5, "UTF-8").'" , "option3" : "'.htmlentities($ans['opt3'], ENT_QUOTES|ENT_HTML5, "UTF-8").'" , "option4" : "'.htmlentities($ans['opt4'],ENT_QUOTES| ENT_HTML5, "UTF-8").'" , "id" : '.$ans['ans'].' , "user" : 0},';
echo'{"question" : "dummy" , "option1" : "None" , "option2" : "None" , "option3" : "None" , "option4" : "None" , "id" : 0 , "user" : 0 }]}';
$con->close();
$_SESSION['pos']=1;
exit;
}

 ?>
<br/><br/>
<div id="container" class="container row">
  <div id="tandc">
  <h4 id="form" class="header center">Rules and Regulations </h4>
<div class="col s12 ">
  <div class="card horizontal">
      <div class="card-stacked">
      <div class="card-content">
        <ul type="I" class="left">
        <li><i class="material-icons left">play_arrow</i> I am a very simple card. I am good at containing small bits of information.</li><br/>
        <li><i class="material-icons left">play_arrow</i> I am a very simple card. I am good at containing small bits of information.</li><br/>
        <li><i class="material-icons left">play_arrow</i> I am a very simple card. I am good at containing small bits of information.</li><br/>
        <li><i class="material-icons left">play_arrow</i> I am a very simple card. I am good at containing small bits of information.</li><br/>
        <li><i class="material-icons left">play_arrow</i> I am a very simple card. I am good at containing small bits of information.</li>
      </ul>
      </div>
      <div class="card-action ">
         <input type="checkbox" id="terms"  class="center" required="required" />
           <label for="terms">Agree to all Terms and Conditions.</label>
           <button id="next"  class="disabled waves-effect waves-light btn right"><i class="material-icons right">send</i>Start The Competition</button>      </div>
    </div>
  </div>
</div>
</div>
</div>
<div id="script">
<script>

var count=0,data,id=0;
var clock;

function start(){
  var request = $.ajax({
    url: "./contest.php",
    method: "POST",
    data: { data:"new" }   });
  request.done(function( msg ) {
    data=JSON.parse(msg.replace(/(?:\r\n|\r|\n)/g, ' ').replace(/&NewLine;/g, '<br />'));
    count=data['id'].length-1;
    $('#next').removeClass('disabled');
    $( "#next" ).on( "click", next );
  });
  request.fail(function( jqXHR, textStatus ) {start();});
}
start();
function next(){
  if(!document.getElementById('terms').checked){
    swal(  'Oops..',  'Accept To The Terms And Conditions!',  'error');
    return;
  }
  $('#tandc').remove();
  id=1;
  $('#login').hide();
  $('#container').append('<div class="clock center col s12 l3"></div><div class="col s12 l6 "><h4>Question <b id="quesnum">1</b> of <b>'+count+'</b> </h4></div>');
  $('#container').append('<button id="next" class=" waves-effect waves-light btn right"><i class="material-icons right">send</i>Next</button><div class="col s12 ">    <div class="card horizontal">        <div class="card-stacked">        <pre class="card-content" id="question" style="font-size:20px">'+data['id'][0].question+'</pre>        <div class="card-action ">        <p class="col s12 l6">      <input name="group1" value="1" type="radio" id="ans1" />      <label id="labans1" style="font-size:20px" for="ans1">'+data['id'][0].option1+'</label>    </p>    <p class="col s12 l6">      <input name="group1" value="2" type="radio" id="ans2" />      <label id="labans2" style="font-size:20px" for="ans2">'+data['id'][0].option2+'</label></p>    <p class="col s12 l6">      <input name="group1" value="3" type="radio" id="ans3" />      <label id="labans3" style="font-size:20px" for="ans3">'+data['id'][0].option3+'</label>    </p>    <p class="col s12 l6">      <input name="group1" type="radio" value="4" id="ans4" />      <label id="labans4" style="font-size:20px" for="ans4">'+data['id'][0].option4+'</label>    </p>    </div>    </div>  </div></div>');
  $( "#next" ).on( "click", nextQuestion );
    clock = $('.clock').FlipClock(10, {
        clockFace: 'MinuteCounter',
        countdown: true,
        autoStart: false,
        callbacks: {
          stop: function() {
            finishTest();
          }
        }
    });
    clock.setTime(1200);
        clock.start();
}
$(window).bind({
       beforeunload: function(ev) {
           ev.preventDefault();
       },
       unload: function(ev) {
           ev.preventDefault();
       }
   });
function nextQuestion(){
  $('#next').addClass('disabled');
  $( "#next" ).off( "click" );
  data['id'][id-1].user=parseInt($('input[name=group1]:checked').val());
  id++;
  document.getElementById("quesnum").innerHTML=id;
  document.getElementById("question").innerHTML=data['id'][id-1].question;
  document.getElementById("labans1").innerHTML=data['id'][id-1].option1;
  document.getElementById("labans2").innerHTML=data['id'][id-1].option2;
  document.getElementById("labans3").innerHTML=data['id'][id-1].option3;
  document.getElementById("labans4").innerHTML=data['id'][id-1].option4;
  $('input[name="group1"]').prop('checked', false);
  if(id==count){
    document.getElementById("next").innerHTML='<i class="material-icons right">send</i>Finish Test';
    setTimeout(function () {
      $( "#next" ).on( "click", finishTest );
      $('#next').removeClass('disabled');
    }, 500);
  }
  else
  setTimeout(function () {
    $('#next').removeClass('disabled');
    $( "#next" ).on( "click", nextQuestion );
  }, 500);
}
function finishTest(){
  data['id'][id-1].user=parseInt($('input[name=group1]:checked').val());
  $('#container').replaceWith('<br/><br/><br/><br/><br/><br/><br/><br/> <div  class="newadd container center">   <div class="preloader-wrapper big active">      <div class="spinner-layer spinner-blue">        <div class="circle-clipper left">          <div class="circle"></div>        </div><div class="gap-patch">          <div class="circle"></div>        </div><div class="circle-clipper right"><div class="circle"></div>  </div>      </div>    <div class="spinner-layer spinner-red">        <div class="circle-clipper left">          <div class="circle"></div>        </div><div class="gap-patch">          <div class="circle"></div>        </div><div class="circle-clipper right">        <div class="circle"></div></div>      </div>     <div class="spinner-layer spinner-yellow"><div class="circle-clipper left">    <div class="circle"></div>        </div><div class="gap-patch">          <div class="circle"></div>      </div><div class="circle-clipper right">          <div class="circle"></div></div>      </div>      <div class="spinner-layer spinner-green">        <div class="circle-clipper left">          <div class="circle"></div>        </div><div class="gap-patch">          <div class="circle"></div>        </div><div class="circle-clipper right">          <div class="circle"></div>        </div>      </div>    </div></div>');
  sum=0;
  for(i=0;i<count;i++){
    if(parseInt((data['id'][i].id)&15)==parseInt(data['id'][i].user))
    sum++;
  }
  var request = $.ajax({
    url: "./contest.php?finish=1",
    method: "POST",
    data: { score:sum,tme: clock.time.time} });
  request.done(function( msg ) {
    $('.newadd').remove();
    $('#newadd').replaceWith(msg);
    $('#login').show();
    $('#script').remove();
   });
  request.fail(function( jqXHR, textStatus ) {finishTest();});
}
document.title="Quiz";
</script>
</div>
