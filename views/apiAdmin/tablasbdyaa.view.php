<div class="content-container fondoVioleta0">

  <div class="container-fluid">

    <h1 class="text-center txtVioletaOscur font-weight-bold"><?php echo $_SESSION['bdActiva']; ?></h1>

      <a href="addTabla.php" class="btn btn-lg mt-1 btnVioleta m-4">
        <i class="fa fa-plus p-2" aria-hidden="true"></i>
      </a>


    <?php
    if(sizeof($tablas) > 0){
      ?>
      <div class="row justify-content-center align-items-start m-3">
      <?php
      foreach ($tablas as $nombre => $columnas) {
        ?>
        <table id="<?php echo $nombre;  ?>" class="table table-reflow tablaVioleta font-weight-bold col-3 text-center m-2">
          <th class="tablaVioletaHeader">
            <div class="btn-group row w-100">
              <h3 class="col-10"><?php echo $nombre; ?></h3>

              <button type="button" class="btn col-2 dropdown-toggle text-white"
                      data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Desplegar menú</span>
              </button>

              <ul class="dropdown-menu fondoVioleta0" role="menu">
                <li><a href="tablasbdyaa.php?bd=<?php echo $_SESSION['bdActiva']."&"."edit=".$nombre; ?>" class="pl-1 h-100 w-100" onmouseover="cambioImagen('<?php echo "imgEditar".$nombre;  ?>','imgs/editar_on_over.png')" onmouseout="cambioImagen('<?php echo "imgEditar".$nombre;  ?>','imgs/editar.png')"><img id="<?php echo "imgEditar".$nombre;  ?>" src="imgs/editar.png" alt="edit" height="24px"> Editar</a></li>
                <li><a href="tablasbdyaa.php?bd=<?php echo $_SESSION['bdActiva']."&"."delete=".$nombre; ?>" class="pl-1 h-100" onmouseover="cambioImagen('<?php echo "imgEliminar".$nombre;  ?>','imgs/eliminar_on_over.png')" onmouseout="cambioImagen('<?php echo "imgEliminar".$nombre;  ?>','imgs/eliminar.png')"><img id="<?php echo "imgEliminar".$nombre;  ?>" src="imgs/eliminar.png" alt="delete" height="24px"> Eliminar</a></li>
              </ul>
            </div>
          </th>
          <?php
          foreach ($columnas as $columna) {
            ?>
            <tr><td class="p-3"><?php echo $columna->getNombre();?> <i class="font-weight-lighter"><?php echo $columna->getTipo()." ".$columna->toStringLength();?>
            </i><?php if($columna->getIndice() !== ""){ ?>
              <img src="imgs/llave.png" alt="PRIMARY KEY" height="20px">
            <?php }?></td></tr>
            <?php
          }
          ?>
          <tr><td class="p-3"><a href="listaTabla.php?tabla=<?php echo $nombre; ?>" class="text-decoration-none"><img id="<?php echo "imgVista".$nombre;  ?>" src="imgs/vista.png" alt="View" height="32px" onmouseover="cambioImagen('<?php echo "imgVista".$nombre;  ?>','imgs/vista_cerrada.png')" onmouseout="cambioImagen('<?php echo "imgVista".$nombre;  ?>','imgs/vista.png')"></a></td></tr>
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
