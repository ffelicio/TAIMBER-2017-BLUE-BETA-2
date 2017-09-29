<?php

// retorna usuario logado ativou conta
function retorne_usuario_logado_ativou_conta(){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[30];

// query
$query = "select *from $tabela where uid='$uid';";

// dados
$array_dados = plugin_roda_query($query);

// retorno
if($array_dados["linhas"] == 0){
	
	// ativou
	return true;
	
}else{
	
	// não ativou
	return false;
	
};

};

?>