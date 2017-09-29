<?php

// retorna se o usuario logado e dono do compartilhamento
function retorne_usuario_logado_dono_compartilhamento($id){

// globals
global $tabela_banco;

// valida usuario logado dono da publicacao
if(retorne_idusuario_dono_publicacao($id) == retorne_idusuario_logado()){
	
	// sim
	return true;
	
}else{
	
	// nao
	return false;
	
};

};

?>