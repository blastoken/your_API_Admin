<div class="content-container fondoVioleta0">

  <div class="container-fluid">
    <form id="formularioAddTabla" method="post" class="m-2">
        <input type="text" id="nomTaula" name="nomTaula" value="<?php echo $nomtaula; ?>" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Nombre de la Tabla">
        <div id="contenedorAdds" class="row justify-content-center align-items-center w-100 pl-4">
        <p class="col-3 txtVioletaP font-weight-bold">Nombre</p>
        <p class="col-2 txtVioletaP font-weight-bold">Tamaño</p>
        <p class="col-3 txtVioletaP font-weight-bold">Tipo</p>
        <p class="col-4 txtVioletaP font-weight-bold">Extra</p>
        <input type="text" id="idTaula" name="idTaula" value="id" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta" disabled>
        <input type="number" id="idLenght" name="idLenght" min="1" max="11" value="11" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
        <input type="text" id="idType" name="idType" value="int" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta" disabled>
        <input type="text" id="idExtra" name="idExtra" value="AUTO_INCREMENT" class="col-4 form-control-lg text-center mb-3 w-100 inputVioleta" disabled>

        <input type="text" id="campo0Nombre" name="campo0Nombre" value="" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta">
        <input type="number" id="campo0Lenght" name="campo0Lenght" min="1" max="11" value="11" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
        <select id="campo0Tipo" name="campo0Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha">
          <option>int</option>
          <option>varchar</option>
          <option>text</option>
          <option>timestamp</option>
          <option>tinyint</option>
          <option>double</option>
          <option>date</option>
        </select>
        <input type="text" id="campo0Extra" name="campo1Extra" value="" class="col-4 form-control-lg text-center mb-3 w-100 inputVioleta">

        <input type="text" id="campo1Nombre" name="campo1Nombre" value="" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta">
        <input type="number" id="campo1Lenght" name="campo1Lenght" min="1" max="11" value="11" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
        <select id="campo1Tipo" name="campo1Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha">
          <option>int</option>
          <option>varchar</option>
          <option>text</option>
          <option>timestamp</option>
          <option>tinyint</option>
          <option>double</option>
          <option>date</option>
        </select>
        <input type="text" id="campo1Extra" name="campo1Extra" value="" class="col-4 form-control-lg text-center mb-3 w-100 inputVioleta">

        <input type="text" id="campo2Nombre" name="campo2Nombre" value="" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta">
        <input type="number" id="campo2Lenght" name="campo2Lenght" min="1" max="11" value="11" class="col-2 form-control-lg text-center mb-3 w-100 inputVioleta">
        <select id="campo2Tipo" name="campo2Tipo" class="col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha">
          <option>int</option>
          <option>varchar</option>
          <option>text</option>
          <option>timestamp</option>
          <option>tinyint</option>
          <option>double</option>
          <option>date</option>
        </select>
        <input type="text" id="campo2Extra" name="campo2Extra" value="" class="col-4 form-control-lg text-center mb-3 w-100 inputVioleta">





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
        for (var i = 0; i <= ultimoElemento.elements.length-1; i++) {
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
        document.getElementById("contenedorAdds").innerHTML += "<input type='text' id='campo"+count+"Nombre' name='campo"+count+"Nombre' class='col-3 form-control-lg text-center mb-3 w-100 inputVioleta'><input type='number' id='campo"+count+"Lenght' name='campo"+count+"Lenght' min='1' max='255' value='1' class='col-2 form-control-lg text-center mb-3 w-100 inputVioleta'><select id='campo"+count+"Tipo' name='campo"+count+"Tipo' class='col-3 form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha'><option></option><option>int</option><option>varchar</option><option>text</option><option>timestamp</option><option>tinyint</option><option>double</option><option>date</option></select><input type='text' id='campo"+count+"Extra' name='campo"+count+"Extra'  class='col-4 form-control-lg text-center mb-3 inputVioleta'>";

      }
    </script>
  </div>
</div>
