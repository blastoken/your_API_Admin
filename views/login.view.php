<div class="container-fluid">
  <div class="row fondoVioleta0 justify-content-center align-items-center pt-5 pb-5">

    <div class="col-sm-12 col-md-8 col-lg-4 col-xl-3 rounded shadow-lg p-5">
      <h2 class="font-weight-bold text-center tituloVioleta w-100 pb-3 mb-5 ">Inicia sesión</h2>
      <?php if(sizeof($errores) > 0){?>
      <div class="alert alert-danger rounded shadow-sm mr-5 ml-5 mt-2" role="alert">
        <strong class="text-center w-100">Login Incorrecto</strong><br/>
        <?php
        foreach ($errores as $key => $value) {
          echo $value."<br/>";
        }
        ?>
      </div>
    <?php } ?>
      <form class="mr-5 ml-5 mt-2" method="post">
          <input type="text" id="email" name="email" value="<?php echo $email; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Email">
          <input type="password" id="pass" name="pass" value="<?php echo $pass; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Contraseña">
          <input id="login" type="submit" name="btnLogin" value="Login" class="btn btn-lg w-100 mt-2 btnVioleta"/>
          <input id="registro" type="submit" name="btnRegistro" value="Registro"  class="btn btn-lg w-100 mt-1 btnVioletaOutline"/>
      </form>
    </div>
  </div>
</div>
