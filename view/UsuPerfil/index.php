<?php
  /* Llamamos al archivo de conexion.php */
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usuarioId"])){
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php require_once("../html/head.php"); ?>

    <title>Empresa::Perfil</title>
  </head>

  <body>

    <?php require_once("../html/menu.php"); ?>

    <?php require_once("../html/header.php"); ?>

    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Perfil</a>
        </nav>
      </div>
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Perfil</h4>
        <p class="mg-b-0">Pantalla Perfil</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Perfil</h6>
          <p class="mg-b-30 tx-gray-600">Actualize sus datos</p>

          <div class="form-layout form-layout-1">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usuarioNombre" id="usuarioNombre" placeholder="Nombre" required>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Apellido Paterno: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usuarioApellidoPaterno" id="usuarioApellidoPaterno" placeholder="Apellido Paterno">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Apellido Materno: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usuarioApellidoMaterno" id="usuarioApellidoMaterno" placeholder="Apellido Materno">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Correo Electronico: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usuarioCorreo" id="usuarioCorreo" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Contraseña: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usuarioPassword" id="usuarioPassword" placeholder="Ingrese Contraseña">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group mg-b-10-force">
                  <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="usuarioSexo" id="usuarioSexo" data-placeholder="Seleccione">
                    <option label="Seleccione"></option>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Telefono: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="number" name="usuarioTelefono" id="usuarioTelefono" placeholder="Ingrese Telefono">
                </div>
              </div>
            </div>

            <div class="form-layout-footer">
              <button class="btn btn-info" id="btnactualizar">Actualizar</button>
            </div>
          </div>

        </div>
      </div>
    </div>

    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="usuperfil.js"></script>
  </body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
    header("Location:".Conectar::ruta()."view/404/");
  }
?>