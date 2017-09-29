<?php

// retorna se zera o contador de avanco de pesquisa de pagina
function retorne_zerar_contador_avanco_pesq_pagina($termo_pesquisa){

// valida nome nulo e sessao diferente de nulo
if($termo_pesquisa == null and $_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] != null){

	// atualiza dados de sessao
    $_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] = null;

	// retorno
	return true;
	
};

// valida se esta pesquisando por nome
if($termo_pesquisa == null){
	
	// atualiza dados de sessao
    $_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] = null;

	// retorno nulo
    return false;
	
};

// valida valor de sessao atual e retorna
if($_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] == $termo_pesquisa){

    // retorno
	return false;

}else{

    // atualiza dados de sessao
    $_SESSION[SESSAO_NOME_PESQ_PAGINA][retorna_token_pagina_requeste()] = $termo_pesquisa;
	
	// retorno
	return true;

};

};

?>