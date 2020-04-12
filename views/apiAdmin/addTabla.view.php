<div class="content-container fondoVioleta0">

  <div class="container-fluid">
    <form id="formularioAddTabla" method="post" class="m-2">
        <input type="hidden" id="count" name="count" value="2">
        <input type="text" id="nomTaula" name="nomTaula" value="<?php if(isset($_POST['nomTaula'])){ echo $_POST['nomTaula']; } ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Nombre de la Tabla">
        <div id="contenedorAdds" class="row justify-content-center align-items-center w-100 pl-4">
        <p class="col-3 txtVioletaP font-weight-bold">Nombre</p>
        <p class="col-2 txtVioletaP font-weight-bold">Tamaño</p>
        <p class="col-3 txtVioletaP font-weight-bold">Tipo</p>
        <p class="col-2 txtVioletaP font-weight-bold">Índice</p>
        <p class="col-2 txtVioletaP font-weight-bold">Extra</p>
        <input type="text" id="campo0Nombre" name="campo0Nombre" value="" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta">
        <input title="El tamaño máximo de este tipo es de 11 bytes" type="number" id="campo0Length" name="campo0Length" min="1" max="11" value="11" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
        <select id="campo0Tipo" name="campo0Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="onChangeTipoToLength(0)">
          <option value=""></option>
          <option value="int" selected="true">int</option>
          <option value="varchar">varchar</option>
          <option value="text">text</option>
          <option value="timestamp">timestamp</option>
          <option value="tinyint">tinyint</option>
          <option value="double">double</option>
          <option value="date">date</option>
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
    </form>
    <script>
      function addCampo(){
        let count = 0;
        let ultimoElemento = document.getElementById("formularioAddTabla");
        for (let i = 0; i <= ultimoElemento.elements.length-1; i++) {
          if(ultimoElemento.elements[i].attributes != null){
            if(ultimoElemento.elements[i].attributes.id.nodeValue.length > 5){
              let num = ultimoElemento.elements[i].attributes.id.nodeValue.charAt(5);
              if(!isNaN(num)){
                if(num > count){
                  count = num;
                }
              }
            }
          }
        }
        count++;
        console.log(count);
        console.log(ultimoElemento);
        console.log(document.getElementById("contenedorAdds").innerHTML);
        document.getElementById("contenedorAdds").innerHTML += "<input type='text' id='campo"+count+"Nombre' name='campo"+count+"Nombre' class='col-3 form-control-lg text-center mb-3 w-100 inputVioleta'><input type='number' id='campo"+count+"Length' name='campo"+count+"Length' min='1' max='1' value='1' class='col-2 form-control-lg text-center mb-3 w-100 inputVioleta'><select id='campo"+count+"Tipo' name='campo"+count+"Tipo' class='col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha' onchange='onChangeTipoToLength("+count+")'><option value=''></option><option value='int'>int</option><option value='varchar'>varchar</option><option value='text'>text</option><option value='timestamp'>timestamp</option><option value='tinyint'>tinyint</option><option value='double'>double</option><option value='date'>date</option></select><p class='col-2'></p><p class='col-2'><input name='campo"+count+"NON' type='checkbox' id='campo"+count+"NON' value='NOT_NULL'><label for='campo"+count+"NON' class='form-control-lg w-100 txtVioletaP'> NOT_NULL</label></p>";
        document.getElementById("count").value = count;
      }

      function onChangeTipoToLength(num){
        let valueSelected = document.getElementById("campo"+num+"Tipo").value;
        let campoLenght = document.getElementById("campo"+num+"Length");
        let campoIndice = document.getElementById("campo"+num+"Indice");
          campoLenght.disabled = false;
        console.log("Valor seleccionado: "+valueSelected);
        switch(valueSelected){
          case "int":
            campoLenght.max = 11;
            campoLenght.value = 11;
            campoLenght.title= "El tamaño máximo de este tipo es de 11 bytes";
            campoIndice.disabled = false;
            campoIndice.checked = false;
          break;
          case "varchar":
            campoLenght.max = 255;
            campoLenght.value = 255;
            campoLenght.title= "El tamaño máximo de este tipo es de 255 bytes";
            campoIndice.disabled = false;
            campoIndice.checked = false;
          break;
          case "text":
            campoLenght.max = 65535;
            campoLenght.value = 65535;
            campoLenght.title= "El tamaño máximo de este tipo es de 65535 bytes";
            campoIndice.disabled = true;
            campoIndice.checked = false;
          break;
          case "timestamp":
            campoLenght.disabled = true;
            campoLenght.value = 0;
            campoLenght.title= "Este campo recoge la fecha y hora, no necesita especificar un tamaño";
            campoIndice.disabled = true;
            campoIndice.checked = false;
          break;
          case "tinyint":
            campoLenght.max = 1;
            campoLenght.value = 1;
            campoLenght.title= "El tamaño máximo de este tipo es de 1 byte";
            campoIndice.disabled = true;
            campoIndice.checked = false;
          break;
          case "double":
            campoLenght.type = "text";
            campoLenght.value = "2.2";
            campoLenght.title= "Se utiliza el siguiente formato -> cifras_entero.cifras_decimales    (MAX decimales = 9)";
            campoIndice.disabled = true;
            campoIndice.checked = false;
          break;
          case "date":
            campoLenght.disabled = true;
            campoLenght.value = 0;
            campoLenght.title= "Este campo recoge la fecha, no necesita especificar un tamaño";
            campoIndice.disabled = true;
            campoIndice.checked = false;
          break;
        }
      }

    </script>
  </div>
</div>
