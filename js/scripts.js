function cambiarPaginaActivaNavbar(){
  var ul = document.getElementById("barraNavegacion");
  var pagActual = location.href.split("/");
  if(pagActual[pagActual.length-1] == ""){
    ul.childNodes[1].lastElementChild.attributes.class.nodeValue += " active";
    ul.childNodes[3].lastElementChild.attributes.class.nodeValue += " noactive";
    ul.childNodes[5].lastElementChild.attributes.class.nodeValue += " noactive";
    console.log("Página de inicio");
  }else{
    for (var i = 0; i <= ul.childNodes.length-1; i++) {
      if(ul.childNodes[i].lastElementChild != null){
        if(ul.childNodes[i].lastElementChild.attributes.href.nodeValue == pagActual[pagActual.length-1]){
          ul.childNodes[i].lastElementChild.attributes.class.nodeValue += " active";
          console.log("Nodo nº".concat(i," activo"));
        }else{
          ul.childNodes[i].lastElementChild.attributes.class.nodeValue += " noactive";
        }
      }
    }
  }
}

function addClaseByIdElement(clase, id){
  var element = document.getElementById(id);
  element.attributes.class.nodeValue += " ".concat(clase);
}

function deleteClaseByIdElement(clase, id){
  var element = document.getElementById(id);
  let clases = element.attributes.class.nodeValue.split(" ");
  let valueClases;
  for (var i = 0; i <= clases.length-1; i++) {
    if(clases[i] != clase){
      valueClases += clases[i].concat(" ");
    }
  }
}

function cambiarPaginaActivaSide(){
  var ul = document.getElementById("menuLateral");
  var pagActual = location.href.split("/");
  for (var i = 0; i <= ul.children.length-1; i++) {
    if(ul.children[i].className !== "header"){
      if(ul.children[i].lastElementChild.attributes.href.nodeValue == pagActual[pagActual.length-1]){
          ul.children[i].style = "background-color: var(--violetaMedio);";
          console.log("Nodo nº".concat(i," activo en sidebar"));
      }
    }
  }
}

function cambioImagen(id, img){
  let imagen = document.getElementById(id);
  imagen.src= img;
}

function getValuesToModal(tabla, num){
  let taula = document.getElementById(tabla);
  var formulario = document.getElementById("formularioModal");
  //console.log(taula);
  console.log(formulario);
  let cells = taula.rows[num].cells;

  for (var i = 0; i < cells.length-1; i++) {
    formulario[i].value = cells[i].innerText;
  }
  formulario.lastElementChild.value = "Actualizar";
  formulario.lastElementChild.id = "update";
  formulario.lastElementChild.name = "update";
  console.log(num);
}

function resetValuesModal(){
  var formulario = document.getElementById("formularioModal");

  for (var i = 0; i < formulario.elements.length-1; i++) {
    formulario[i].value = "";
  }
  formulario.lastElementChild.value = "Insertar";
  formulario.lastElementChild.id = "insertar";
  formulario.lastElementChild.name = "insertar";

}
