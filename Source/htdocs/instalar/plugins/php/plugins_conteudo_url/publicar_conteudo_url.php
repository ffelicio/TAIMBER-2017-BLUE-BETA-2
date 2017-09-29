<?php

// publica conteudo de url
function publicar_conteudo_url(){

// globals
global $idioma_sistema;
global $tabela_banco;

// dados de formulario
$chave = retorna_chave_request();
$titulo = remove_html($_REQUEST[TITULO]);
$descricao = remove_html($_REQUEST[DESCRICAO]);
$imagens = remove_html($_REQUEST[IMAGENS]);
$url = remove_html($_REQUEST[URL]);

// data atual
$data = data_atual();

// valida conteudos de formularios
if($chave == null and $titulo == null and $descricao == null and $imagens == null and $url == null){
	
	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[407]);
	
	// retorno
	return json_encode($array_retorno);
	
};

// remove codigo null de imagens se houver
$imagens = str_ireplace("null", null, $imagens);

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[29];

// query
$query[0] = "delete from $tabela where chave='$chave' and uid='$uid';";
$query[1] = "insert into $tabela values(null, '$chave', '$titulo', '$descricao', '$imagens', '$uid', '$url', '0', '$data');";

// publicando
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

// array de retorno
$array_retorno["dados"] = constroe_conteudo_publicacao_conteudo_url($chave, true);

// retorno
return json_encode($array_retorno);

};

?>