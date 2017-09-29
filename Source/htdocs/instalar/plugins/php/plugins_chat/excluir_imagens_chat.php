<?php

// exclui as imagens do chat
function excluir_imagens_chat($uidamigo){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[4];

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// querys
$query[0] = "select *from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// contador
$contador = 0;

// exclui dados de imagem
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
    $url_root_grande = $dados[URL_ROOT_GRANDE];
    $url_root_miniatura = $dados[URL_ROOT_MINIATURA];
	$url_root_thumbnail = $dados[URL_ROOT_THUMBNAIL];
	
	// valida id
	if($id != null){
	
	    // exclui o arquivo no disco
	    exclui_arquivo_unico($url_root_grande);
	    exclui_arquivo_unico($url_root_miniatura);
		exclui_arquivo_unico($url_root_thumbnail);

	};

};

// query
$query[1] = "delete from $tabela where uid='$idusuario' and uidamigo='$uidamigo';";

// exclui na tabela
plugin_executa_query($query[1]);

};

?>