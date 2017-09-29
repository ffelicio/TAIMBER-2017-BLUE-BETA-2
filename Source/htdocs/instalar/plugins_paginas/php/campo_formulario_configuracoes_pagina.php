<?php

// formulario para alterar as configuracoes da pagina
function campo_formulario_configuracoes_pagina(){

// globals
global $idioma_sistema;

// valida usuario dono da pagina
if(retorne_usuario_dono_pagina(retorne_idusuario_logado(), retorne_idpagina_request()) == false){

    // retorno nulo
    return null;
	
};

// campos
$campo[0] = constroe_campo_configuracoes_pagina(retorne_idpagina_request());

// html
$html = "
<div class='classe_campo_configurar_pagina'>
$campo[0]
</div>
";

// retorno
return $html;

};

?>