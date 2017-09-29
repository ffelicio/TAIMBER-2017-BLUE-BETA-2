<?php

// constroe o visualizador de musicas de perfil
function constroe_visualizador_musicas_perfil(){

// globals
global $idioma_sistema;
global $variavel_campo;

// url de pagina inicial
$url_pagina_inicial = PAGINA_INICIAL;

// id de usuario via requeste
$uid = retorne_idusuario_request();

// numero de musicas
$numero_musicas = retorne_tamanho_resultado(retorne_numero_musicas_usuario($uid));

// campos
$campo[0] = constroe_musicas_usuario($uid, true, true);

// link
$link[0] = "<a href='$url_pagina_inicial?$variavel_campo[5]=$uid&$variavel_campo[2]=78' title='$idioma_sistema[356]$numero_musicas'>$idioma_sistema[356]$numero_musicas</a>";

// html
$html = "
<div class='classe_visualizador_musicas_perfil_basico'>

<div class='classe_visualizador_musicas_perfil_basico_topo'>

<div class='classe_visualizador_musicas_perfil_basico_titulo' $evento[2]>
$link[0]
</div>

</div>


<div class='classe_visualizador_musicas_perfil_basico_conteudo'>
$campo[0]
</div>

</div>

";

// retorno
return $html;

};

?>