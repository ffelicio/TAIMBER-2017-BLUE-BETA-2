<?php

// limpa as visitas do perfil
function limpar_solicitacoes_amizade($modo){

// globals
global $tabela_banco;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// valida o modo
switch($modo){
	
    case 1: // query solicitacao enviou
	$query = "delete from $tabela_banco[6] where uid='$idusuario' and aceito='0';";
    break;
	
	case 2: // query solicitacao recebeu
	$query = "delete from $tabela_banco[6] where uidamigo='$idusuario' and aceito='0';";
	break;
	
};

// limpa as visitas
plugin_executa_query($query);

};

?>