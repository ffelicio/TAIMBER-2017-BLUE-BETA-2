<?php

// pesquisa as musicas dos usuarios
function pesquisar_musicas_usuarios(){

// globals
global $tabela_banco;
global $idioma_sistema;

// valida chave via requeste
if(retorna_chave_request() == null){
	
	// retorno nulo
	return null;
	
};

// tabela
$tabela = $tabela_banco[26];

// nome de musica a pesquisar
$musica = retorne_campo_formulario_request(42);

// identificador de sessao
$identificador_sessao = SESSAO_TERMO_PESQUISA_MARCADOR.retorna_chave_request();
$identificador_sessao_numero = SESSAO_PESQUISA_MARCADOR_NUMERO_ENCONTROU.retorna_chave_request();

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// valida sessao
if($_SESSION[$identificador_sessao] != $musica){
	
	// atualiza a sessao
	$_SESSION[$identificador_sessao] = $musica;

	// zera o contador
	contador_avanco(retorne_campo_formulario_request(2), 2);
	
	// zera o numero de musicas encontradas
	$_SESSION[$identificador_sessao_numero] = 0;
	
	// zerou contador
	$zerou_contador = 1;
	
}else{
	
	// nao zerou contador
	$zerou_contador = -1;
	
};

// valida zerar numero sessao musicas encontradas
if(contador_avanco(retorne_campo_formulario_request(2), 3) == 0){

	// zera o numero de musicas encontradas
	$_SESSION[$identificador_sessao_numero] = 0;	
	
};

// limit de query
$limit = retorne_limit_query_iniciar(false, null);

// valida musica
if($musica == null){
	
	// id de usuario
	$uid = retorne_idusuario_request();
	
	// query
	$query[0] = "select *from $tabela where uid='$uid' order by id desc $limit;";
	$query[1] = "select *from $tabela where uid='$uid' order by id desc;";

}else{
	
	// query
	$query[0] = "select *from $tabela where titulo_musica like '%$musica%' order by id desc $limit;";
	$query[1] = "select *from $tabela where titulo_musica like '%$musica%' order by id desc;";

};

// dados de query
$dados_query[0] = plugin_executa_query($query[0]);
$dados_query[1] = plugin_executa_query($query[1]);

// numero de linhas
$numero_linhas[0] = $dados_query[1]["linhas"];
$numero_linhas[1] = $dados_query[0]["linhas"];

// atuaiza o numero de musicas encontradas
$_SESSION[$identificador_sessao_numero] += $numero_linhas[1];

// valida atingiu limit de pesquisa
if($numero_linhas[1] == 0){
	
	// retrocede o contador
	contador_avanco(retorne_campo_formulario_request(2), 4);
	
	// dados de query
	$array_retorno["dados"] = null;
	$array_retorno["zerou_contador"] = $zerou_contador;
	$array_retorno["informacoes"] = null;

	// retorno
	return json_encode($array_retorno);
	
};

// valida numero de linhas
if($numero_linhas[0] == 0){
	
	// html
	$html = $nome_usuario.$idioma_sistema[365];
	
};

// valida numero de linhas
if($numero_linhas[0] == 1){
	
	// html
	$html = $nome_usuario.$idioma_sistema[364];
	
};

// valida numero de linhas
if($numero_linhas[0] > 1){
	
	// contador de avanco
	$contador_avanco = contador_avanco(retorne_campo_formulario_request(2), 3);
	
	// tamanho de resultado
	$numero_linhas[0] = retorne_tamanho_resultado($numero_linhas[0]);
	
	// html
	$html = $numero_linhas[0].$idioma_sistema[366].$_SESSION[$identificador_sessao_numero].$idioma_sistema[367];

};

// dados de query
$array_retorno["dados"] = constroe_player(false, $dados_query[0]);
$array_retorno["zerou_contador"] = $zerou_contador;
$array_retorno["informacoes"] = $html;

// retorno
return json_encode($array_retorno);

};

?>