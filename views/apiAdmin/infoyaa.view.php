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
          <h3>buenas tardes señores, que tal?</h3>
        </div>
        <a href="#CrearAPI" class="pregunta col-11 m-2 mt-3 font-weight-bolder" onclick="mostrarOcultarFAQ(1)">¿Qué necesito para crear una API?</a>
        <div id="oculto1" class="col-11 p-2 infoOculta oculto">
          <h3>buenas tardes señores, que tal?</h3>
        </div>
        <a href="#MuestraInfo" class="pregunta col-11 m-2 mt-3 font-weight-bolder" onclick="mostrarOcultarFAQ(2)">¿Cómo muestro la información de varias tablas?</a>
        <div id="oculto2" class="col-11 p-2 infoOculta oculto">
          <h3>buenas tardes señores, que tal?</h3>
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
        for (var i = 0; i < ocultos.length; i++) {
          ocultos[i].classList.add("oculto");
        }
        seleccionado.classList.remove("oculto");
      }
  </script>
</div>
