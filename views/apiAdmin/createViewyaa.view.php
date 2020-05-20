<div class="content-container fondoVioleta0">

  <div class="container-fluid">

    <h1 class="text-center txtVioletaOscur font-weight-bold">Creador de Vistas de '<?php echo $tabla?>'</h1>
    <br />
    <form method="post">
      <div id="containerCampos" class="row justify-content-between align-items-center m-2">
        <input type="text" name="nombreVista" id="nombreVista" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Nombre de la vista">
        <p class="col-3 txtVioletaP font-weight-bold text-center">Tabla</p>
        <p class="col-4 txtVioletaP font-weight-bold mr-3 text-center">Campo</p>
        <p class="col-4 txtVioletaP font-weight-bold mr-3 text-center">Alias</p>
        <?php
        $cont = 0;
        foreach ($tablas[$tabla] as $columna) {
          ?>
          <select id="tabla<?php echo $cont; ?>" name="tabla<?php echo $cont; ?>" class="col-3 form-control-lg text-center mb-3 mr-3 w-100 inputVioleta sinFlecha" onchange="cambioTabla(<?php echo $cont; ?>)">
            <option value="<?php echo $tabla; ?>"><?php echo $tabla; ?></option>
            <?php
            if(sizeof($tablasRelacionadas) > 0){
              foreach ($tablasRelacionadas as $tablaR) {
                ?>
                <option value="<?php echo $tablaR; ?>"><?php echo $tablaR; ?></option>
                <?php
              }
            }
          ?>
          </select>
          <select id="campo<?php echo $cont; ?>" name="campo<?php echo $cont; ?>" class="col-4 form-control-lg text-center mb-3 mr-3 w-100 inputVioleta sinFlecha"  onchange="cambioCampo(<?php echo $cont; ?>)">
            <?php
            foreach($tablas[$tabla] as $tablaThis){
              ?>
              <option value="<?php echo $tablaThis->getNombre(); ?>"
              <?php
              if($tablaThis->getNombre() === $columna->getNombre()){
                echo " selected";
              }
              ?>
              ><?php echo $tablaThis->getNombre(); ?></option>
              <?php
            }
          ?>
          </select>
          <input type="text" id="renombre<?php echo $cont; ?>" name="renombre<?php echo $cont; ?>" value="<?php echo $columna->getNombre(); ?>" class="col-4 form-control-lg text-center mb-3 mr-3 w-100 inputVioleta">
          <?php
          $cont++;
        }?>

        </div>
        <input type="hidden" id="countTotal" name="countTotal" value="<?php echo $cont; ?>">
        <button id="btnAddCampo" type="button" class="w-100 btn mt-1 btnVioletaOutline mb-2" onclick="addCampoVista()">
          <i class="fa fa-plus p-2" aria-hidden="true"></i>
        </button>
        <input id="crearVista" type="submit" name="crearVista" value="Crear Vista"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
    </form>

  </div>
  <script>
    function addCampoVista(){
      var countTotal = document.getElementById('countTotal');
      var cont = countTotal.value;
      var container = document.getElementById('containerCampos');
      var selectTabla = document.createElement('select');
      var selectCampo = document.createElement('select');
      var inputRenombre = document.createElement('input');

      //Creació select id="tablaX"
      var optionsTables = document.getElementById('tabla0').children;
      for (let i = 0; i < optionsTables.length; i++) {
        let optionValue = optionsTables[i].attributes.value.nodeValue;
        var opcion = document.createElement('option');
        opcion.appendChild( document.createTextNode(optionValue) );
        opcion.value = optionValue;
        selectTabla.appendChild(opcion);
      }
      selectTabla.id = 'tabla'+cont;
      selectTabla.name = 'tabla'+cont;
      selectTabla.setAttribute("onchange", function(){});
      selectTabla.attributes.onchange.nodeValue = 'cambioTabla('+cont+')';
      selectTabla.classList.value = 'col-3 form-control-lg text-center mb-3 mr-3 w-100 inputVioleta sinFlecha';
      container.appendChild(selectTabla);

      console.log(document.getElementById('tabla0'));
      //Creació select id="campoX"
      var optionsCampos = document.getElementById('campo0').children;
      for (let i = 0; i < optionsCampos.length; i++) {
        let optionValue = optionsCampos[i].attributes.value.nodeValue;
        var opcionCampo = document.createElement('option');
        opcionCampo.appendChild( document.createTextNode(optionValue) );
        opcionCampo.value = optionValue;
        selectCampo.appendChild(opcionCampo);
      }
      selectCampo.id = 'campo'+cont;
      selectCampo.name = 'campo'+cont;
      selectCampo.setAttribute("onchange", function(){});
      selectCampo.attributes.onchange.nodeValue = 'cambioCampo('+cont+')';
      selectCampo.classList.value = 'col-4 form-control-lg text-center mb-3 mr-3 w-100 inputVioleta sinFlecha';
      container.appendChild(selectCampo);

      //Creacio input id="renombreX"
      let option0Id = document.getElementById('campo0').children[0].attributes.value.nodeValue;
      inputRenombre.value = option0Id;
      inputRenombre.id = 'renombre'+cont;
      inputRenombre.name = 'renombre'+cont;
      inputRenombre.classList.value = 'col-4 form-control-lg text-center mb-3 mr-3 w-100 inputVioleta';
      container.appendChild(inputRenombre);

      countTotal.value++;
    }

    function cambioTabla(cont){
      var tablasbd = [];
      <?php
      foreach ($tablas as $key => $tabla) {
        ?>
        tablasbd.push('<?php echo $key; ?>');
        tablasbd['<?php echo $key; ?>'] = [];
        <?php
        foreach ($tabla as $campo) {
          ?>
          tablasbd['<?php echo $key; ?>'].push('<?php echo $campo->getNombre(); ?>');
          <?php
        }
        ?>
        <?php
      }
      ?>
      var tablaValue = document.getElementById('tabla'+cont).value;
      var campoSelect = document.getElementById('campo'+cont);
      campoSelect.innerHTML = '';
      for (var i = 0; i < tablasbd[tablaValue].length; i++) {
        var opcion = document.createElement('option');
        opcion.appendChild( document.createTextNode(tablasbd[tablaValue][i]) );
        opcion.value = tablasbd[tablaValue][i];
        campoSelect.appendChild(opcion);
      }
      document.getElementById('renombre'+cont).value = tablasbd[tablaValue][0];

    }

    function cambioCampo(cont){
      var campoValue = document.getElementById('campo'+cont).value;
      document.getElementById('renombre'+cont).value = campoValue;

    }
  </script>
</div>
