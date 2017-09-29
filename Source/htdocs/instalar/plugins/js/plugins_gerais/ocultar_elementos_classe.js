
// oculta todos os elementos de uma mesma classe
function ocultar_elementos_classe(classe_elemento){

// pegando elementos
var elements = document.getElementsByClassName(classe_elemento);

	// fechando todos os elementos
    for(var i = 0; i < elements.length; i++){
		
		// fechando elemento
        elements[i].style.display = "none";
		
    };
	
};
