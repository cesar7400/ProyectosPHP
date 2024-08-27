<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h3>Registro de Usuario</h3>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box">
      <div class="panel-heading">
        <h4>
          <i class="fa fa-edit"></i>Agregar Usuario<span class="pull-right"></span>
          </h4>
        </div>
          <div class="box-body">
          <form class="form-horizontal" method="post" enctype="multipart/form-data" id="usuarioNuevo"> 
              
              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Nombres: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-user form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="50" class="form-control" name="nuevoNombre"  id="nuevoNombre" autocomplete="off" style="border-radius: 15px" placeholder="Ingresar nombre(s)" required>
                  <div class="text-danger" id="errorNombre"></div>
                </div>
              </div>
              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Apellidos: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-user form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="50" class="form-control" name="nuevoApellido"  id="nuevoApellido" autocomplete="off" style="border-radius: 15px" placeholder="Ingresar apellido(s)" required>
                  <div class="text-danger" id="errorApellido"></div>
                </div>
              </div>
              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Email: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-envelope-o form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="30" class="form-control validarEmail" name="nuevoEmail" id="nuevoEmail" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar email" required>
                  <div class="text-danger" id="errorEmail"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Usuario: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-user form-control-feedback"></i>
                  <input type="text" onpaste="return false" oncut="return false" oncopy="return false" maxlength="15" class="form-control validarUsuario" name="nuevoUsuario" id="nuevoUsuario" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar Usuario" required>
                  <div class="text-danger" id="errorUsuario"></div>
                </div>
              </div>
              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Contraseña: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-lock form-control-feedback"></i>
                  <input type="password" onpaste="return false" oncut="return false" oncopy="return false" maxlength="15" class="form-control" name="nuevoPassword" id="nuevoPassword" style="border-radius: 15px" autocomplete="off" placeholder="Ingresar contraseña" required>
                  <div class="text-danger" id="errorPassword"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Repetir contraseña: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <i class="fa fa-lock form-control-feedback"></i>
                  <input type="password" onpaste="return false" oncut="return false" oncopy="return false" maxlength="15" class="form-control" name="nuevoPassword2" id="nuevoPassword2" style="border-radius: 15px" autocomplete="off" placeholder="Repetir contraseña" required>
                  <div class="text-danger" id="errorPassword2"></div>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label class="col-sm-2 col-sm-2 control-label">Imagen: <span class="symbol required"></span></label>
                <div class="col-sm-10">
                  <input type="file" onpaste="return false" oncut="return false" oncopy="return false" maxlength="120" class="file" size="10" data-original-title="Subir foto" data-rel="tooltip" placeholder="Subir foto" name="nuevaImagen" id="nuevaImagen"/>
                  <small><p class="help-block">Tamaño maximo de la foto 2MB</p></small>
                  <img src="vista/img/usuarios/default user.png" class="img-thumbnail previsualizar" width="100px">
                </div>
              </div>

              <div class="modal-footer"> 
                <button class="btn btn-danger" id="btn-cancelar-user-add" name="btn-cancelar-user-add"><span class="fa fa-times"></span> Cancelar</button>
                <button name="btn-submit_add_user" id="btn-submit_add_user" class="btn btn-primary btn-user-add"><i class="fa fa-save"></i> Ingresar</button> 
                <a href="VerUsuarios" class="btn btn-success"><span class="fa fa-mail-reply "></span> Regresar</a>
              </div>
              <div id="mensaje"></div>
            </form>
          </div>
      </div>
    </section>
</div>