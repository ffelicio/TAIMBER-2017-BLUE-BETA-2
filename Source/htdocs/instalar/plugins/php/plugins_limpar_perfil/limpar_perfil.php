<?php

// limpar o perfil
function limpar_perfil(){

// seleciona a opcao a ser limpa
switch(retorne_campo_formulario_request(18)){

    case 1:
	limpar_visitas_perfil();
	break;
	
	case 2:
	limpar_comentarios();
	break;
	
	case 3:
	limpar_curtidas();
	break;
	
	case 4:
	limpar_solicitacoes_amizade(1);
	break;
	
	case 5:
	limpar_solicitacoes_amizade(2);
	break;
	
	case 6:
	limpar_feeds();
	break;
	
	case 7:
	excluir_todas_mensagens();
	break;
	
	case 8:
	limpar_notificacoes();
	seta_todas_mensagens_visualizadas();
	break;
	
	case 9:
	limpar_solicitacoes_relacionamentos();
	break;
	
};

// dados de retorno
$dados_retorno["dados"] = null;

// retorno
return json_encode($dados_retorno);

};

?>