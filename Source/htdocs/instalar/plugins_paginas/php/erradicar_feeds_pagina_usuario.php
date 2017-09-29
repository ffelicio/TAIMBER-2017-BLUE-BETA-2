<?php

// erradica os feeds da pagina do usuario
function erradicar_feeds_pagina_usuario($modo, $id_post, $uidamigo, $pagina){

// globals
global $tabela_banco;

// valida id de pagina
if($pagina == null){
	
	// retorno nulo
    return null;
	
};

// query
$query[0] = "select *from $tabela_banco[22] where pagina='$pagina';";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// contador
$contador = 0;

// listando amigos
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// dados de array de amigos
    $dados = $dados_query["dados"][$contador];
	
	// id de usuario amigo
    $idusuario = $dados[UIDAMIGO];
	
	// data atual
	$data = data_atual();	
	
	// query para adicionar
	$query[1] = "insert into $tabela_banco[8] values(null, '$idusuario', '$uidamigo', '$id_post', '$data');";

	// query para excluir
	$query[2] = "delete from $tabela_banco[8] where uid='$idusuario' and id_post='$id_post';";

	// erradica a publicacao
	if($modo == true){

	    // valida idusuario
	    if($idusuario != null){
		
	        // primeiro remove a duplicata da publicacao
		    plugin_executa_query($query[2]);
		
		    // agora adiciona o novo feed
		    plugin_executa_query($query[1]);

	    };		
	
	}else{

		// valida idusuario
	    if($idusuario != null){
		
	        // remove o feed antigo
		    plugin_executa_query($query[2]);

	    };
		
	};
	
};

};

?>