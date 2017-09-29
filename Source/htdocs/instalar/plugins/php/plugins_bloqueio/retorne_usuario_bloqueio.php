<?php

// retorna se o usuario esta bloqueado
function retorne_usuario_bloqueio($idusuario){

// globals
global $tabela_banco;

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil($idusuario) == true){
	
	// nao esta bloqueado
    return false;
	
};

// id de usuario logado
$idusuario_logado = retorne_idusuario_logado();

// query
$query = "select *from $tabela_banco[10] where uid='$idusuario_logado' and uidamigo='$idusuario';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"] != 0;

};

?>