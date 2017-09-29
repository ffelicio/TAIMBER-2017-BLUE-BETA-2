<?php

// retorna ou seta valor de contador de avanco
function contador_avanco_comentario($tipo_acao, $modo, $id, $elemento_id){

# >> modo 1 atualiza <<
# >> modo 2 zera <<
# >> modo 3 apenas retorna <<
# >> ambos retornam o valor da sessao <<

// identificador de sessao
$identificador = codifica_md5($tipo_acao.$id.retorne_idusuario_request().SESSAO_CONTADOR_AVANCO_COMENTARIOS.$elemento_id);

// valida o modo
switch($modo){
	
	case 1:
	// atualiza o calculo de paginacao atual
    $_SESSION[SESSAO_CONTADOR_AVANCO_COMENTARIOS][$identificador] += NUMERO_VALOR_PAGINACAO;
	break;
	
	case 2:
	// zera o calculo de paginacao atual
	$_SESSION[SESSAO_CONTADOR_AVANCO_COMENTARIOS][$identificador] = 0;
	break;

};

// valida zera todos os contadores
if($id == null){

    // zera todos os contadores
    $_SESSION[SESSAO_CONTADOR_AVANCO_COMENTARIOS] = null;

};

// retorno
return $_SESSION[SESSAO_CONTADOR_AVANCO_COMENTARIOS][$identificador];

};

?>