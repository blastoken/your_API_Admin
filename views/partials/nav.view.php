<div class="container-fluid">
    <div class="row justify-content-center p-3 fondoTopBar">
        <div class="col3 align-self-center pr-2">
          <img class="zoomOutRotative" src="imgs/logo.png" alt="sistema" height="50px">
        </div>
        <div class="col3 align-self-center">
          <h3 class="txtVioletaClar">Your API Admin</h3>
        </div>
        <div class="col6 align-self-center">
          <nav class="navbar navbar-expand-lg navbar-dark fondoTopBar">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul id="barraNavegacion" class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link blancoTexto" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="proyecto.php">Proyecto</a>
                </li>
                <?php if(isset($_SESSION['usuarioLogueado'])){?>
                <li class="nav-item">
                  <a class="nav-link" href="cerrarSesion.php">Cerrar Sesión</a>
                </li>
              <?php }else{ ?>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Log In</a>
                </li>
                <?php } ?>
              </ul>
            </div>
          </nav>
        </div>
    </div>
    <?php if(isset($_SESSION['usuarioLogueado'])){?>
    <div class="row justify-content-center absoluteTopRight m-2 float-xs-right">
      <div class="col">
        <h1 class="display-4"><a href="controlPanel.php"><i class="fa fa-chevron-right txtVioletaClar ml-2" aria-hidden="true"></i></a></h1>
      </div>
    </div>
    <?php } ?>
    <script>
      cambiarPaginaActivaNavbar();
    </script>
</div>
