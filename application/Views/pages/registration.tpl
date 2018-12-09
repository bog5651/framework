{extends file="./page.tpl"}
{block name="content"}
  <div class="col-xs-12">
  <div class="card card-info">
    <div class="card-header">
      <h3>Registration</h3>
    </div>
    <div class="card-body">
      <form method="POST" action="http://{$base_url}registration">
        <div class="form-group">
          <label>Login</label>
          <input class="form-control" type="text" name="login" placeholder="Login">
        </div>
        <div class="form-group">
          <label>E-mail</label>
          <input class="form-control" type="text" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
          <label>Confirm password</label>
          <input class="form-control" type="password" name="confirm" placeholder="Confirm password">
        </div>
        <div class="form-group">
          <input class="form-control" class="btn btn-block btn-second" type="submit" value="Registration">
        </div>
      </form>
    </div>
  </div>
  </div>
  
  
    
    
    
    
    
  
{/block}