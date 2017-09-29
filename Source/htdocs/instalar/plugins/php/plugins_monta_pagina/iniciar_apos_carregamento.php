<?php

// iniciar ao terminar o carregamento da pagina
function iniciar_apos_carregamento(){

// campos
$campo[0] = inicializar_campo_detecta_resolucao();

// html
$html = "
$campo[0]
";

// retorno
return $html;

};

?>