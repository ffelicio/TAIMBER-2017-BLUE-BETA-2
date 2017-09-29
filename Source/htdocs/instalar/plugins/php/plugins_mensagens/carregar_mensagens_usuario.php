<?php

// carrega as mensagens do usuario
function carregar_mensagens_usuario(){

// valida o modo de carregamento de mensagens
switch(retorne_campo_formulario_request(6)){
	
	case 0:
	// carrega a lista de amigos que enviaram mensagem
    return carregar_amigos_enviaram_mensagem();
	break;
	
	case 1:
	// pesquisa troca de mensagens
	return pesquisar_troca_mensagem(retorne_campo_formulario_request(13));
	break;
	
};

};

?>