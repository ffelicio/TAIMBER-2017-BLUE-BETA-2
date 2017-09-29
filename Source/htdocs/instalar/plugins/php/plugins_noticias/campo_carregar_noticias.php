<?php

// campo carregar notícias
function campo_carregar_noticias(){

// tipo de acao
$tipo_acao = retorne_campo_formulario_request(2);

// modo
$modo = retorne_campo_formulario_request(6);

// campos
$campo[0] = constroe_campo_opcoes_noticias();
$campo[1] = carregar_noticias_aba();
$campo[2] = links_paginacao_noticias();

// html
$html = "
<div class='classe_noticias_aba'>
$campo[0]
$campo[1]
$campo[2]
</div>
";

// retorno
return $html;

};

?>