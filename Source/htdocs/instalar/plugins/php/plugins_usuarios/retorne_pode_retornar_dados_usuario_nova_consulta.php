<?php

// retorna se pode retornar os dados do usuario via nova consulta
function retorne_pode_retornar_dados_usuario_nova_consulta($modo, $idusuario, $array_dados){

# >> Esta funcao e usada para evitar que muitas querys sejam executadas <<
# >> Ela e utilizada em retorne_dados_usuario <<

// valida o modo
switch($modo){
	
	case 0: // salva os dados da sessao
	$_SESSION[SESSAO_CHAVE_DADOS_USUARIO][$idusuario] = $array_dados;
	break;
	
	case 1: // limpa os dados da sessao
	$_SESSION[SESSAO_CHAVE_DADOS_USUARIO][$idusuario] = null;
	break;
	
	case 2: // valida chave e retorna
	if($_SESSION[SESSAO_CHAVE_DADOS_USUARIO][$idusuario] == null){
		
		// pode retornar dados atraves de nova consulta no query
		return true;
		
	}else{
		
		// nao pode retornar dados atraves de nova, entao pegue da sessao estes dados
		return false;
		
	};
	break;
	
	case 3: // retorna os dados da sessao
	return $_SESSION[SESSAO_CHAVE_DADOS_USUARIO][$idusuario];
	break;
	
};

};

?>