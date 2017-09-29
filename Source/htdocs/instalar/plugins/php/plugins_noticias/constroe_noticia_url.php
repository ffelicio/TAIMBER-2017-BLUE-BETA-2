<?php

// constroe a noticia baseado na url
function constroe_noticia_url($dados_site, $url){

// valida dados de site
if($dados_site == null){
	
	// retorno nulo
	return null;
	
};

// separando dados
$titulo = $dados_site['titulo'];
$descricao = $dados_site['descricao'];

// html
$html = "
<div class='classe_noticia_sugerida'>

<div class='classe_noticia_sugerida_titulo'>
<a href='$url' target='_blank'>$titulo</a>
</div>

<div class='classe_noticia_sugerida_conteudo'>
<a href='$url' target='_blank'>$descricao</a>
</div>

</div>
";

// retorno
return $html;

};

?>