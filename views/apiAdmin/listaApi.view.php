<div class="content-container fondoVioleta0">

  <div class="container-fluid fondoVioleta0 pb-5">

    <h1 class="text-center txtVioletaOscur font-weight-bold"><?php echo $_SESSION['apiActiva']['nombre'];?></h1>
    <button type="button" class="btn btn-lg mt-1 col-2 btnVioleta"  data-toggle="modal" data-target="#modalCreateDocu">Nuevo documento<i class="fa fa-plus ml-2 font-weight-bold"></i></button>

    <?php
    if(sizeof($docus) > 0){
      ?>
      <div class="row justify-content-center">

        <?php
        foreach($docus as $docu){
          ?>
            <table id="<?php echo $docu->getNombre();  ?>" class="table table-reflow tablaVioleta font-weight-bold col-xs-11 col-sm-11 col-md-5 col-lg-4 col-xl-3 col-xxl-2 text-center m-2">
              <th class="tablaVioletaHeader">
                <h4 class="font-weight-bold"><i class="fa fa-file font-weight-bold iconoGrande mr-2"></i><?php echo $docu->getNombre(); ?> (<?php echo $docu->getAccion(); ?>)</h4>
              </th>
              <div class="text-center">
                <tr><td>
                <?php
                if($docu->getVista() === "default"){
                  ?>
                  <h5>Tabla <i class="font-weight-bold"><?php echo $docu->getTabla(); ?></i></h5>
                  <?php
                }
                ?>
                </td></tr>
                <?php
                foreach ($snippetsByDocuId[strval($docu->getId())] as $snippets) {

                  ?>
                  <tr><td><h5>Credenciales</h5>
                    <hr class="hrVioleta" />
                    'apiUser', 'apiPassword'
                    </td>
                  </tr>
                  <?php
                    if($docu->getAccion() !== "Read"){?>
                  <tr><td><h5>Campos del '<?php echo $docu->getAccion(); ?>'</h5>
                    <hr class="hrVioleta" />
                    <?php
                    if(sizeof($snippets) > 0){
                      foreach ($snippets as $snippet) {
                        switch($docu->getAccion()){
                          case 'ReadBy':
                            if($snippet->getAccion() === "Buscar"){
                              echo "Campo búsqueda: ".$snippet->getCampo();
                            }
                            break;
                          default:
                            echo "'".$snippet->getCampo()."' ";
                            break;

                        }
                      }

                    ?>
                  </td></tr>
                  <?php
                    }
                  }
                }
                ?>
                <tr><td>URL documento
                  <hr class="hrVioleta" />
                  <i class="font-weight-lighter"><script> document.write(window.location.origin+"/yourAPIAdmin"); </script>/apis/<?php echo $_SESSION['apiActiva']['nombre']."/".$docu->getNombre().".php"; ?></i>
                </td></tr>
              </div>
            </table>
          <?php
        }
        ?>
      </div>
      <?php
    }
     ?>


    <div class="modal fade bd-example-modal-lg w-100 p-5" id="modalCreateDocu" tabindex="-1" role="dialog" aria-labelledby="modalCreateAPILabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-center txtVioletaOscur font-weight-bold">Introduce los siguientes datos:</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post">
              <input type="text" id="nombredocu" name="nombredocu" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Nombre del documento" required>
              <select id="tabladocu" name="tabladocu" class="form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="changeViewByTable()" required>
                <option disabled selected>Selecciona la tabla</option>
                <?php foreach ($tablas as $nombre => $tabla){ ?>
                  <option value="<?php echo $nombre; ?>"><?php echo $nombre; ?></option>
                <?php } ?>
              </select>
              <select id="vistadocu" name="vistadocu" class="form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="changeActionsByView()" required>
                <option disabled selected>Selecciona la vista</option>
                <option value="default">Default (Tabla base)</option>
              </select>
              <select id="actionDocu" name="actionDocu" class="form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" onchange="setSnippetsByAction()" required>
                <option disabled selected>Selecciona una acción</option>
                <option value="Create">Insertar</option>
                <option value="Read">Mostrar</option>
                <option value="ReadBy">Mostrar por campo</option>
                <option value="Update">Actualizar</option>
                <option value="Delete">Eliminar</option>
              </select>
              <div id="titulosFiltrado" class="row pr-2 oculto">
                <h4 class="col-12 txtVioletaOscur font-weight-bold text-center">Opciones de filtrado</h4>
                <h5 class="col-3 txtVioletaP font-weight-bold text-center">Acción</h5>
                <h5 class="col-8 txtVioletaP font-weight-bold text-center">Campo</h5>
              </div>
              <div id="tituloUpdate" class="row pr-2 justify-content-center align-items-center oculto">
                <h4 class="col-10 txtVioletaOscur font-weight-bold text-center">Campos a actualizar</h4>
                  <button type="button" onclick="setSnippetsByAction()" class="col-1 btn btn-info text-white"><i class="fa fa-refresh"></i></button>
                <hr class="hrVioleta col-11"/>
              </div>
              <div id="snippets" class="row justify-content-center align-items-center pr-2">

              </div>
               <input id="createdocu" type="submit" name="createdocu" value="Crear Documento"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      function setSnippetsByAction(){
        var actionDocu = document.getElementById("actionDocu");
        var tablaDocu = document.getElementById("tabladocu");
        var vistaDocu = document.getElementById("vistadocu");
        var snippets = document.getElementById("snippets");
        var titulosFiltrado = document.getElementById("titulosFiltrado");
        var tituloUpdate = document.getElementById("tituloUpdate");
        var vistaTabla = getVistaTabla();
        if(tablaDocu.value !== "Selecciona la tabla" && vistaDocu.value !== "Selecciona la vista"){
          snippets.innerHTML = '';
          var columnas = createColumnas();
          console.log(columnas);
          switch(actionDocu.value){
            case "ReadBy":
              addWhereSnippet(columnas,vistaTabla);
            case "Read":
              titulosFiltrado.classList.remove("oculto");
              tituloUpdate.classList.add("oculto");
              snippets.classList.remove("oculto");
              addOrderBySnippet(columnas, vistaTabla);
            break;
            case "Update":
              addSetSnippets(columnas, vistaTabla);
              tituloUpdate.classList.remove("oculto");
              titulosFiltrado.classList.add("oculto");
            break;
            default:
              snippets.classList.add("oculto");
              titulosFiltrado.classList.add("oculto");
              tituloUpdate.classList.add("oculto");
            break;
          }
        }else{
          snippets.classList.add("oculto");
          titulosFiltrado.classList.add("oculto");
          tituloUpdate.classList.add("oculto");
        }
      }

      function addSetSnippets(columnas, vistaTabla){
        var snippets = document.getElementById("snippets");

        for (var i = 1; i < columnas[vistaTabla].length; i++) {
          //SnippetAccion
          var inputAccion = document.createElement('input');
          inputAccion.type = "hidden";
          inputAccion.id = "snippetSetAccion"+i;
          inputAccion.name = "snippetSetAccion"+i;
          inputAccion.value = "Set";
          snippets.appendChild(inputAccion);

          //SnippetCampo
          var inputCampo = document.createElement('input');
          inputCampo.type = "hidden";
          inputCampo.id = "snippetSetCampo"+i;
          inputCampo.name = "snippetSetCampo"+i;
          inputCampo.value = columnas[vistaTabla][i];
          snippets.appendChild(inputCampo);

          //SnippetModo
          var inputModo = document.createElement('input');
          inputModo.type = "hidden";
          inputModo.id = "snippetSetModo"+i;
          inputModo.name = "snippetSetModo"+i;
          inputModo.value = "=";
          snippets.appendChild(inputModo);

          //Botón eliminar
          var h4 = document.createElement('h4');
          h4.classList.value = "mr-5 col-1";
          var btnEliminar = document.createElement('button');
          btnEliminar.id = "btnEliminarSnippet"+i;
          btnEliminar.type = "button";
          btnEliminar.classList.value = "btn btn-danger text-white ml-5 mb-3";
          btnEliminar.setAttribute( "onClick", "deleteSetSnippet("+i+")" )
          var iconoEliminar = document.createElement('i');
          iconoEliminar.classList.value = "fa fa-close";
          btnEliminar.appendChild(iconoEliminar);
          h4.appendChild(btnEliminar);
          snippets.appendChild(h4);

          //h5 campo
          var h5 = document.createElement('h5');
          h5.classList.value = "form-control-lg txtVioletaP text-center col-8 ml-5 mb-3 inputVioleta";
          h5.id = "campoMostrarSnippet"+i;
          h5.appendChild( document.createTextNode(columnas[vistaTabla][i]) );
          snippets.appendChild(h5);

        }
      }

      function deleteSetSnippet(numSnippet){
        var snippets = document.getElementById("snippets");
        snippets.removeChild(document.getElementById('snippetSetAccion'+numSnippet));
        snippets.removeChild(document.getElementById('snippetSetCampo'+numSnippet));
        snippets.removeChild(document.getElementById('snippetSetModo'+numSnippet));
        snippets.removeChild(document.getElementById('btnEliminarSnippet'+numSnippet).parentNode);
        snippets.removeChild(document.getElementById('campoMostrarSnippet'+numSnippet));
      }

      function addWhereSnippet(columnas, vistaTabla){
        var snippets = document.getElementById("snippets");

        //HideInput Accion
        var hideInput = document.createElement('input');
        hideInput.name = "snippetWhereAccion";
        hideInput.id = "snippetWhereAccion";
        hideInput.value = "Buscar";
        hideInput.type = "hidden";
        snippets.appendChild(hideInput);
        //Nombre Acción
        var h5 = document.createElement('h5');
        h5.appendChild( document.createTextNode('Buscar') );
        h5.classList.value = "col-3 txtVioletaMedioClar font-weight-bold mt-2 text-center";
        snippets.appendChild(h5);

        //Select campos
        var select = document.createElement('select');
        select.id = "snippetWhereCampo";
        select.name = "snippetWhereCampo";
        select.classList.value = "form-control-lg text-center mb-3 col-8 inputVioleta sinFlecha";
        select.required = true;

        var opcion = document.createElement('option');
        opcion.appendChild( document.createTextNode('Selecciona el campo') );
        opcion.disabled = true;
        opcion.selected = true;
        select.appendChild(opcion);

        for (var i = 0; i < columnas[vistaTabla].length; i++) {
          opcion = document.createElement('option');
          opcion.appendChild( document.createTextNode( columnas[vistaTabla][i] ) );
          opcion.value = columnas[vistaTabla][i];
          select.appendChild(opcion);
        }
        snippets.appendChild(select);
      }

      function addOrderBySnippet(columnas, vistaTabla){
        var snippets = document.getElementById("snippets");

        //HideInput Accion
        var hideInput = document.createElement('input');
        hideInput.name = "snippetOrderByAccion";
        hideInput.id = "snippetOrderByAccion";
        hideInput.value = "Ordenar";
        hideInput.type = "hidden";
        snippets.appendChild(hideInput);

        //Nombre Acción
        var h5 = document.createElement('h5');
        h5.appendChild( document.createTextNode('Ordenar') );
        h5.classList.value = "col-3 txtVioletaMedioClar font-weight-bold mt-2 text-center";
        snippets.appendChild(h5);
        //Select campos
        var select = document.createElement('select');
        select.id = "snippetOrderByCampo";
        select.name = "snippetOrderByCampo";
        select.classList.value = "form-control-lg text-center mb-3 col-6 inputVioleta sinFlecha";
        select.required = true;

        var opcion = document.createElement('option');
        opcion.appendChild( document.createTextNode('Selecciona el campo') );
        opcion.disabled = true;
        opcion.selected = true;
        select.appendChild(opcion);

        for (var i = 0; i < columnas[vistaTabla].length; i++) {
          opcion = document.createElement('option');
          opcion.appendChild( document.createTextNode( columnas[vistaTabla][i] ) );
          opcion.value = columnas[vistaTabla][i];
          select.appendChild(opcion);
        }
        snippets.appendChild(select);

        //Checkbox modo
        var parrafo = document.createElement('p');
        parrafo.classList.value = "col-2";
        var checkbox = document.createElement('input');
        checkbox.type = "checkbox";
        checkbox.id = "snippetOrderByModo";
        checkbox.name = "snippetOrderByModo";
        checkbox.value = "invertir";
        parrafo.appendChild(checkbox);
        var label = document.createElement('label');
        label.htmlFor = "snippetOrderByModo";
        label.classList.value = "form-control-lg w-100 pt-3 txtVioletaP";
        label.appendChild( document.createTextNode(' Invertir') );
        parrafo.appendChild(label);
        snippets.appendChild(parrafo);

      }

      function getVistaTabla(){
        var vistaDocu = document.getElementById("vistadocu");
        var tablaDocu = document.getElementById("tabladocu");
        if(vistaDocu.value == "default"){
          return tablaDocu.value;
        }
        return vistaDocu.value;
      }

      function createColumnas(){
        var vistaDocu = document.getElementById("vistadocu");
        var columnas = [];
        if(vistaDocu.value == "default"){
          <?php
          foreach ($tablas as $key => $columnas) {
            ?>
              columnas.push('<?php echo $key; ?>');
              columnas['<?php echo $key; ?>'] = [];
            <?php
            foreach ($columnas as $columna) {
              ?>
              columnas['<?php echo $key; ?>'].push('<?php echo $columna->getNombre(); ?>');
              <?php
            }
          }?>
        }else{
          <?php
          foreach ($views as $key => $columnas) {
            ?>
              columnas.push('<?php echo $key; ?>');
              columnas['<?php echo $key; ?>'] = [];
            <?php
            foreach ($columnas as $columna) {
              ?>
              columnas['<?php echo $key; ?>'].push('<?php echo $columna->getNombre(); ?>');
              <?php
            }
          }?>
        }
        return columnas;
      }

      function changeActionsByView(){
        var vistaDocu = document.getElementById("vistadocu");
        var actionDocu = document.getElementById("actionDocu");
        var snippets = document.getElementById("snippets");
        document.getElementById("titulosFiltrado").classList.add('oculto');
        snippets.innerHTML = '';
        actionDocu.innerHTML = '';

        var opcion = document.createElement('option');
        opcion.appendChild( document.createTextNode('Selecciona una acción') );
        opcion.disabled = true;
        opcion.selected = true;
        actionDocu.appendChild(opcion);
        if(vistaDocu.value == 'default'){
          opcion = document.createElement('option');
          opcion.appendChild( document.createTextNode('Insertar') );
          opcion.value = 'Create';
          actionDocu.appendChild(opcion);

          opcion = document.createElement('option');
          opcion.appendChild( document.createTextNode('Actualizar') );
          opcion.value = 'Update';
          actionDocu.appendChild(opcion);

          opcion = document.createElement('option');
          opcion.appendChild( document.createTextNode('Eliminar') );
          opcion.value = 'Delete';
          actionDocu.appendChild(opcion);
        }

        opcion = document.createElement('option');
        opcion.appendChild( document.createTextNode('Mostrar') );
        opcion.value = 'Read';
        actionDocu.appendChild(opcion);

        opcion = document.createElement('option');
        opcion.appendChild( document.createTextNode('Mostrar por campo') );
        opcion.value = 'ReadBy';
        actionDocu.appendChild(opcion);
      }

      function changeViewByTable(){
        var vistas = [];
        <?php foreach ($vistasByTable as $key => $vistas) {
          ?>
          vistas.push('<?php echo $key; ?>');
          vistas['<?php echo $key; ?>'] = [];
          <?php
          foreach ($vistas as $vista) {
            ?>
            vistas['<?php echo $key; ?>'].push('<?php echo $vista->getNombre(); ?>');
            <?php
          }
          ?>
          <?php
        }
        ?>
        var tablaDocu = document.getElementById("tabladocu");
        var vistaDocu = document.getElementById("vistadocu");
        var snippets = document.getElementById("snippets");
        document.getElementById("titulosFiltrado").classList.add('oculto');
        snippets.innerHTML = '';
        vistaDocu.innerHTML = '';

        var opcion = document.createElement('option');
        opcion.appendChild( document.createTextNode('Selecciona la vista') );
        opcion.disabled = true;
        opcion.selected = true;
        vistaDocu.appendChild(opcion);

        opcion = document.createElement('option');
        opcion.appendChild( document.createTextNode('Default (Tabla base)') );
        opcion.value = 'default';
        vistaDocu.appendChild(opcion);

        for (var i = 0; i < vistas[tablaDocu.value].length; i++) {
          opcion = document.createElement('option');
          opcion.appendChild( document.createTextNode(vistas[tablaDocu.value][i]) );
          opcion.value = vistas[tablaDocu.value][i];
          vistaDocu.appendChild(opcion);
        }

      }
    </script>
  </div>
</div>
