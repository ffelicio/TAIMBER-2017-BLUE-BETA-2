<?php

// constroe balao de notificacao
function constroe_balao_notifica($idcampo, $valor){

// html
$html = "
<div class='balao_notifica' id='$idcampo'>$valor</div>
";

// retorno
return $html;

};

?>