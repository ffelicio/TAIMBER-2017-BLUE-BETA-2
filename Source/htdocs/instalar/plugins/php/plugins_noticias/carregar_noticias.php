<?php

// carrega as noticias
function carregar_noticias(){

// globals
global $url_feed;

// tipo de acao
$tipo_acao = retorne_tipo_acao_pagina();

// noticias de banco de dados
$dados = retorne_noticias_banco_dados(false);

// conteudo
$conteudo = $dados[CONTEUDO];

// ultima data de atualização da noticia
$ultima_data = $dados["ultima_data"];

// valida numero de linhas
if($dados["linhas"] == 0 and contador_avanco($tipo_acao, 3) > NUMERO_VALOR_PAGINACAO){
	
	// zera contador de avanco
	contador_avanco($tipo_acao, 7);

	// noticias de banco de dados
	$dados = retorne_noticias_banco_dados(false);

	// conteudo
	$conteudo = $dados[CONTEUDO];

	// ultima data de atualização da noticia
	$ultima_data = $dados["ultima_data"];
	
};

// valida ultima data
if($ultima_data != null){
	
	// calcula a diferenca de ultima atualizacao
	$diferenca = diferenca_data_conexao($ultima_data);

	// transforma em minutos
	$diferenca = round($diferenca / 60);

	// valida diferenca
	if($diferenca < 0){
	
		// setando valor padrao
		$diferenca = 0;
		
	};
	
}else{
	
	// diferenca padrao
	$diferenca = 0;
	
};

// valida diferenca
if($diferenca <= NUMERO_MINUTOS_RSS_ATUALIZAR_INICIO_GLOBAL and $diferenca >= 0 and $conteudo != null){
	
	// array de retorno
	$array_retorno["dados"] = $conteudo;

	// retorno
	return json_encode($array_retorno);

};

// atualiza o array de url de feeds
$url_feeds = $url_feed;

// atualizando o estado do usuario agora
$url_feeds[] = retorne_estado_noticia_usuario();

// invertendo a ordem para o estado aparecer primeiro
$url_feeds = array_reverse($url_feeds);

// limpa noticias antigas
limpa_noticias_antigas();

// zera os contadores de avanco
contador_avanco($tipo_acao, 2);

// listando urls e coletando informações
foreach($url_feeds as $url){

	// valida url
	if($url != null){

		// conteudo de noticia
		$conteudo = leitor_noticia_rss($url, NUMERO_RSS_INICIO, true);

		// valida conteudo
		if($conteudo !=  null){

			// constroe a noticia baseado na url
			$html .= $conteudo;
			
		};

	};

};

// html
$html = "
<div class='classe_noticias_filtradas_recomendar'>
$html
</div>
";

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>