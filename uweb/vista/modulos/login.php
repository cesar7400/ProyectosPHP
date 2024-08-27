<!--imagen de fondo-->
<div id="back"></div>
<div class="div-center-login">
  <div class="login-box">
    <div class="login-box-body">
      <p class="login-box-msg">Iniciar sesión</p>
      <form method="post" name="FrminicioSesion">
        <div class="form-group has-feedback">
          <input type="text" onpaste="return false" oncut="return false" oncopy="return false" value="admin@correo.com" maxlength="25" class="form-control" placeholder="Usuario o email" name="loginUsuario" style="border-radius: 15px" autocomplete="off">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" onpaste="return false" oncut="return false" oncopy="return false" value="12345678" maxlength="15" class="form-control" placeholder="Contraseña" name="LoginContrasena" style="border-radius: 15px">
          <span class="glyphicon glyphicon-lock form-control-feedback" style="border-radius: 5px"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btninicioSesion btn btn-primary btn-block btn-flat" style="border-radius: 5px"><i class="fa fa-sign-in"></i> Ingresar</button>
          </div>
        </div>
        <br><div id="errorLogin"></div>
        <?php
          $login = new ControladorUsuario();
          $login -> ctrLoginUsuario();
        ?>
      </form>
    </div>
  </div>
</div>
