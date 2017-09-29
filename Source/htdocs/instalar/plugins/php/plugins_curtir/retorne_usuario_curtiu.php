<?php

// retorna se o usuario curtiu
function retorne_usuario_curtiu($tipo_campo, $id_post){

// globals
global $tabela_banco;

// id de usuario
$idusuario = retorne_idusuario_logado();

// tabela
$tabela = retorne_tabela_comentario($tipo_campo);

// query
$query = "select *from $tabela_banco[9] where tabela_curtiu='$tabela' and id_post='$id_post' and uid='$idusuario';";

// dados de query
$dados = plugin_executa_query($query);

// retorno
if($dados["linhas"] == 0){
	
	// nao curtiu
    return false;
	
}else{
	
	// curtiu
	return true;
	
};

};

?>