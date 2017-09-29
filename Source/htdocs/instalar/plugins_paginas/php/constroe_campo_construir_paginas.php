<?php

// constroe o campo construir paginas
function constroe_campo_construir_paginas(){

// globals
global $idioma_sistema;
global $variavel_campo;

// valida pode criar paginas
if(retorne_pode_criar_paginas() == false){

    // retorno nulo
    return null;	
	
};

// url de pagina inicial
$pagina_inicial = PAGINA_INICIAL;

// links
$link[0] = "<a href='$pagina_inicial?$variavel_campo[2]=110' title='$idioma_sistema[238]'>$idioma_sistema[238]</a>";

// campos
$campos[0] = "
<div class='classe_construir_pagina_perfil_campo_0 classe_cor_4'>
$link[0]
</div>
";

// html
$html = "
<div class='classe_construir_pagina_perfil'>
$campos[0]
</div>
";

// retorno
return $html;

};

?>