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
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('S C=0,9,7=0;S o;a V(){S w=$.1G({1y:"./1x.1w",1u:"1H",9:{9:"28"}});w.1A(a(Q){9=29.2a(Q.1a(/(?:\\r\\n|\\r|\\n)/g,\' \').1a(/&26;/g,\'<e />\'));C=9[\'7\'].23-1;$(\'#c\').Z(\'N\');$("#c").L("z",c)});w.1D(a(1B,1C){V()})}V();a c(){14(!d.k(\'24\').J){25(\'2b..\',\'2c 2i 2j 2k 2h 2g!\',\'2d\');2e}$(\'#2f\').12();7=1;$(\'#1E\').22();$(\'#P\').1e(\'<5 6="o 1I s m 20"></5><5 6="s m D "><19>1Q <b 7="1l">1</b> 1R <b>\'+C+\'</b> </19></5>\');$(\'#P\').1e(\'<1d 7="c" 6=" 18-1O 18-1M 1S t"><i 6="1c-1j t">1v</i>21</1d><5 6="s m ">    <5 6="F 1U">        <5 6="F-1Y">        <1o 6="F-1X" 7="M" E="B-x:y">\'+9[\'7\'][0].M+\'</1o>        <5 6="F-1W ">        <p 6="s m D">      <u v="l" U="1" W="T" 7="1h" />      <h 7="1m" E="B-x:y" A="1h">\'+9[\'7\'][0].1r+\'</h>    </p>    <p 6="s m D">      <u v="l" U="2" W="T" 7="1g" />      <h 7="1q" E="B-x:y" A="1g">\'+9[\'7\'][0].1p+\'</h></p>    <p 6="s m D">      <u v="l" U="3" W="T" 7="1i" />      <h 7="1n" E="B-x:y" A="1i">\'+9[\'7\'][0].1s+\'</h>    </p>    <p 6="s m D">      <u v="l" W="T" U="4" 7="1k" />      <h 7="1t" E="B-x:y" A="1k">\'+9[\'7\'][0].17+\'</h>    </p>    </5>    </5>  </5></5>\');$("#c").L("z",16);o=$(\'.o\').2N(10,{2D:\'2E\',2s:2t,2r:1b,2q:{2n:a(){X()}}});o.2o(2p);o.V()}$(2u).2v({2B:a(G){G.1f()},2C:a(G){G.1f()}});a 16(){$(\'#c\').2w(\'N\');$("#c").2x("z");9[\'7\'][7-1].11=R($(\'u[v=l]:J\').1J());7++;d.k("1l").q=7;d.k("M").q=9[\'7\'][7-1].M;d.k("1m").q=9[\'7\'][7-1].1r;d.k("1q").q=9[\'7\'][7-1].1p;d.k("1n").q=9[\'7\'][7-1].1s;d.k("1t").q=9[\'7\'][7-1].17;$(\'u[v="l"]\').2m(\'J\',1b);14(7==C){d.k("c").q=\'<i 6="1c-1j t">1v</i>1P 1T\';1K(a(){$("#c").L("z",X);$(\'#c\').Z(\'N\')},1L)}1N 1K(a(){$(\'#c\').Z(\'N\');$("#c").L("z",16)},1L)}a X(){9[\'7\'][7-1].11=R($(\'u[v=l]:J\').1J());$(\'#P\').1F(\'<e/><e/><e/><e/><e/><e/><e/><e/> <5  6="13 P 1I">   <5 6="2F-2M 2G 2L">      <5 6="f-K f-2l">        <5 6="8-j H">          <5 6="8"></5>        </5><5 6="I-O">          <5 6="8"></5>        </5><5 6="8-j t"><5 6="8"></5>  </5>      </5>    <5 6="f-K f-2y">        <5 6="8-j H">          <5 6="8"></5>        </5><5 6="I-O">          <5 6="8"></5>        </5><5 6="8-j t">        <5 6="8"></5></5>      </5>     <5 6="f-K f-2z"><5 6="8-j H">    <5 6="8"></5>        </5><5 6="I-O">          <5 6="8"></5>      </5><5 6="8-j t">          <5 6="8"></5></5>      </5>      <5 6="f-K f-2A">        <5 6="8-j H">          <5 6="8"></5>        </5><5 6="I-O">          <5 6="8"></5>        </5><5 6="8-j t">          <5 6="8"></5>        </5>      </5>    </5></5>\');Y=0;A(i=0;i<C;i++){14(R((9[\'7\'][i].7)&15)==R(9[\'7\'][i].11))Y++}S w=$.1G({1y:"./1x.1w?2H=1",1u:"1H",9:{2I:Y,2K:o.1z.1z}});w.1A(a(Q){$(\'.13\').12();$(\'#13\').1F(Q);$(\'#1E\').1V();$(\'#1Z\').12()});w.1D(a(1B,1C){X()})}d.27="2J";',62,174,'|||||div|class|id|circle|data|function||next|document|br|spinner||label||clipper|getElementById|group1|s12||clock||innerHTML||col|right|input|name|request|size|20px|click|for|font|count|l6|style|card|ev|left|gap|checked|layer|on|question|disabled|patch|container|msg|parseInt|var|radio|value|start|type|finishTest|sum|removeClass||user|remove|newadd|if||nextQuestion|option4|waves|h4|replace|false|material|button|append|preventDefault|ans2|ans1|ans3|icons|ans4|quesnum|labans1|labans3|pre|option2|labans2|option1|option3|labans4|method|send|php|contest|url|time|done|jqXHR|textStatus|fail|login|replaceWith|ajax|POST|center|val|setTimeout|500|light|else|effect|Finish|Question|of|btn|Test|horizontal|show|action|content|stacked|script|l3|Next|hide|length|terms|swal|NewLine|title|new|JSON|parse|Oops|Accept|error|return|tandc|Conditions|And|To|The|Terms|blue|prop|stop|setTime|1200|callbacks|autoStart|countdown|true|window|bind|addClass|off|red|yellow|green|beforeunload|unload|clockFace|MinuteCounter|preloader|big|finish|score|Quiz|tme|active|wrapper|FlipClock'.split('|'),0,{}))
</script>
</div>
