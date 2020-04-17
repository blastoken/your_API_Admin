<div class="content-container fondoVioleta0">

  <div class="container-fluid">
    <form id="formularioAddTabla" method="post" class="m-2">
        <input type="text" id="nomTaula" name="nomTaula" value="<?php echo $nomTaula; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Nombre de la Tabla">
        <div id="contenedorAdds" class="row justify-content-center align-items-center w-100 pl-4">
        <p class="col-3 txtVioletaP font-weight-bold">Nombre</p>
        <p class="col-2 txtVioletaP font-weight-bold">Tamaño</p>
        <p class="col-3 txtVioletaP font-weight-bold">Tipo</p>
        <p class="col-2 txtVioletaP font-weight-bold">Índice</p>
        <p class="col-2 txtVioletaP font-weight-bold">Extra</p>
        <?php if(!isset($_GET['tabla'])){
          ?>
        <input type="hidden" id="count" name="count" value="2">
        <input type="text" id="campo0Nombre" name="campo0Nombre" value="" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta">
        <input title="El tamaño máximo de este tipo es de 11 bytes" type="number" id="campo0Length" name="campo0Length" min="1" max="11" value="11" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
        <select id="campo0Tipo" name="campo0Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(0)">
          <option value=""></option>
          <option value="int" selected="true">int</option>
          <option value="varchar">varchar</option>
        </select>
        <p class="col-2">
          <input name="campo0Indice" type="checkbox" id="campo0Indice" value="PRIMARY KEY" checked>
          <label for="campo0Indice" class="form-control-lg w-100 txtVioletaP"> PRI-KEY</label>
        </p>
        <p class="col-2">
          <input name="campo0NON" type="checkbox" id="campo0NON" value="NOT_NULL" checked>
          <label for="campo0NON" class="form-control-lg w-100 txtVioletaP"> NOT_NULL</label>
        </p>

        <input type="text" id="campo1Nombre" name="campo1Nombre" value="" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta">
        <input title="El tamaño máximo de este tipo es de 11 bytes" type="number" id="campo1Length" name="campo1Length" min="1" max="11" value="11" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
        <select id="campo1Tipo" name="campo1Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(1)">
          <option value=""></option>
          <option value="int">int</option>
          <option value="varchar">varchar</option>
          <option value="text">text</option>
          <option value="timestamp">timestamp</option>
          <option value="tinyint">tinyint</option>
          <option value="double">double</option>
          <option value="date">date</option>
        </select>
        <p class="col-2">
        </p>
        <p class="col-2">
          <input name="campo1NON" type="checkbox" id="campo1NON" value="NOT_NULL">
          <label for="campo1NON" class="form-control-lg w-100 txtVioletaP"> NOT_NULL</label>
        </p>


        <input type="text" id="campo2Nombre" name="campo2Nombre" value="" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta">
        <input title="El tamaño máximo de este tipo es de 11 bytes" type="number" id="campo2Length" name="campo2Length" min="1" max="11" value="11" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
        <select id="campo2Tipo" name="campo2Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(2)">
          <option value=""></option>
          <option value="int">int</option>
          <option value="varchar">varchar</option>
          <option value="text">text</option>
          <option value="timestamp">timestamp</option>
          <option value="tinyint">tinyint</option>
          <option value="double">double</option>
          <option value="date">date</option>
        </select>
        <p class="col-2">
        </p>
        <p class="col-2">
          <input name="campo2NON" type="checkbox" id="campo2NON" value="NOT_NULL">
          <label for="campo2NON" class="form-control-lg w-100 txtVioletaP"> NOT_NULL</label>
        </p>

      </div>
      <button id="btnAddCampo" type="button" class="w-100 btn mt-1 btnVioletaOutline mb-2" onclick="addCampo()">
        <i class="fa fa-plus p-2" aria-hidden="true"></i>
      </button>
      <input id="crearTabla" type="submit" name="crearTabla" value="Crear Tabla"  class="btn btn-lg w-100 mt-1 btnVioleta"/>

      <?php }else{
        ?>

        <input type="hidden" id="count" name="count" value="<?php echo sizeof($columnas)-1;?>">
        <input type="text" id="campo0Nombre" name="campo0Nombre" value="<?php echo $columnas[0]->getNombre(); ?>" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta">

        <?php if($columnas[0]->getTipo() === "int"){
          ?>
          <input title="El tamaño máximo de este tipo es de 11 bytes" type="number" id="campo0Length" name="campo0Length" min="1" max="11" value="<?php echo $columnas[0]->getLength(); ?>" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
          <select id="campo0Tipo" name="campo0Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(0)">
            <option value=""></option>
            <option value="int" selected="true">int</option>
            <option value="varchar">varchar</option>
          </select>
          <?php
        }else{
          ?>
          <input title="El tamaño máximo de este tipo es de 255 bytes" type="number" id="campo0Length" name="campo0Length" min="1" max="255" value="<?php echo $columnas[0]->getLength(); ?>" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
          <select id="campo0Tipo" name="campo0Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(0)">
            <option value=""></option>
            <option value="int">int</option>
            <option value="varchar" selected="true">varchar</option>
          </select>
          <?php
        } ?>

        <p class="col-2">
          <input name="campo0Indice" type="checkbox" id="campo0Indice" value="PRIMARY KEY"
        <?php if($columnas[0]->getIndice() !== ""){
          ?>
          checked
          <?php
        }?>
        >
        <label for="campo0Indice" class="form-control-lg w-100 txtVioletaP"> PRI-KEY</label>
      </p>
        <p class="col-2">
          <input name="campo0NON" type="checkbox" id="campo0NON" value="NOT_NULL"
          <?php if($columnas[0]->getExtra() !== ""){
            ?>
            checked
            <?php
          }?>
          >
          <label for="campo0NON" class="form-control-lg w-100 txtVioletaP"> NOT_NULL</label>
        </p>

        <?php
        for ($i=1; $i < sizeof($columnas); $i++) {

          ?>

          <input type="text" id="campo<?php echo $i; ?>Nombre" name="campo<?php echo $i; ?>Nombre" value="<?php echo $columnas[$i]->getNombre(); ?>" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta">

          <?php
          switch($columnas[$i]->getTipo()){
            case "int":
            ?>
            <input title="El tamaño máximo de este tipo es de 11 bytes" type="number" id="campo<?php echo $i; ?>Length" name="campo<?php echo $i; ?>Length" min="1" max="11" value="<?php echo $columnas[$i]->getLength(); ?>" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
            <select id="campo<?php echo $i; ?>Tipo" name="campo<?php echo $i; ?>Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(<?php echo $i; ?>)">
              <option value=""></option>
              <option value="int" selected="true">int</option>
              <option value="varchar">varchar</option>
              <option value="text">text</option>
              <option value="timestamp">timestamp</option>
              <option value="tinyint">tinyint</option>
              <option value="double">double</option>
              <option value="date">date</option>
            </select>
            <?php
          break;
          case "varchar":
            ?>
            <input title="El tamaño máximo de este tipo es de 255 bytes" type="number" id="campo<?php echo $i; ?>Length" name="campo<?php echo $i; ?>Length" min="1" max="255" value="<?php echo $columnas[$i]->getLength(); ?>" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
            <select id="campo<?php echo $i; ?>Tipo" name="campo<?php echo $i; ?>Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(<?php echo $i; ?>)">
              <option value=""></option>
              <option value="int">int</option>
              <option value="varchar" selected="true">varchar</option>
              <option value="text">text</option>
              <option value="timestamp">timestamp</option>
              <option value="tinyint">tinyint</option>
              <option value="double">double</option>
              <option value="date">date</option>
            </select>
            <?php
            break;
            case "text":
            ?>
            <input title="El tamaño máximo de este tipo es de 65535 bytes" type="number" id="campo<?php echo $i; ?>Length" name="campo<?php echo $i; ?>Length" min="1" max="255" value="<?php echo $columnas[$i]->getLength(); ?>" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
            <select id="campo<?php echo $i; ?>Tipo" name="campo<?php echo $i; ?>Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(<?php echo $i; ?>)">
              <option value=""></option>
              <option value="int">int</option>
              <option value="varchar">varchar</option>
              <option value="text" selected="true">text</option>
              <option value="timestamp">timestamp</option>
              <option value="tinyint">tinyint</option>
              <option value="double">double</option>
              <option value="date">date</option>
            </select>
            <?php
            break;
            case "timestamp":
            ?>
            <input title="Este campo recoge la fecha y hora, no necesita especificar un tamaño" type="number" id="campo<?php echo $i; ?>Length" name="campo<?php echo $i; ?>Length" min="0" max="0" value="0" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta" disabled>
            <select id="campo<?php echo $i; ?>Tipo" name="campo<?php echo $i; ?>Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(<?php echo $i; ?>)">
              <option value=""></option>
              <option value="int">int</option>
              <option value="varchar">varchar</option>
              <option value="text">text</option>
              <option value="timestamp" selected="true">timestamp</option>
              <option value="tinyint">tinyint</option>
              <option value="double">double</option>
              <option value="date">date</option>
            </select>
            <?php
            break;
            case "tinyint":
            ?>
            <input title="El tamaño máximo de este tipo es de 1 byte" type="number" id="campo<?php echo $i; ?>Length" name="campo<?php echo $i; ?>Length" min="1" max="1" value="1" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
            <select id="campo<?php echo $i; ?>Tipo" name="campo<?php echo $i; ?>Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(<?php echo $i; ?>)">
              <option value=""></option>
              <option value="int">int</option>
              <option value="varchar">varchar</option>
              <option value="text">text</option>
              <option value="timestamp">timestamp</option>
              <option value="tinyint" selected="true">tinyint</option>
              <option value="double">double</option>
              <option value="date">date</option>
            </select>
            <?php
            break;
            case "double":
            ?>
            <input title="Se utiliza el siguiente formato -> cifras_entero.cifras_decimales    (MAX decimales = 9)" type="text" id="campo<?php echo $i; ?>Length" name="campo<?php echo $i; ?>Length" min="0" max="10" value="<?php echo $columnas[$i]->getLength(); ?>" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
            <select id="campo<?php echo $i; ?>Tipo" name="campo<?php echo $i; ?>Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(<?php echo $i; ?>)">
              <option value=""></option>
              <option value="int">int</option>
              <option value="varchar">varchar</option>
              <option value="text">text</option>
              <option value="timestamp">timestamp</option>
              <option value="tinyint">tinyint</option>
              <option value="double" selected="true">double</option>
              <option value="date">date</option>
            </select>
            <?php
            break;
            case "date":
            ?>
            <input title="Este campo recoge la fecha, no necesita especificar un tamaño" type="number" id="campo<?php echo $i; ?>Length" name="campo<?php echo $i; ?>Length" min="0" max="0" value="0" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta" disabled>
            <select id="campo<?php echo $i; ?>Tipo" name="campo<?php echo $i; ?>Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(<?php echo $i; ?>)">
              <option value=""></option>
              <option value="int">int</option>
              <option value="varchar">varchar</option>
              <option value="text">text</option>
              <option value="timestamp">timestamp</option>
              <option value="tinyint">tinyint</option>
              <option value="double">double</option>
              <option value="date" selected="true">date</option>
            </select>
            <?php
            break;
          } ?>
          <p class="col-2">
          </p>
          <p class="col-2">
            <input name="campo<?php echo $i; ?>NON" type="checkbox" id="campo<?php echo $i; ?>NON" value="NOT_NULL"
            <?php if($columnas[$i]->getExtra() !== ""){
              ?>
              checked
              <?php
            }?>
            >
            <label for="campo<?php echo $i; ?>NON" class="form-control-lg w-100 txtVioletaP"> NOT_NULL</label>
          </p>


          <?php
        }
        ?>
      </div>
      <button id="btnAddCampo" type="button" class="w-100 btn mt-1 btnVioletaOutline mb-2" onclick="addCampo()">
        <i class="fa fa-plus p-2" aria-hidden="true"></i>
      </button>
      <input id="editarTabla" type="submit" name="editarTabla" value="Editar Tabla"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
        <?php
      } ?>





    </form>
    <script>
      function addCampo(){
        var count = 0;
        var ultimoElemento = document.getElementById("formularioAddTabla");
        for (let i = 0; i <= ultimoElemento.elements.length-1; i++) {
          if(ultimoElemento.elements[i].attributes != null){
            if(ultimoElemento.elements[i].attributes.id.nodeValue.length > 5){
              var num = ultimoElemento.elements[i].attributes.id.nodeValue.charAt(5);
              if(!isNaN(num)){
                if(num > count){
                  count = num;
                }
              }
            }
          }
        }
        count++;
        var container = document.getElementById("contenedorAdds");
        container.innerHTML += "<input type='text' id='campo"+count+"Nombre' name='campo"+count+"Nombre' class='col-3 form-control-lg text-center mb-3 w-100 inputVioleta'><input type='number' id='campo"+count+"Length' name='campo"+count+"Length' min='1' max='1' value='1' class='col-2 form-control-lg text-center mb-3 w-100 inputVioleta'><select id='campo"+count+"Tipo' name='campo"+count+"Tipo' class='col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha' onchange='onChangeTipoToLength("+count+")'><option value=''></option><option value='int'>int</option><option value='varchar'>varchar</option><option value='text'>text</option><option value='timestamp'>timestamp</option><option value='tinyint'>tinyint</option><option value='double'>double</option><option value='date'>date</option></select><p class='col-2'></p><p class='col-2'><input name='campo"+count+"NON' type='checkbox' id='campo"+count+"NON' value='NOT_NULL'><label for='campo"+count+"NON' class='form-control-lg w-100 txtVioletaP'> NOT_NULL</label></p>";
        document.getElementById("count").value = count;
      }

      function onChangeTipoToLength(num){
        var valueSelected = document.getElementById("campo"+num+"Tipo").value;
        var campoLenght = document.getElementById("campo"+num+"Length");
        //var campoNON = document.getElementById("campo"+num+"NON");
          campoLenght.disabled = false;
        console.log("Valor seleccionado: "+valueSelected);
        switch(valueSelected){
          case "int":
            campoLenght.type = "number";
            campoLenght.max = 11;
            campoLenght.value = 11;
            campoLenght.title= "El tamaño máximo de este tipo es de 11 bytes";
          break;
          case "varchar":
            campoLenght.type = "number";
            campoLenght.max = 255;
            campoLenght.value = 255;
            campoLenght.title= "El tamaño máximo de este tipo es de 255 bytes";
          break;
          case "text":
            campoLenght.type = "number";
            campoLenght.max = 65535;
            campoLenght.value = 65535;
            campoLenght.title= "El tamaño máximo de este tipo es de 65535 bytes";
          break;
          case "timestamp":
            campoLenght.type = "number";
            campoLenght.disabled = true;
            campoLenght.value = 0;
            campoLenght.title= "Este campo recoge la fecha y hora, no necesita especificar un tamaño";
          break;
          case "tinyint":
            campoLenght.type = "number";
            campoLenght.max = 1;
            campoLenght.value = 1;
            campoLenght.title= "El tamaño máximo de este tipo es de 1 byte";
          break;
          case "double":
            campoLenght.type = "text";
            campoLenght.value = "2.2";
            campoLenght.title= "Se utiliza el siguiente formato -> cifras_entero.cifras_decimales    (MAX decimales = 9)";
          break;
          case "date":
            campoLenght.type = "number";
            campoLenght.disabled = true;
            campoLenght.value = 0;
            campoLenght.title= "Este campo recoge la fecha, no necesita especificar un tamaño";
          break;
        }
      }

    </script>
  </div>
</div>
