<div class="content-container fondoVioleta0">

  <div class="container-fluid">

  <div class="row justify-content-center align-items-center">
    <?php
    if(sizeof($todasBasesDatos) > 0){
      ?>
    <p class="col-2"></p>
    <h1 class="col-7 text-center txtVioletaOscur font-weight-bold">Administra tu API</h1>
    <button type="button" class="btn btn-lg mt-1 col-2 btnVioleta"  data-toggle="modal" data-target="#modalCreateAPI"><span class="d-none d-lg-block">Crear API</span><i class="fa fa-plus ml-2 font-weight-bold"></i></button>

      <?php
    }else{
      ?>
      <a href="bbddyaa.php" class="btn btn-lg mt-1 col-2 btnVioleta"><i class="fa fa-angle-left mr-2 font-weight-bold"></i>Crear BD</a>
      <h1 class="col-7 text-center txtVioletaOscur font-weight-bold">Administra tu API</h1>
      <p class="col-2"></p>
      <?php
    }
     ?>

    <?php
    if(sizeof($todasBasesDatos) > 0){
      ?>
      <hr class="hrVioleta col-11"/>
        <?php
      if(sizeof($apis) > 0){
        foreach($apis as $api){
          ?>
          <button type="button" class="btn btn-lg btnVioletaOutline p-5 m-2 col-sm-11 col-md-5 col-lg-3 col-xl-2" data-toggle="modal" data-target="#exampleModal" onclick="insertModalBD('<?php echo $api->getNombre(); ?>')">
            <i class="fa fa-code font-weight-bold iconoGrande"></i>
            <h5 class="font-weight-bold text-monospace"><?php echo $api->getNombre(); ?></h5>
          </button>
          <?php
        }
      }else{
        ?>
        <h3 class="txtVioletaOscur text-center mt-3">No tienes ninguna API creada aún...</h3>
        <?php
      }
        ?>

      <?php
    }else{
      ?>
      <h3 class="txtVioletaOscur text-center mt-3">No tienes ninguna base de datos creada para gestionar por API...</h3>
      <?php
    }
     ?>


   </div>
   <div class="modal fade bd-example-modal-lg w-100 p-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h3 class="text-center txtVioletaOscur font-weight-bold">Introduce las credenciales de la API</h3>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form method="post">
             <input type="hidden" id="nombreapi" name="nombreapi" value="default">
              <input type="text" id="userapi" name="userapi" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Usuario de la API" required>
              <input type="password" id="passapi" name="passapi" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Contraseña de la API" required>
              <input id="logginapi" type="submit" name="logginapi" value="Autenticarme"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
           </form>
         </div>
       </div>
     </div>
   </div>
   <div class="modal fade bd-example-modal-lg w-100 p-5" id="modalCreateAPI" tabindex="-1" role="dialog" aria-labelledby="modalCreateAPILabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h3 class="text-center txtVioletaOscur font-weight-bold">Introduce los siguientes datos:</h3>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <form method="post">
             <input type="text" id="nombreapi" name="nombreapi" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Nombre de la API" required>
             <select id="bbddapi" name="bbddapi" class="form-control-lg text-center mb-3 w-100 inputVioleta sinFlecha" required>
               <option disabled selected>Selecciona la base de datos</option>
               <?php foreach ($todasBasesDatos as $bd){ ?>
                 <option value="<?php echo $bd->getNombre(); ?>"><?php echo $bd->getNombre(); ?></option>
               <?php } ?>
             </select>
              <input type="text" id="userapi" name="userapi" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Usuario de la API" required>
              <input type="password" id="passapi" name="passapi" class="form-control-lg text-center mb-3 w-100 inputVioleta" placeholder="Contraseña de la API" required>
              <input id="createapi" type="submit" name="createapi" value="Crear API"  class="btn btn-lg w-100 mt-1 btnVioleta"/>
           </form>
         </div>
       </div>
     </div>
   </div>
   <p id="apiActiva" class="oculto"><?php if(isset($_SESSION['apiActiva'])){ echo $_SESSION['apiActiva']['nombre']; }?></p>
     <script>
      function insertModalBD(nomapi){
        var apiActiva = document.getElementById("apiActiva");
        var inputNombre = document.getElementById("nombreapi");
        if(apiActiva.innerText == nomapi){
          window.location = "listaApi.php";
        }else{
          inputNombre.value = nomapi;
        }
      }
     </script>
  </div>
</div>
