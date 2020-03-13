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
