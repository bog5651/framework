{extends file="./page.tpl"}
{block name="content"}
  <div class="row">
    <div class="col col-6 justify-content-center">
      <div class="card card-second">
        <div class="card-header">
          <h3>Login</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="http://{$base_url}login">
            <div class="form-group">
              <label>Login</label>
              <input class="form-control" type="text" name="login" placeholder="Login or e-mail">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <input class="btn btn-block btn-second" type="submit" value="Login">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
{/block}