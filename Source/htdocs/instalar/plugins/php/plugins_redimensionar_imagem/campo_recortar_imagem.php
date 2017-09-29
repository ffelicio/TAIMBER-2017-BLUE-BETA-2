<?php

// campo recortar imagem
function campo_recortar_imagem($dados, $modo){

// globals
global $idioma_sistema;
global $variavel_campo;

// separa dados
$url_host_grande = $dados[URL_HOST_GRANDE];

// valida host de imagem
if($url_host_grande == null){
	
	// retorno nulo
	return null;
	
};

// url de pagina de acoes
$url_pagina = PAGINA_ACOES;

// numero de pagina
$pagina_acao = 70;

// recursos
$recurso[0] = jcrop();

// id de pagina
$id_pagina = retorne_idpagina_request();

// valida usuario logado dono da pagina
if($id_pagina != null and retorne_usuario_logado_dono_pagina($id_pagina) == false){
	
	// retorno nulo
	return null;
	
};

// codigo html
$html = "
$recurso[0]

<div class='classe_painel_recortar_imagem'>


<div class='classe_painel_recortar_imagem_imagem'>
<img src='$url_host_grande' id='cropbox'>
</div>


<div class='classe_painel_recortar_imagem_formulario'>
<form action='$url_pagina' method='post' enctype='multipart/form-data' onsubmit='return checkCoords();'>
<input type='hidden' id='x' name='x'>
<input type='hidden' id='y' name='y'>
<input type='hidden' id='w' name='w'>
<input type='hidden' id='h' name='h'>
<input type='hidden' name='$variavel_campo[2]' value='$pagina_acao'>
<input type='hidden' name='$variavel_campo[25]' value='$id_pagina'>
<input type='hidden' name='$variavel_campo[6]' value='$modo'>
<input type='submit' value='$idioma_sistema[297]'>
</form>
</div>


</div>
";

// retorno
return $html;

};

?>