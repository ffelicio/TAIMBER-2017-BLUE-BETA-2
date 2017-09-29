<?php

// constroe o perfil do usuario lateral
function constroe_campos_perfil_usuario_lateral(){

// html
$html .= constroe_perfil_basico();
$html .= constroe_campo_opcoes_perfil(2);
$html .= constroe_campo_opcoes_perfil(5);

// retorno
return $html;

};

?>