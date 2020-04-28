<div class="content-container fondoVioleta0">

  <div class="container-fluid">

    <h1 class="text-center txtVioletaOscur font-weight-bold"><?php echo $_SESSION['bdActiva']; ?></h1>


      <a href="addTabla.php" title="Crear Tabla" class="btn btn-lg mt-1 btnVioleta m-4">
          <i class="fa fa-plus p-2" aria-hidden="true"></i>
      </a>
      <?php if(sizeof($tablas) > 0){ ?>
      <button type="button" title="Relacionar Tablas" class="btn btn-lg btnVioleta" data-toggle="modal" data-target="#modalIndexes">
        <i class="fa fa-object-group p-2" aria-hidden="true"></i>
      </button>
      <?php }?>
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
                <li><a href="createViewyaa.php?tabla=<?php echo $nombre; ?>" class="pl-1 h-100" onmouseover="cambioImagen('<?php echo "imgVistaTabla".$nombre;  ?>','imgs/vista_tabla_on_over.png')" onmouseout="cambioImagen('<?php echo "imgVistaTabla".$nombre;  ?>','imgs/vista_tabla.png')"><img id="<?php echo "imgVistaTabla".$nombre;  ?>" src="imgs/vista_tabla.png" alt="delete" height="24px"> Editor de Vistas</a></li>
              </ul>
            </div>
          </th>
          <?php
          foreach ($columnas as $columna) {
            ?>
            <tr><td class="p-3"><?php echo $columna->getNombre();?> <i class="font-weight-lighter"><?php echo $columna->getTipo()." ".$columna->toStringLength();?>
            </i><?php if($columna->getIndice() === "PRI"){ ?>
              <img src="imgs/llave.png" alt="PRIMARY KEY" height="20px">
            <?php }
            if(isset($indexes[$nombre])){
              foreach($indexes[$nombre] as $index){
                if($index->getColumna() === $columna->getNombre()){
                  ?>
                  <i>-> <?php echo $index->getColumnaRef(); ?> (<?php echo $index->getTablaRef(); ?>)</i>
                  <?php
                }
              }
            }
            ?>
          </td></tr>
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
    <div class="modal fade bd-example-modal-lg w-100 p-5" id="modalIndexes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-center txtVioletaOscur font-weight-bold">Relaciones en la BBDD</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post">
              <div class="row justify-content-between align-items-center m-2">
                  <p class="col-2 txtVioletaP font-weight-bold">Tipo</p>
                  <p class="col-4 txtVioletaP font-weight-bold mr-3 text-center">Tabla</p>
                  <p class="col-4 txtVioletaP font-weight-bold text-center">Campo</p>
                  <div class="col-2" title="CLAVE PRIMARIA: Actúa como identificador único en la tabla, esta se asociará con un campo en otra tabla para relacionar a estas."><img src="imgs/llave.png" alt="PRIMARY KEY" height="28px"></div>
                  <select id="modalIndexesTabla1" name="modalIndexesTabla1" class="col-4 form-control-lg text-center mb-3 mr-3 w-100 inputVioleta sinFlecha" onchange="selectedTable(1)">
                    <option value=""></option>
                    <?php
                      foreach ($tablas as $nombre => $tabla) {
                        ?>
                        <option value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
                        <?php
                      }
                    ?>
                  </select>
                  <select id="modalIndexesCampo1" name="modalIndexesCampo1" class="col-4 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha">
                    <option value=""></option>
                  </select>

                  <div class="col-2" title="CLAVE AJENA: Este campo será relacionado con la clave primaria y por tanto ambas tablas, debe ser del mismo tipo y longitud que la clave primaria que la relaciona."><img src="imgs/union.png" alt="FOREIGN KEY" height="28px"></div>
                  <select id="modalIndexesTabla2" name="modalIndexesTabla2" class="col-4 form-control-lg text-center mb-3 mr-3 w-100 inputVioleta sinFlecha" onchange="selectedTable(2)">
                    <option value=""></option>
                    <?php
                      foreach ($tablas as $nombre => $tabla) {
                        ?>
                        <option value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
                        <?php
                      }
                    ?>
                  </select>
                  <select id="modalIndexesCampo2" name="modalIndexesCampo2" class="col-4 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(1)">
                    <option value=""></option>
                  </select>
              </div>
                <input id="crearIndice" type="submit" name="crearIndice" value="Crear Índice"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
            </form>


              <?php foreach ($indexes as $name => $table) {
                ?>
                <table class="table table-reflow tablaVioleta font-weight-bold text-center mt-5">
                  <th class="tablaVioletaHeader" colspan="5"><h4>Tabla: <span class="font-weight-bold"><?php echo $name; ?></span></h4></th>
                  <tr class="tablaVioletaHeader" style="border-top: 3px solid white;">
                    <td><i class="fa fa-trash"></i></td>
                    <td>Columna</td>
                    <td>Nombre FK</td>
                    <td>Tabla Referenciada</td>
                    <td>Columna Referenciada</td>
                  </tr>
                  <?php
                  foreach ($table as $index) {
                    ?>
                    <tr class="fondoVioleta1">
                      <td><a href="deleteIndex.php?table=<?php echo $index->getTabla();?>&fk=<?php echo $index->getNombre();?>" class="btn btn-danger text-white mr-2"><i class="fa fa-close"></i></a></td>
                      <?php
                      foreach ($index->toArray() as $valor) {
                        ?>
                        <td><?php echo $valor; ?></td>
                        <?php
                      }?>
                    </tr>
                    <?php
                  }
                  ?>

                </table>
                <?php
              } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function selectedTable(num){
      var tableName = document.getElementById('modalIndexesTabla'+num).value;
      var contentTable = document.getElementById(tableName);
      var rowsSpinner = document.getElementById('modalIndexesCampo'+num);
      rowsSpinner.innerHTML = '';

      console.log(rowsSpinner.options);
      for (let i = 1; i <= contentTable.firstElementChild.childNodes.length-3; i++) {
        if(contentTable.firstElementChild.childNodes[i].childNodes[0] !== undefined){
          let campo = contentTable.firstElementChild.childNodes[i].childNodes[0].firstChild.data;
          campo = campo.substring(0,campo.length-1);
          var opcion = document.createElement('option');
          opcion.appendChild( document.createTextNode(campo) );
          opcion.value = campo;
          rowsSpinner.appendChild(opcion);
          console.log(campo);
        }
      }
    }
  </script>
</div>
