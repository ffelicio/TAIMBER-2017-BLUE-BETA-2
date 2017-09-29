<?php

// retorna se o usuario e amigo
function retorne_usuario_amigo($uid){

// globals
global $tabela_banco;

// id de usuario
$idusuario = retorne_idusuario_logado();

// valida usuario dono do perfil
if($uid == $idusuario or $uid == null){
	
	// retorno
	return false;
	
};

// tabela
$tabela = $tabela_banco[6];

// query
$query = "select *from $tabela where ((uid='$uid' and uidamigo='$idusuario') or (uid='$idusuario' and uidamigo='$uid')) and aceito='1';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"] == 2;

};

?>