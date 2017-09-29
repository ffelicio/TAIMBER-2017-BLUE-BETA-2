<?php

// exclui a imagem de album
function excluir_imagem_album(){

// globals
global $tabela_banco;
global $idioma_sistema;
global $variavel_campo;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno nulo
    return null;
	
};

// retorna o id de imagem
$id = retorne_campo_formulario_request(4);

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query[0] = "select *from $tabela_banco[4] where id='$id' and uid='$uid';";
$query[1] = "delete from $tabela_banco[4] where id='$id' and uid='$uid';";
$query[2] = "select *from $tabela_banco[4] where uid='$uid';";

// dados de imagem
$dados_imagem = plugin_executa_query($query[0]);

// exclui imagem do servidor
exclui_arquivo_unico($dados_imagem["dados"][0][URL_ROOT_GRANDE]);
exclui_arquivo_unico($dados_imagem["dados"][0][URL_ROOT_MINIATURA]);
exclui_arquivo_unico($dados_imagem["dados"][0][URL_ROOT_THUMBNAIL]);

// exclui os comentarios
excluir_todos_comentarios($id, $tabela_banco[4]);

// exclui as curtidas de publicacao, imagens etc
exclui_curtidas_publicacao($id, $tabela_banco[4]);

// executa query
plugin_executa_query($query[1]);

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// array com imagens
$array_imagens = $dados_compilados_usuario[$tabela_banco[4]];

// numero de imagens
$numero_imagens = count($array_imagens) - 1;

// plural ou singular
if($numero_imagens > 1){
	
	// plural
	$numero_imagens = retorne_tamanho_resultado($numero_imagens).$idioma_sistema[22];
	
}else{
	
	// singular
	$numero_imagens = $numero_imagens.$idioma_sistema[21];
	
};

// url de pagina de inicio
$url_index_inicio = PAGINA_INDEX_INICIO;

// urls
$url[0] = "$url_index_inicio?$variavel_campo[5]=$uid&$variavel_campo[2]=7";

// links
$link[0] = "<a href='$url[0]' title='$numero_imagens'>$numero_imagens</a>";

// array de retorno
$array_retorno["linhas"] = $link[0];

// remove a notificacao
remove_notifica(null, $id, $tabela_banco[4], true);

// retorno
return json_encode($array_retorno);

};

?>