<?php

// constroe recomendações de musicas
function carrega_recomendacoes_musicas($modo_recomendar){

// globals
global $tabela_banco;
global $idioma_sistema;
global $variavel_campo;

// tipo de acao de pagina
$tipo_acao = retorne_tipo_acao_pagina();

// tabela
$tabela[0] = $tabela_banco[26];

// id de usuasrio logado
$uid = retorne_idusuario_logado();

// url de pagina inicial
$url_pagina_inicial = PAGINA_INICIAL;

// valida o tipo de acao e o modo recomendar
if($tipo_acao == 112 and $modo_recomendar == true){
	
	// retorno nulo
	return null;
	
};

// valida o modo recomendar
if($modo_recomendar == true){

	// limit
	$limit = "limit 0, ".NUMERO_RECOMENDACOES_INICIO;
	
}else{
	
	// limit
	$limit = retorne_limit_query_iniciar(true, $tipo_acao);

};

// lista de query
$lista_query = retorne_completa_recomendar_musicas();

// query
$query = "select *from $tabela[0] where ($lista_query) and uid!='$uid' order by id desc $limit;";

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// valida o numero de linhas
if($linhas == 0){

	// retorno
	return null;
	
};

// constroe o player
$html = constroe_link_media($dados_query, $modo_recomendar, false);

// links
$link[0] = "<a href='$url_pagina_inicial?$variavel_campo[2]=112' title='$idioma_sistema[607]'>$idioma_sistema[607]</a>";

// valida o modo recomendar
if($modo_recomendar == true){
	
	// campos
	$campo[0] = "

	<div class='classe_titulo_recomendar_musica classe_cor_29 span_link'>
	$link[0]
	</div>

	";

	// classes
	$classe[0] = "classe_conteudo_recomendar_musica";
	
}else{

	// classes
	$classe[0] = "classe_conteudo_recomendar_musica_2";	
	
};

// html
$html = "

<div class='$classe[0]'>
$html
</div>

$campo[0]

";

// valida o modo recomendar
if($modo_recomendar == false){
	
	// retorno
	return constroe_conteudo_padrao(true, $html, null);
	
};

// retorno
return $html;

};

?>