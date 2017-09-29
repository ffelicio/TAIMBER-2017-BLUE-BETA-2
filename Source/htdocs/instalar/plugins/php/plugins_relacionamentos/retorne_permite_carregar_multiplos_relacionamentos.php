<?php

// retorna se permite carregar multiplos relacionamentos
function retorne_permite_carregar_multiplos_relacionamentos($relacao){

// valida relacao
switch($relacao){
	
	case NUMERO_RELACIONAMENTO_FILHOS:
	return true;
	break;
	
	case NUMERO_RELACIONAMENTO_NETOS:
	return true;
	break;
	
	case NUMERO_RELACIONAMENTO_IRMAO:
	return true;
	break;
	
	case NUMERO_RELACIONAMENTO_IRMA:
	return true;
	break;
	
	case NUMERO_RELACIONAMENTO_PRIMO:
	return true;
	break;	
	
	case NUMERO_RELACIONAMENTO_PRIMA:
	return true;
	break;	

	case NUMERO_RELACIONAMENTO_AVO_H:
	return true;
	break;
	
	case NUMERO_RELACIONAMENTO_AVO_M:
	return true;
	break;
	
	default:
	return false;
	
};

};

?>