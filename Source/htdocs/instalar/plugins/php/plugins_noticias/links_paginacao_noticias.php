<?php

// links de paginacao de noticia
function links_paginacao_noticias(){

// globals
global $tabela_banco;
global $variavel_campo;

// tabela
$tabela = $tabela_banco[35];

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = retorne_query_pesquisa_noticias(null);

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// url de pagina inicial
$url_pagina_inicial = PAGINA_INICIAL;

// url de pagina inicial
$url_pagina_inicial = "?$variavel_campo[2]=108&$variavel_campo[52]";

// paginador
$paginador = retorne_campo_formulario_request(52);

// paginador
$html = paginar(NUMERO_VALOR_PAGINACAO, $paginador, $linhas, $url_pagina_inicial);

// html
$html = "
<div class='campo_paginacao_noticias_aba'>
$html
</div>
";

// retorno
return $html;

};

?>