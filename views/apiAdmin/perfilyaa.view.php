<div class="content-container fondoVioleta0" style="background-image: url('<?php echo $_SESSION['usuarioLogueado']['img']; ?>');  background-size: cover;">

  <div class="container-fluid">
    <form id="formPerfil" method="POST"></form>
    <h1 class="text-center txtVioletaOscur font-weight-bold">Tu perfil</h1>

    <div class="row justify-content-center align-items-center m-5">
      <div class="col-12 m-2"></div>
      <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 text-center txtVioletaMedioClar">
        <h4 class="font-weight-bold">Nombre</h4>
        <input form="formPerfil" type="text" id="userNombre" name="userNombre" class="form-control-lg text-center inputVioleta" placeholder="Nombre" value="<?php echo $_SESSION['usuarioLogueado']['nombre']; ?>" onchange="comprobarValoresPerfil('userNombre','nombre')" required>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 text-center txtVioletaMedioClar">
        <h4 class="font-weight-bold">Apellidos</h4>
        <input form="formPerfil" type="text" id="userApellidos" name="userApellidos" class="form-control-lg text-center inputVioleta" placeholder="Apellidos" value="<?php echo $_SESSION['usuarioLogueado']['apellidos']; ?>" onchange="comprobarValoresPerfil('userApellidos','apellidos')" required>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 text-center txtVioletaMedioClar">
        <h4 class="font-weight-bold">Email</h4>
        <input form="formPerfil" type="text" id="userEmail" name="userEmail" class="form-control-lg text-center inputVioleta" placeholder="E-mail" value="<?php echo $_SESSION['usuarioLogueado']['email']; ?>" onchange="comprobarValoresPerfil('userEmail','email')" required>
      </div>
      <div class="col-12 m-1"></div>
        <input form="formPerfil" id="btnPerfil" type="submit" name="btnPerfil" value="Actualizar Perfil"  class="btn btn-lg w-100 m-3 col-12  btnVioleta oculto"/>
      <div class="col-12 m-1"></div>
    </div>
  </div>
</div>
<script>
  function comprobarValoresPerfil(inputID, campo){
    var input = document.getElementById(inputID);
    var btn = document.getElementById('btnPerfil');
    switch(campo){
      case 'nombre':
        if(input.value !== '<?php echo $_SESSION['usuarioLogueado']['nombre']; ?>'){
          btn.classList.remove('oculto');
        }
        break;
      case 'apellidos':
        if(input.value !== '<?php echo $_SESSION['usuarioLogueado']['apellidos']; ?>'){
          btn.classList.remove('oculto');
        }
        break;
      case 'email':
        if(input.value !== '<?php echo $_SESSION['usuarioLogueado']['email']; ?>'){
          btn.classList.remove('oculto');
        }
        break;
    }
  }
</script>
