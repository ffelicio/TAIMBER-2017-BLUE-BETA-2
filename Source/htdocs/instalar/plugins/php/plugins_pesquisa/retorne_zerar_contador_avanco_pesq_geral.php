<?php

// retorna se zera o contador de avanco de pesquisa geral
function retorne_zerar_contador_avanco_pesq_geral($nome_pesquisa){

// valida se esta pesquisando por nome
if($nome_pesquisa == null){
	
	// atualiza dados de sessao
    $_SESSION[SESSAO_NOME_PESQ_GERAL][retorne_idusuario_request()] = null;

	// retorno nulo
    return false;
	
};

// valida valor de sessao atual e retorna
if($_SESSION[SESSAO_NOME_PESQ_GERAL][retorne_idusuario_request()] == $nome_pesquisa){

    // retorno
	return false;

}else{

    // atualiza dados de sessao
    $_SESSION[SESSAO_NOME_PESQ_GERAL][retorne_idusuario_request()] = $nome_pesquisa;
	
	// retorno
	return true;

};

};

?>