<?php

// carrega as hashtags
function carregar_hashtags(){

// global
global $tabela_banco;
global $idioma_sistema;
global $codigos_especiais;

// hashtag
$hashtag = retorne_hashtag_requeste();

// valida hastag
if($hashtag == null){
	
	// retorno nulo
	return null;
	
};

// tabela
$tabela = $tabela_banco[5];

// contador de avanco
$contador_avanco = contador_avanco(retorne_campo_formulario_request(2), 1) - NUMERO_VALOR_PAGINACAO;

// limit de query
$limit = $contador_avanco;
$limit = "limit $limit, ".NUMERO_VALOR_PAGINACAO;

// query
$query = "select *from $tabela where texto like '%$codigos_especiais[11]$hashtag%' order by id desc $limit;";

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// contador
$contador = 0;

// constroe publicacoes
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// dados
	$dados[0] = $dados;
	
	// valida id
	if($dados["id"] != null){
		
		// html
		$html .= constroe_publicacao($dados);
		
	};
	
};

// valida numero de hashtags
if($contador_avanco == 0){
	
	// id de campo
	$idcampo[0] = codifica_md5("id_numero_campo_hashtag_".$hashtag.data_atual().retorne_contador_iteracao());
	
	// numero de hashtags
	$numero_hashtags = retorne_tamanho_resultado(retorne_numero_hashtags($hashtag));
	
	// funcoes
	$funcao[0] = "
	atualiza_numero_hashtag(\"$idcampo[0]\", \"$hashtag\");
	";
	
	// campos
	$campo[0] = "
	<div class='classe_numero_hashtags classe_cor_5'>
	<div class='classe_numero_hashtags_separa classe_cor_5'>$codigos_especiais[11]$hashtag</div>
	<div class='classe_numero_hashtags_separa classe_cor_5' id='$idcampo[0]'>$numero_hashtags</div>
	</div>	
	";
	
	// adiciona timer
	$campo[0] .= plugin_timer_sistema(2, $funcao[0]);
	
	// adiciona caixa
	$campo[0] = constroe_caixa(false, $campo[0]);
	
	// html
	$html = "
	$campo[0]
	$html
	";
	
};

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>