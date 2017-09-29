
// ocultador de classes
$(document).keyup(function(e){
	
	// tecla esc
    if(e.keyCode == 27){
		
		// ocultando classes...
		ocultar_elementos_classe("classe_div_menu_suspense");
		ocultar_elementos_classe("div_janela_mensagem_dialogo_acao");
		ocultar_elementos_classe("div_janela_principal_mensagem_dialogo");
   		ocultar_elementos_classe("classe_div_visualizador_album");
		ocultar_elementos_classe("div_janela_principal_mensagem_dialogo_grande");
		ocultar_elementos_classe("div_janela_principal_mensagem_dialogo_medio");
		
		// altera o css da pagina
		exibe_scrool_pagina(true);
	
	};
	
});