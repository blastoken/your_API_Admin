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
