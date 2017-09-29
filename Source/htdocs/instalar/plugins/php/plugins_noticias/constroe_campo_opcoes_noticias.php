<?php

// constroe campo opcoes de noticias
function constroe_campo_opcoes_noticias(){

// globals
global $idioma_sistema;
global $variavel_campo;

// url de acoes
$url_inicio = PAGINA_INICIAL;

// nome de pesquisa
$nome_pesquisa = retorne_campo_formulario_request(7);

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(74, null, false);

// campos
$campo[0] = "
<div class='classe_campo_opcoes_noticias_entrada classe_cor_2'>

<form action='$url_inicio' method='GET'>
$imagem_sistema[0]
<input type='text' name='$variavel_campo[7]' placeholder='$idioma_sistema[520]' value='$nome_pesquisa'>
<input type='hidden' name='$variavel_campo[2]' value='108'>
</form>

</div>
";

// html
$html = "
<div class='classe_campo_opcoes_noticias'>
$campo[0]
</div>
";

// retorno
return $html;

};

?>