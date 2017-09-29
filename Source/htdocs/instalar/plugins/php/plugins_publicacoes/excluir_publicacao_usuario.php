<?php

// exclui a publicacao de usuario
function excluir_publicacao_usuario($id, $modo){

// modo true compartilhado
// modo false normal

// globals
global $tabela_banco;
global $idioma_sistema;

// valida o modo
if($modo == true){
	
	// id de usuario
	$idusuario = retorne_idusuario_dono_publicacao($id);

}else{
	
	// id de usuario logado
	$idusuario = retorne_idusuario_logado();	
	
};

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno nulo
    return null;
	
};

// id de pagina
$pagina = retorne_idpagina_request();

// query
$query[0] = "select *from $tabela_banco[5] where id='$id' and uid='$idusuario';";
$query[1] = "delete from $tabela_banco[5] where id='$id' and uid='$idusuario';";

// valida pagina
if($pagina == null){
	
	// query
	$query[2] = "select *from $tabela_banco[5] where uid='$idusuario' and pagina='';";
	
}else{
	
	// query
	$query[2] = "select *from $tabela_banco[5] where uid='$idusuario' and pagina='$pagina';";

};

// dados de publicacao
$dados_publicacao = plugin_executa_query($query[0]);

// exclui as imagens por chave
exclui_imagens_chave($dados_publicacao["dados"][0][CHAVE]);

// exclui os comentarios
excluir_todos_comentarios($id, $tabela_banco[5]);

// exclui as curtidas de publicacao, imagens etc
exclui_curtidas_publicacao($id, $tabela_banco[5]);

// executa query
plugin_executa_query($query[1]);

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

// erradica os feeds do usuario
erradicar_feeds_usuario(false, $id, null);

// remove marcacoes
remove_marcacao_usuario($id, $tabela_banco[5]);

// exclui musica de usuario
excluir_musica_usuario($id, $dados_publicacao["dados"][0][CHAVE]);

// exclui video de usuario
excluir_video_usuario($id, $dados_publicacao["dados"][0][CHAVE]);

// exclui o conteudo de url
exclui_conteudo_url($dados_publicacao["dados"][0][CHAVE]);

// remove o visualizado
remove_visualizado($id, $tabela_banco[5]);

// dados de publicacao
$dados_publicacao = plugin_executa_query($query[2]);

// numero de publicacoes
$numero_publicacoes = $dados_publicacao["linhas"];

// singular ou plural
if($numero_publicacoes > 1){
	
	// plural
	$numero_publicacoes = retorne_tamanho_resultado($numero_publicacoes);
	
	// campo publicacoes
	$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[519]</div>
	";
	
}else{

	// campo publicacoes
	$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[518]</div>
	";
	
};

// array de retorno
$array_retorno["linhas"] = $numero_publicacoes;

// remove a notificacao
remove_notifica(null, $id, $tabela_banco[5], true);

// retorno
return json_encode($array_retorno);

};

?>