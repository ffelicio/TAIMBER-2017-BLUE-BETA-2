<?php

// retorna noticias de banco de dados
function retorne_noticias_banco_dados($modo){

// modo true calcula paginacao porque não usa jquery
// modo false usa paginacao porque usa jquery

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[35];

// id de usuario logado
$uid = retorne_idusuario_logado();

// tipo de acao
$tipo_acao = retorne_tipo_acao_pagina();

// valida o modo
if($modo == false){
	
	// valida modo
	switch(retorne_campo_formulario_request(6)){
		
		case 1:
		// limit de query
		$limit_query = "limit ".contador_avanco($tipo_acao, 4).", ".NUMERO_VALOR_PAGINACAO;
		break;
		
		case 2:
		// limit de query
		$limit_query = "limit ".contador_avanco($tipo_acao, 1).", ".NUMERO_VALOR_PAGINACAO;
		break;
		
		default:
		// limit de query
		$limit_query = retorne_limit_query_iniciar(false, null);

	};

}else{
	
	// paginador
	$paginador = retorne_campo_formulario_request(52);
	
	// valida paginador
	if($paginador == null){
		
		// seta valor padrao
		$paginador = 0;
		
	};

	// calculando paginador
	$paginador *= NUMERO_VALOR_PAGINACAO;

	// limit de query
	$limit_query = "limit $paginador, ".NUMERO_VALOR_PAGINACAO;

};

// query
$query = retorne_query_pesquisa_noticias($limit_query);

// dados de query
$dados_query = plugin_executa_query($query);

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// contador
$contador = 0;

// valida numero de linhas
if($numero_linhas == 0){
	
	// retorno nulo
	return null;
	
};

// ultima data
$ultima_data = null;

// carregando noticias
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// obtendo dados
	$dados = $dados_query["dados"][$contador];
	
	// separando dados
	$id = $dados["id"];
	$uid = $dados[UID];
	$titulo = $dados[TITULO];
	$link = $dados[LINK];
	$descricao = $dados[DESCRICAO];
	$data_noticia = $dados[DATA_NOTICIA];
	$data = $dados[DATA];
	
	// valida id
	if($id != null){
		
		// converte entidades para html
		$descricao = html_entity_decode($descricao);

		// html
		$html .= monta_noticia($link, $titulo, $descricao, $data_noticia);
		
		// atualizando ultima data de atualizacao
		if($ultima_data == null and $data != null){
			
			// atualizando a ultima data
			$ultima_data = $data;
		
		};
		
	};

};

// atualizando dados de retorno
$dados_retorno[CONTEUDO] = $html;
$dados_retorno["ultima_data"] = $ultima_data;
$dados_retorno["linhas"] = $numero_linhas;

// retorno
return $dados_retorno;

};

?>