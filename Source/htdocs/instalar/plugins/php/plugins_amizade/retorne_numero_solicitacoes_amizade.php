<?php

// retorna o numero de solicitacoes de amizade
function retorne_numero_solicitacoes_amizade($modo){

# >> modo 1 enviou <<
# >> modo 2 recebeu <<

// globals
global $tabela_banco;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// valida modo e constroe query
switch($modo){

    case 1: // query solicitacao enviou
	$query = "select *from $tabela_banco[6] where uid='$idusuario' and aceito='0';";
    break;
	
	case 2: // query solicitacao recebeu
	$query = "select *from $tabela_banco[6] where uidamigo='$idusuario' and aceito='0' and uidenviou!='$idusuario';";
	break;
	
};

// dados query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>