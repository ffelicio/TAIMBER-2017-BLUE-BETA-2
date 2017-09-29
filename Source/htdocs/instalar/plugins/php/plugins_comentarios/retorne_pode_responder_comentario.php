<?php

// retorna se pode responder comentario
function retorne_pode_responder_comentario($id){

// globals
global $tabela_banco;

// query
$query[0] = "select *from $tabela_banco[7] where id='$id';";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// dados
$dados = $dados_query["dados"][0];

// separa os dados
$uid = $dados[UID];
$id_post = $dados[ID_POST];

// valida se o post é de pagina
if(retorne_idpagina_postagem($id_post) != null){
	
	// retorno verdadeiro
	return true;

};

// valida se o usuario é amigo ou dono do perfil
if(retorne_usuario_amigo($uid) == true or retorne_usuario_dono_perfil($uid) == true){
	
	// retorna verdadeiro
	return true;
	
	
}else{
	
	// retorno falso
	return false;
	
};

};

?>