<div class="content-container fondoVioleta0">

  <div class="container-fluid">
    <a href="tablasbdyaa.php?bd=<?php echo $_SESSION['bdActiva']; ?>" class="btn btn-lg ml-1 mb-3 btnVioleta"><i class="fa fa-chevron-left"></i></a>
    <?php if (sizeof($vistasTabla) > 0) {
      ?>
      <h4 class="txtVioletaP font-weight-bold col-2">Selecciona una vista</h4>
      <select id="vista" class="col-2 form-control-lg text-center inputVioleta sinFlecha" onchange="cambioVista()">
        <option value=""></option>
        <?php foreach ($vistasTabla as $vistaTabla){ ?>
        <option value="<?php echo $vistaTabla->getNombre(); ?>"<?php if(isset($_GET['vista'])){ if($_GET['vista'] === $vistaTabla->getNombre()){ echo " selected"; } }?>><?php echo $vistaTabla->getNombre(); ?></option>
      <?php } ?>
      </select>
      <?php
    }
    ?>
    <a href="createViewyaa.php?tabla=<?php echo $tabla; ?>" class="btn btn-lg ml-1 mb-3 btnVioleta"><i class="fa fa-plus"></i></a>
    <?php
    if(isset($_GET['vista'])){
      ?>
      <h1 class="text-center txtVioletaOscur font-weight-bold"><?php echo $vista." (".$tabla.")"; ?></h1>

      <table id="vista<?php echo $vista; ?>" class="table table-reflow tablaVioleta font-weight-bold">
          <?php
            $nuevo = new $vista();
            $claves = array_keys($nuevo->toArrayToView());
            foreach ($claves as $clave) {
              ?>
              <th class="tablaVioletaHeader text-center pt-3"><?php echo $clave; ?></th>
              <?php
            }

          ?>
            <?php
        if(sizeof($objetosVista) > 0){
        $claro1 = false;
        $fondo = "";
        $cont = 1;
          foreach ($objetosVista as $objeto) {
          ?>
          <tr>
            <?php
              $campos = $objeto->toArrayToView();
              foreach ($campos as $campo) {
                ?>
                <td class="txtVioletaP text-center pt-4 <?php
                if($claro1){
                  $fondo = "fondoVioleta1";
                }else{
                  $fondo = "fondoVioleta0";
                }
                echo $fondo;
                ?>"><?php echo $campo; ?></td>
                <?php
              }
             ?>
          </tr>
          <?php
          $claro1 = !$claro1;
          $cont++;
          }
         ?>
      </table>
      <?php
      }
    }else{
      ?>

    <h1 class="text-center txtVioletaOscur font-weight-bold"><?php echo $tabla; ?></h1>

    <table id="tabla<?php echo $tabla; ?>" class="table table-reflow tablaVioleta font-weight-bold">
        <?php
          $nuevo = new $tabla();
          $claves = array_keys($nuevo->toArrayToView());
          foreach ($claves as $clave) {
            ?>
            <th class="tablaVioletaHeader text-center pt-3"><?php echo $clave; ?></th>
            <?php
          }

        ?>
        <th class="tablaVioletaHeader text-center"><button type="button" data-toggle="modal" data-target="#exampleModal" class="btn w-100 h-100" onclick="resetValuesModal('<?php echo date("Y-m-d H:i:s",time()); ?>')"><i class="fa fa-plus w-100 h-100"></i></button></th>
      <?php
      if(sizeof($objetos) > 0){
      $claro1 = false;
      $fondo = "";
      $cont = 1;
        foreach ($objetos as $objeto) {
        ?>
        <tr>
          <?php
            $campos = $objeto->toArrayToView();
            foreach ($campos as $campo) {
              ?>
              <td class="txtVioletaP text-center pt-4 <?php
              if($claro1){
                $fondo = "fondoVioleta1";
              }else{
                $fondo = "fondoVioleta0";
              }
              echo $fondo;
              ?>"><?php echo $campo; ?></td>
              <?php
            }
           ?>
           <td class="txtVioletaP p-3 text-center <?php echo $fondo; ?>">
             <button type="button" onclick="getValuesToModal('tabla<?php echo $tabla; ?>',<?php echo $cont; ?>)" data-toggle="modal" data-target="#exampleModal" class="btn btn-success text-white"><i class="fa fa-edit"></i></button>
             <a href="listaTabla.php?tabla=<?php echo $tabla; ?>&id=<?php echo $campos[$claves[0]]; ?>" class="btn btn-danger text-white"><i class="fa fa-trash"></i></a>
           </td>
        </tr>
        <?php
        $claro1 = !$claro1;
        $cont++;
        }
       ?>
    </table>

  <?php }
  ?>

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
          <form id="formularioModal" method="post">
            <?php
            foreach ($columnas as $columna) {
              ?>
              <label for="<?php echo $columna->getNombre();?>" class="txtVioletaP w-100 font-weight-bolder">
              <?php
              if($columna->getIndice() !== ""){
                ?>
                <img src="imgs/llave.png" class="float-right" alt="PRIMARY KEY" height="20px">
                <?php
              }
              echo strtoupper($columna->getNombre())."   <i class=\"font-weight-lighter\">".strtoupper($columna->getTipo())."".$columna->toStringLength()."</i>";
              ?>
              </label>
              <?php
              if(isset($tablaRelated) && $columna->getNombre() === $campoFK){
                ?>
                <select id="<?php echo $columna->getNombre();?>" name="<?php echo $columna->getNombre();?>" class="form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha">
                  <option value=""></option>
                  <?php
                  foreach ($objetosRelated as $objetoRelated) {
                    ?>
                    <option value="<?php echo $objetoRelated->toArrayToView()[$campoRelated];?>"><?php echo implode(" ",$objetoRelated->toArrayToView());?></option>
                    <?php
                  }
                  ?>
                </select>
                <?php
              }else{
                switch($columna->getTipo()){
                  case "int":
                    ?>
                    <input type="number" id="<?php echo $columna->getNombre();?>" value="0" name="<?php echo $columna->getNombre();?>" maxlength="<?php echo $columna->getLength();?>" value="" class="form-control-lg text-center mb-3 w-100 inputVioleta">
                    <?php
                  break;
                  case "timestamp":
                    ?>
                    <input type="datetime-local" id="<?php echo $columna->getNombre();?>" value="<?php echo date("Y-m-d H:i:s",time()); ?>" name="<?php echo $columna->getNombre();?>" class="form-control-lg text-center mb-3 w-100 inputVioleta">
                    <?php
                  break;
                  case "date":
                    ?>
                    <input type="date" id="<?php echo $columna->getNombre();?>" name="<?php echo $columna->getNombre();?>" class="form-control-lg text-center mb-3 w-100 inputVioleta">
                    <?php
                  break;
                  case "double":
                    ?>
                    <input type="text" id="<?php echo $columna->getNombre();?>" name="<?php echo $columna->getNombre();?>" value="0.0" class="form-control-lg text-center mb-3 w-100 inputVioleta">
                    <?php
                  break;
                  default:
                    ?>
                    <input type="text" id="<?php echo $columna->getNombre();?>" name="<?php echo $columna->getNombre();?>" maxlength="<?php echo $columna->getLength();?>" value="" class="form-control-lg text-center mb-3 w-100 inputVioleta">
                    <?php
                  break;
                }
              }
              ?>

              <?php
            }
            ?><input id="insertar" type="submit" name="insertar" value="Insertar"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
  <script>
    function cambioVista(){
      //Obtener el valor del select id="vista" i redirigir a la pagina actual cambiando la variable vista con el valor seleccionado
      var vistaSelected = document.getElementById('vista').value;
      if(vistaSelected !== ""){
        window.location="listaTabla.php?tabla=<?php echo $tabla; ?>&vista="+vistaSelected;
      }else{
        window.location="listaTabla.php?tabla=<?php echo $tabla; ?>";
      }
    }




  </script>

  </div>
</div>
