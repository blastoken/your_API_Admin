<div class="sidebar-container">
  <div class="sidebar-logo row justify-content-center">
    <a class="col align-self-center txtVioletaClar mr-2" href="index.php">
      <img class="zoomOutRotative float-left pr-2" src="imgs/logo.png" alt="sistema" height="40px">
      <h6 class="h-100 pt-2">Your API Admin</h6>
    </a>
  </div>
  <ul id="menuLateral" class="sidebar-navigation">
    <li class="header">Personal</li>
    <li>
      <a href="controlPanel.php">
        <i class="fa fa-home" aria-hidden="true"></i> Inicio
      </a>
    </li>
    <li>
      <a href="perfilyaa.php">
        <i class="fa fa-user" aria-hidden="true"></i> Perfil
      </a>
    </li>
    <li class="header">Administración</li>
    <li>
      <a href="bbddyaa.php">
        <i class="fa fa-database" aria-hidden="true"></i> Bases de Datos
      </a>
    </li>
    <li>
      <a href="apiyaa.php">
        <i class="fa fa-code" aria-hidden="true"></i> APIs
      </a>
    </li>
    <li>
      <a href="infoyaa.php">
        <i class="fa fa-info-circle" aria-hidden="true"></i> Información
      </a>
    </li>
    <li>
      <a href="cerrarSesion.php">
        <i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesión
      </a>
    </li>
    <li class="header">Usuario actual:</li>
  </ul>
  <div class="card fondoGrisOscuro cardNoBorder row justify-content-center">
    <div class="col align-self-center mt-3 ml-2">
      <img class="rounded-circle" src="<?php echo $_SESSION['usuarioLogueado']['img']; ?>" alt="Imagen de perfil" height="200px" width="200px">
    </div>
    <form method="post" action="cambioImagen.php" enctype="multipart/form-data" class="col align-self-center float-left position-absolute align-top h-75 ml-4">
      <input type="hidden" id="page" name="page" value="<?php echo "controlPanel.php"; ?>" />
      <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['usuarioLogueado']['id']; ?>" />
      <label for="img"><img src="imgs/img.png" alt="Cambiar Imagen" height="40px"></label>
      <input type="file" id="img" name="img" class="invisible" onchange="this.form.submit()"/>
    </form>
    <div class="card-body col text-center position-relative">
      <h4 class="card-title font-weight-bold"><?php echo $_SESSION['usuarioLogueado']['nombre']; ?></h4>
      <p class="card-text">
        <?php
        $registro = strtotime($_SESSION['usuarioLogueado']['registro']);
        $fecha_registro = array();
        $fecha_registro[0] = date('Y/m/d', $registro);
        $fecha_registro[1] = date('H:i', $registro);
         ?>
        Registrado el <?php echo $fecha_registro[0].'<br /> a las '.$fecha_registro[1]."h"; ?>
      </p>
    </div>
  </div>
</div>
<?php
  /*Error d'exemple*/
  $_SESSION['errores'] = array();
  array_push($_SESSION['errores'],"No se ha podido verificar tu cara de rata");
  /**/
if(isset($_SESSION['errores'])){ ?>
<div class="zoomIn" aria-live="polite" aria-atomic="true" style="position: absolute; top: 0; right: 0; width: 200px;">
  <div class="toast bg-danger" style="position: absolute; top: 0; right: 0;" data-autohide="false">
    <div class="toast-header">
      <strong class="mr-auto text-danger">Han ocurrido errores</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body text-light">
      <?php foreach ($_SESSION['errores'] as $key => $error): ?>
        <p><?php echo $error; ?></p>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php }
unset($_SESSION['errores']);
?>
<script>
  $('.toast').toast('show');
  cambiarPaginaActivaSide();
</script>
