
// exibe janela de dialogo
function exibe_dialogo(identificador){

// valida se o dialogo existe
if(retorna_elemento_id_existe(identificador) == false){
	
	// retorno nulo
    return null;
	
};

// exibe o dialogo
if(document.getElementById(identificador).style.display == "none" || document.getElementById(identificador).style.display.length == 0){

	// ocultando classes
	ocultar_elementos_classe("div_janela_mensagem_dialogo_acao");

	// exibe o dialogo
    document.getElementById(identificador).style.display = "block";
	
	// altera o css da pagina
	exibe_scrool_pagina(false); 

}else{
	
	// oculta o dialogo
    document.getElementById(identificador).style.display = "none"

	// retorna se algumas classes estao abertas ao fechar o dialogo
	if(retorne_classes_abertas_fechar_dialogo() == false){
	
		// altera o css da pagina
		exibe_scrool_pagina(true);
		
	};

};

};
