<div class="content-wrapper">
  <section class="content-header">
    <h3>Usuarios</h3>
  </section>
    <section class="content">
      <div class="box">
        <div class="panel-heading">
          <h4><i class="fa fa-user"></i> Consulta de Usuarios<span class="pull-right">
              <a href="agregarUsuario" class="btn btn-primary" title="Agregar usuario">Agregar Usuario</a>
              <button name="btn_upd_usuarios" id="btn_upd_usuarios" class="btn btn-primary " title="Actualizar"><span class="glyphicon glyphicon-refresh"></span></button></span>
          </h4>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tablaUsuarios" id="tablaUsuarios" width="100%">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Usuario</th>
                <th>Fecha ingreso</th>
                <th>Fecha modificación</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th>Último login</th>
                <th>Acciones</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
        <!--Modal ver usuarios-->
        <div id="modalVerUsuario" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <!-- cabeza del Modal-->
              <div class="modal-header" style="background:#3c8dbc; color:white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Datos del Usuario</h4>
              </div>
              <!-- cuerpo del Modal-->
              <div class="modal-body">
                <div class="box-body">
                  <div class="row">
                    <table width="547" border="0" align="center">
                      <tbody>
                        <tr>
                          <td width="171" rowspan="10"><div align="center"><img id="imagenUsuario" src="" border="1" width="100" height="120" data-rel="tooltip"></div></td>
                        </tr>
                        <tr>
                          <td><strong>Nombres:</strong> <strong id="Vernombre"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Apellidos:</strong> <strong id="Verapellido"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Email:</strong> <strong id="Veremail"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Usuario:</strong> <strong id="Verusuario"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Fecha ingreso:</strong> <strong id="verFechaingreso"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Fecha modificación:</strong> <strong id="verFechamodificacion"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Último inicio de sesión:</strong> <strong id="UltimoLogin"></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Estado:</strong><strong id="Verestado"></strong></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- pie del Modal-->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
              </div>
            </div>
          </div>
        </div>
        <!--MODAL EDITAR USUARIO-->
        <div id="modalEditarUsuario" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <form role="form" method="post" enctype="multipart/form-data" id="frmEditarUsuario">
                <!--CABEZA DEL MODAL-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Editar usuario</h4>
                </div>
                <!--CUERPO DEL MODAL-->
                <div class="modal-body">
                  <div class="box-body">
                    <!-- ENTRADA PARA EL NOMBRE -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="50" id="editarNombres" onpaste="return false" oncut="return false" oncopy="return false" name="editarNombres" placeholder="Ingresar nombre(s)">
                        <div class="text-danger" id="errorNombreEd"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA APELLIDOS -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="50" id="editarApellidos" onpaste="return false" oncut="return false" oncopy="return false" name="editarApellidos" placeholder="Ingresar apellidos">
                        <div class="text-danger" id="errorApellidosEd"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA EL EMAIL -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span> 
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="50" id="editarEmail" onpaste="return false" oncut="return false" oncopy="return false" name="editarEmail" placeholder="Ingresar email">
                        <div class="text-danger" id="errorEmailEd"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA EL USUARIO -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" autocomplete="off" maxlength="15" minlength="8" id="editaUsuario" onpaste="return false" oncut="return false" oncopy="return false" name="editaUsuario" placeholder="Ingresar usuario">
                        <div class="text-danger" id="errorUsuarioEd"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA LA CONTRASEÑA -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                        <input type="password" class="form-control input-lg" autocomplete="off" maxlength="15" id="editarPassword" name="editarPassword" onpaste="return false" oncut="return false" oncopy="return false" placeholder="Escriba la nueva contraseña">
                        <div class="text-danger" id="errorPasswordEd"></div>
                      </div>
                    </div>
                    <!-- ENTRADA PARA LA CONTRASEÑA(VERIFICAR) -->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                        <input type="password" class="form-control input-lg" autocomplete="off" maxlength="15" id="editarPassword1" name="editarPassword1" onpaste="return false" oncut="return false" oncopy="return false" placeholder="Repetir la nueva contraseña">
                        <div class="text-danger" id="errorPasswordEd1"></div>
                      </div>
                    </div>  
                    <!-- ENTRADA PARA SUBIR FOTO src="vistas/img/usuarios/default user.png" -->
                    <div class="form-group">
                      <div class="panel">Subir foto</div>
                        <input type="file" onpaste="return false" oncut="return false" oncopy="return false" maxlength="120" class="file" size="10" data-original-title="Subir foto" data-rel="tooltip" placeholder="Subir imagen" name="nuevaImagen" id="nuevaImagen">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img  id="previsualizar" class="img-thumbnail previsualizar" width="100px">
                      </div>
                    </div>
                  </div>
                  <!--PIE DEL MODAL-->
                  <div class="modal-footer">
                    <button type="button" class="btn btn pull-left btn-cancelar-upd-user"><i class="fa fa-ban"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-upd-usuario" id="btn-upd-usuario"><i class="fa fa-pencil"></i> Modificar usuario</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </section>
</div>