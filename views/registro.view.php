<div class="container-fluid h-75">
  <div class="row fondoVioleta0 justify-content-center align-items-center pt-5 pb-5 h-100">
    <div class="col-sm-12 col-md-8 col-lg-6 col-xl-6 rounded shadow-lg p-5">
      <h2 class="font-weight-bold text-center tituloVioleta w-100 pb-3 mb-5 ">Regístrate</h2>
      <?php if(sizeof($todosErrores) > 0){?>
      <div class="alert alert-danger rounded shadow-sm mr-5 ml-5 mt-2" role="alert">
        <strong class="text-center w-100">Registro Incorrecto</strong><br/>
        <?php
        foreach ($todosErrores as $value) {
          echo $value."<br/>";
        }
        ?>
      </div>
    <?php } ?>
      <form method="post">
          <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Nombre">
          <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Apellidos">
          <input type="email" id="email" name="email" value="<?php echo $email; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Email">
          <input type="password" id="pass" name="pass" value="<?php echo $pass; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Contraseña">
          <input type="password" id="pass2" name="pass2" value="<?php echo $pass2; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Repetir contraseña">
          <input id="registro" type="submit" name="registrarse" value="Registro"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
      </form>
    </div>
  </div>
</div>
