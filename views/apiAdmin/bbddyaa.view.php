<div class="content-container fondoVioleta0">

  <div class="container-fluid">

    <h1 class="text-center txtVioletaOscur font-weight-bold">Administra tu Base de Datos</h1>

    <button type="button" class="btn btn-lg mt-1 btnVioleta" data-toggle="modal" data-target="#exampleModal">
      <i class="fa fa-plus p-2" aria-hidden="true"></i>
    </button>

    <h3 class="text-center txtVioletaOscur font-weight-bold">Tus bases de datos</h3>
    <hr />

    <?php if(sizeof($todasBasesDatos) > 0){ ?>
    <div class="row justify-content-center align-items-center">
      <?php foreach ($todasBasesDatos as $db) { ?>
        <a href="tablasbdyaa.php?bd=<?php echo $db->getNombre(); ?>" class="btn col-3 btnVioletaOutline rounded p-5 m-2 text-center text-decoration-none">
          <h5 class="font-weight-bold text-monospace"><?php echo $db->getNombre(); ?></h5>
        </a>
      <?php } ?>
    </div>
  <?php } ?>

    <div class="modal fade bd-example-modal-lg w-100 p-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-center txtVioletaOscur font-weight-bold">Introduce los siguientes datos:</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post">
                <input type="text" id="nombbdd" name="nombbdd" value="<?php echo $nombbdd; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Nombre de la Base de Datos">
                <input type="text" id="userbbdd" name="userbbdd" value="<?php echo $userbbdd; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Usuario de la Base de Datos">
                <input type="password" id="passbbdd" name="passbbdd" value="<?php echo $passbbdd; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Contraseña de la Base de Datos">
                <input id="crearbd" type="submit" name="crearbd" value="Crear Base de Datos"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
