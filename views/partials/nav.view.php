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
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Log In</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
    </div>
    <?php if(isset($_SESSION['usuarioLogueado'])){?>
    <div class="row justify-content-center fondoTopBar absoluteTopRight m-2 float-xs-right">
      <div class="col fondoTopBar text-center">
        <p class="text-light text-center">Usuario logueado <strong><?php echo $_SESSION['usuarioLogueado']['user']?></strong></p>
      </div>
    </div>
    <?php } ?>
    <script>
      cambiarPaginaActivaNavbar();
    </script>
</div>
