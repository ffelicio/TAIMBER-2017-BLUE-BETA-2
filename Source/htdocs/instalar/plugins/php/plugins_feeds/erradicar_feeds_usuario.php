<?php

// erradica os feeds do usuario
function erradicar_feeds_usuario($modo, $id_post, $uidamigo){

// globals
global $tabela_banco;

// dados de publicacao
$dados = retorne_dados_publicacao($id_post);

// valida se exclui o feed de publicacao de pagina
if(($modo == false and $uidamigo == null and $dados["id"] == null) or $dados[PAGINA] != null){

	// query para excluir
	$query = "delete from $tabela_banco[8] where id_post='$id_post';";	
	
	// exclui feed de pagina
	plugin_executa_query($query);
	
	// retorno
	return null;
	
};

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// array com dados de amigos
$array_dados_amigos = $dados_compilados_usuario[$tabela_banco[6]];

// valida se o valor e array
if(is_array($array_dados_amigos) == false){

    // retorno nulo
    return null;

};

// contador
$contador = 0;

// listando amigos
for($contador == $contador; $contador <= count($array_dados_amigos); $contador++){
	
	// dados de array de amigos
    $dados = $array_dados_amigos[$contador];
	
	// id de usuario amigo
    $idusuario = retorne_idamigo_dados_amigo(true, $dados, retorne_idusuario_logado());

	// erradica a publicacao
	if($modo == true){
		
		// data atual
		$data = data_atual();
		
		// query para adicionar
	    $query = "insert into $tabela_banco[8] values(null, '$idusuario', '$uidamigo', '$id_post', '$data');";
	
	
	}else{
		
		// query para excluir
		$query = "delete from $tabela_banco[8] where uid='$idusuario' and id_post='$id_post';";
		
	};
	
	// valida idusuario
	if($idusuario != null){
		
	    // salva feed
	    plugin_executa_query($query);
	
	};
	
};

};

?>