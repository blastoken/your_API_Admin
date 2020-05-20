<div class="content-container fondoVioleta0">

  <div class="container-fluid fondoVioleta0 pb-5">

    <h1 class="text-center txtVioletaOscur font-weight-bold">Más información</h1>
    <div class="row justify-content-center align-items-center">

      <h4 class="txtVioletaP mt-5 m-2 col-9">Si estás desarrollando una aplicación y <b>necesitas una API</b> para el almacenado y gestión de los datos de esta con <b>Your API Admin</b> puedes crear tu base de datos y tu API, exportar los datos, generar tus entidades para varios lenguajes, ... intuitivamente y además <b>en pocos minutos.</b></h4>
      <img src="imgs/servidoryaa.png" class="col-2" alt="servidoryaa" height="220px" />

      <hr class="hrVioleta col-11"/>

        <img src="imgs/tiempoyaa.png" class="col-2" alt="tiempoyaa" />
        <div class="col-9">
          <h4 class="txtVioletaP m-2">Necesitas mucho tiempo para implementar una Base de Datos y la consecuente API en tu servidor para desarrollar tu App o <b>quieres empezar a diseñar ya?</b> </h4><h3 class="txtVioletaP m-2">No te preocupes nuestro servicio está <b>disponible 24h los 7 días de la semana.</b></h4>
        </div>
        <hr class="hrVioleta col-11"/>

      <h3 class="txtVioletaOscur m-2 font-weight-bolder col-12 text-center">¿Porque Your API Admin?</h3>
      <div class="col-6 mt-3">
        <ol class="listaGrande txtVioletaP">
          <li><b>Independencia y seguridad</b> en el acceso a los datos</li>
          <li><b>Sencillez y rápidez</b> en la creación y gestión</li>
          <li><b>Disponibilidad</b> 365 días al año</li>
          <li>Interfaz <b>intuitiva</b></li>
        </ol>
      </div>
      <img src="imgs/okayyaa.png" class="col-2 mt-3" alt="tiempoyaa" height="200px" />

      <hr class="hrVioleta col-11"/>
      <div id="faq" class="col-12 row justify-content-center align-items-center">
        <h3 class="txtVioletaOscur m-2 font-weight-bolder col-12 text-center">Preguntas frecuentes (FAQ)</h3>
        <a href="#CrearBaseDatos" class="pregunta col-11 m-2 mt-3 font-weight-bolder" onclick="mostrarOcultarFAQ(0)">¿Cómo creo una Base de Datos?</a>
        <div id="oculto0" class="col-11 p-2 infoOculta oculto">
          <h3 class="txtVioletaP">Accede al apartado de Bases de Datos > pulsa el botón de añadir <button class="btn btnVioleta"><i class="fa fa-plus"></i></button> y introduce el nombre que quieres que tenga la base de datos y un usuario y una contraseña para ella.</h3>
        </div>
        <a href="#CrearAPI" class="pregunta col-11 m-2 mt-3 font-weight-bolder" onclick="mostrarOcultarFAQ(1)">¿Qué necesito para crear una API?</a>
        <div id="oculto1" class="col-11 p-2 infoOculta oculto">
          <h3 class="txtVioletaP">Necesitarás de una base de datos para el almacenado y la gestión de tus datos a través de la API.</h3>
        </div>
        <a href="#MuestraInfo" class="pregunta col-11 m-2 mt-3 font-weight-bolder" onclick="mostrarOcultarFAQ(2)">¿Cómo muestro la información de varias tablas?</a>
        <div id="oculto2" class="col-11 p-2 infoOculta oculto">
          <h3 class="txtVioletaP">Relacionando las tablas con la opción <button class="btn btnVioleta"><i class="fa fa-object-group"></i></button> y creando una vista que muestre los campos que desees de estas tablas. <i>Las vistas</i> puedes crearlas en el menú de cada tabla dentro de la opción <b>Creador de Vistas</b>.</h3>
        </div>
        <a href="#UtilizarAPICreada" class="pregunta col-11 m-2 mt-3 font-weight-bolder" onclick="mostrarOcultarFAQ(3)">¿Cómo utilizo la API que he creado desde mi App?</a>
        <div id="oculto3" class="col-11 p-2 infoOculta oculto">
          <h3>buenas tardes señores, que tal?</h3>
        </div>
      </div>
  </div>
  </div>
  <script>
      function mostrarOcultarFAQ(num){
        var faq = document.getElementById("faq");
        var seleccionado = document.getElementById("oculto"+num);
        var ocultos = document.getElementsByClassName("infoOculta");

        if(seleccionado.classList.contains("oculto")){
          for (var i = 0; i < ocultos.length; i++) {
            ocultos[i].classList.add("oculto");
          }
          seleccionado.classList.remove("oculto");
        }else{
          seleccionado.classList.add("oculto");
        }
      }
  </script>
</div>
