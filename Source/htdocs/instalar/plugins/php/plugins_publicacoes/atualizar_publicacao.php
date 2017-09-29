<?php

// atualiza a publicacao
function atualizar_publicacao(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// uid
$uid = retorne_idusuario_logado();

// dados do formulario
$id = retorne_campo_formulario_request(4);
$texto = retorne_campo_formulario_request_htmlentites(36);

// valida se o usuario logado e dono da publicacao
if(retorna_usuario_logado_dono_publicacao($id) == false){
	
	// retorno
	return null;
	
};

// query
$query = "update $tabela set texto='$texto' where id='$id' and uid='$uid';";

// atualizando a publicacao
plugin_executa_query($query);

// converte todas as urls, links, videos etc
$texto = converter_urls(false, $texto);

// retorno
$array_retorno["dados"] = $texto;

// retorno
return json_encode($array_retorno);

};

?>