<?php

// exclui ou aceita o depoimento
function excluir_aceitar_depoimento(){

// globals
global $tabela_banco;

// dados de formulario
$id = retorne_campo_formulario_request(4);
$modo = retorne_campo_formulario_request(6);

// dados de depoimento
$dados = retorne_dados_depoimento($id);

// separa os dados
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];

// retorna se pode excluir o depoimento
if(retorne_pode_excluir_depoimento($dados) == false){
	
	// retorno nulo
    return null;
	
};

// tabela
$tabela = $tabela_banco[13];

// valida o modo
switch($modo){
	
    case 1:
	$query = "delete from $tabela where id='$id';";
	$deletou = -1;
	break;
	
	case 2:
	$query = "update $tabela set aceito='1' where id='$id';";
	$deletou = 0;
	break;

};

// executa query
plugin_executa_query($query);

// array de retorno
$array_retorno["dados"] = campo_visualizar_depoimentos(false);
$array_retorno["deletou"] = $deletou;

// retorno
return json_encode($array_retorno);

};

?>