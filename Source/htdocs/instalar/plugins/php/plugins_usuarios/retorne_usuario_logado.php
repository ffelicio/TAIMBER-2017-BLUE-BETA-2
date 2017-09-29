<?php

// retorna se o usuario esta logado
function retorne_usuario_logado(){

// valida se desloga todos os usuarios
if(DESLOGAR_TODOS_USUARIOS == true){
	
	// desloga todos os usuarios
	return false;
	
};

// retorno
return $_SESSION[SESSAO_LOGADO];

};

?>