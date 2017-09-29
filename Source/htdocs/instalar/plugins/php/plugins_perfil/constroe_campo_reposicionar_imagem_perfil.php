<?php

// constroe campo reposicionar imagem de perfil
function constroe_campo_reposicionar_imagem_perfil(){

// globals
global $variavel_campo;
global $idioma_sistema;

// pagina inicial
$pagina_inicial = PAGINA_INICIAL;

// url de link
$url_link[0] = "$pagina_inicial?$variavel_campo[2]=105";

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(61, null, false);

// html
$html = "
<div class='classe_campo_reposicionar_imagem_perfil'>
<a href='$url_link[0]' title='$idioma_sistema[480]'>
$imagem_sistema[0]
</a>
</div>
";

// retorno
return $html;

};

?>