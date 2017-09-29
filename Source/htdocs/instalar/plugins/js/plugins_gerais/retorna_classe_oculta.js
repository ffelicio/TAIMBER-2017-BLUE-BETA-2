
// retorna se uma classe esta oculta
function retorne_classe_oculta(classe_elemento){

// retorno false existe classe aberta
// retorno true classe fechada

// pegando elementos
var elements = document.getElementsByClassName(classe_elemento);

// fechando todos os elementos
for(var i = 0; i < elements.length; i++){

	// valida tamanho de propriedade
	if(elements[i].style.display.length > 0){
		
		// valida classe de elemento
		if(elements[i].style.display != "none"){
			
			// retorno
			return false;
			
		};

	};

};

// retorno
return true;

};
