
// exibe o scrool da pagina
function exibe_scrool_pagina(modo){

// valida o modo
if(modo == true){
	
	// altera o css da pagina
	$("body").css("overflow-y", "scroll");	
	$("body").css("overflow-x", "hidden");
	
}else{
	
	// altera o css da pagina
	$("body").css("overflow", "hidden");	
	
};

};
