<?php

// retorna ou seta valor de contador de avanco
function contador_avanco($tipo_acao, $modo){

# >> modo 1 atualiza + <<
# >> modo 2 zera <<
# >> modo 3 apenas retorna <<
# >> modo 4 atualiza - <<
# >> modo 5 atualiza + emoticons <<
# >> modo 6 atualiza - emoticons <<
# >> modo 7 atualiza - << não importa com valor negativo
# >> modo 8 atualiza + recomendacoes usuarios <<
# >> modo 9 atualiza - recomendacoes usuarios <<

// identificador de sessao
$identificador = retorne_identificador_md5_contador_avanco($tipo_acao);

// valida sessao possui valor valido
if($_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] == null){
	
	// seta o valor padrao
    $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = 0;	
	
};

// valida o modo
switch($modo){
	
	case 1:
	// atualiza o calculo de paginacao atual
    $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] += NUMERO_VALOR_PAGINACAO;
	break;
	
	case 2:
	// zera o calculo de paginacao atual
	$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = 0;
	break;

	case 4:
	// atualiza o calculo de paginacao atual
    $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] -= NUMERO_VALOR_PAGINACAO;
	break;
	
	case 5:
	// atualiza o calculo de paginacao atual
	$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] += NUMERO_VALOR_PAGINACAO_EMOTICONS;
	break;

	case 6:
	// atualiza o calculo de paginacao atual
	$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] -= NUMERO_VALOR_PAGINACAO_EMOTICONS;
	break;

	case 7:
	$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = 0;
	$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] -= NUMERO_VALOR_PAGINACAO;
	break;
	
	case 8:
	// atualiza a paginacao de recomendacoes de usuarios
	$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] += NUMERO_RECOMENDACOES_INICIO;
	break;
	
	case 9:
	// atualiza a paginacao de recomendacoes de usuarios
	$_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] -= NUMERO_RECOMENDACOES_INICIO;
	break;
	
};

// valida contador menor que zero
if($_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] < 0 and $modo != 7){

    // seta o valor padrao
    $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador] = 0;	
	
};

// zera todos os contadores de sessao
if($modo == null){

    // zerando todos os contadores
    $_SESSION[SESSAO_CONTADOR_AVANCO] = null;	

};

// retorno
return $_SESSION[SESSAO_CONTADOR_AVANCO][$identificador];

};

?>