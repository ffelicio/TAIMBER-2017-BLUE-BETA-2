<?php

// constroe o campo visualizado
function constroe_visualizado($id, $tabela_campo){

// globals
global $tabela_banco;

// valida id e tabela de banco de dados
if($id == null or $tabela_banco == null){
	
	// retorno nulo
	return null;
	
};

// tabela
$tabela = $tabela_banco[40];

// query
$query = "select id from $tabela where id_post='$id' and tabela_campo='$tabela_campo';";

// numero de visualizações
$visualizacoes = retorne_tamanho_resultado(retorne_numero_linhas_query($query));

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(131, null, false);

// html
$html = "
<div class='campo_visualizado classe_cor_4'>
	
	<span class='classe_campo_visualizado_separa_span_1'>
		$imagem_sistema[0]
	</span>
	
	<span class='classe_campo_visualizado_separa_span_2 span_link'>
		$visualizacoes
	</span>
	
</div>
";

// retorno
return $html;

};

?>