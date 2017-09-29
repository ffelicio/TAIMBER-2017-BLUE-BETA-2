
// retorna se algumas classes estao abertas ao fechar o dialogo
function retorne_classes_abertas_fechar_dialogo(){

// valida classe
if(retorne_classe_oculta("classe_div_menu_suspense") == false){
	
	// classe aberta
	return true;
	
};

// valida classe
if(retorne_classe_oculta("div_janela_principal_mensagem_dialogo") == false){
	
	// classe aberta
	return true;
	
};

// valida classe
if(retorne_classe_oculta("classe_div_visualizador_album") == false){
	
	// classe aberta
	return true;
	
};

// valida classe
if(retorne_classe_oculta("div_janela_mensagem_dialogo_acao") == false){
	
	// classe aberta
	return true;
	
};

// valida classe
if(retorne_classe_oculta("div_janela_principal_mensagem_dialogo_grande") == false){
	
	// classe aberta
	return true;
	
};

// retorno padrao
return false;

};
