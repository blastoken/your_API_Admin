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
  <img class="col align-self-center shadow rounded-circle mt-3 w-75" src="imgs/img_user_prova.png" alt="Imagen de perfil">
    <div class="card-body col">
      <h4 class="card-title text-center font-weight-bold"><?php echo $_SESSION['usuarioLogueado']['user']; ?></h4>
      <p class="card-text">

      </p>
    </div>
  </div>
</div>
<script>
  cambiarPaginaActivaSide();
</script>
