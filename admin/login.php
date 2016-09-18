
<br/>
<h4 class="center">Admin Console</h4>
<div class="container">
  <br/><br/>
  <div class="row">
  <form id="form" action="" method="post">
    <div class="row">
      <div class="col s12 l6 offset-l3 z-depth-3"><br/>
      <div class="input-field col s12">
        <i class="material-icons prefix">person_outline</i>
      <input  type="text" name="email" id="username" required="required" class="validate" >
      <label for="username">User name </label>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">lock_outline</i>
      <input  type="password" name="pass" id="password" required="required" class="validate" >
      <label for="password">Password</label><br/>
      </div>
      <br/><br/><br/><br/><br/><br/><br/><br/>
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
document.title="Admin Console Login in";
function validate(){
  $('#form').submit();
}
</script>
</div>
