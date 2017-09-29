<?php

// constroe campo editar perfil
function constroe_campo_editar_perfil(){

global $idioma_sistema;
global $variavel_campo;

// pagina inicial
$pagina_inicial = PAGINA_INICIAL."?$variavel_campo[2]";

// links
$url_link[0] = "$pagina_inicial=2";
	
// imagem
$imagem[0] = retorne_imagem_sistema(79, null, false);

// html
$html = "
<div class='classe_campo_editar_perfil'>
<a href='$url_link[0]'>$imagem[0]</a>
</div>
";

// retorno
return $html;

};

?>