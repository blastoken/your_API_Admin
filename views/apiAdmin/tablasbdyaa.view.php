<div class="content-container fondoVioleta0">

  <div class="container-fluid">

    <h1 class="text-center txtVioletaOscur font-weight-bold"><?php echo $_SESSION['bdActiva']; ?></h1>

      <a href="addTabla.php" class="btn btn-lg mt-1 btnVioleta m-4">
        <i class="fa fa-plus p-2" aria-hidden="true"></i>
      </a>


    <?php
    if(sizeof($tablas) > 0){
      ?>
      <div class="row justify-content-start align-items-start m-3">
      <?php
      foreach ($tablas as $nombre => $columnas) {
        ?>
        <table class="table table-reflow tablaVioleta font-weight-bold col-3 text-center m-2">
          <th class="tablaVioletaHeader"><h3><?php echo $nombre; ?></h3></th>
          <?php
          foreach ($columnas as $columna) {
            ?>
            <tr><td class="p-3"><?php echo $columna->getNombre();?> <i class="font-weight-lighter"><?php echo $columna->getTipo();?></i></td></tr>
            <?php
          }
          ?>
          <tr><td class="p-3"><a href="#" class="text-decoration-none"><i class="fa fa-plus p-2" aria-hidden="true"></i></a></td></tr>
        </table>
        <?php
      }
      ?>
      </div>
      <?php
    }
    ?>

  </div>
</div>
