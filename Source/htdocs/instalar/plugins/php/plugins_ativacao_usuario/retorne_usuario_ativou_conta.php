<?php

// retorna se um usuário ativou a sua conta
function retorne_usuario_ativou_conta($uid){

// globals
global $tabela_banco;

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