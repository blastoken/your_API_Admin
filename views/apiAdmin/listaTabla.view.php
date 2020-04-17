<div class="content-container fondoVioleta0">

  <div class="container-fluid">

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
        <th class="tablaVioletaHeader text-center"><button type="button" data-toggle="modal" data-target="#exampleModal" class="btn w-100 h-100"><i class="fa fa-plus w-100 h-100"></i></button></th>
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
              ?>

              <?php
            }
            ?><input id="insertar" type="submit" name="insertar" value="Insertar"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
          </form>
        </div>
      </div>
    </div>
  </div>

  </div>
</div>
