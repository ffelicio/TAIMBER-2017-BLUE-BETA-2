
// retorna se um elemento esta focado ou focus
function retorne_elemento_focus(id_elemento){

// primeiro analisa se o elemento existe
if(retorna_elemento_id_existe(id_elemento) == false){
	
	// retorno falso
	return false;
	
};

// analisa se um elemento esta focado
if($("#" + id_elemento).is(":focus")) {

	// retorno verdadeiro
	return true;
	
}else{
	
	// retorno falso
	return false;

};

};