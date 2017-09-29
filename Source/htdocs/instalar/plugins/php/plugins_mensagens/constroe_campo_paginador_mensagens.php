<?php

// constroe o campo paginador de mensagens
function constroe_campo_paginador_mensagens($idcampo_resultados){

// globals
global $idioma_sistema;

// id de campos
$idcampo[0] = retorna_idcampo_progresso_gif_geral();

// eventos
$eventos[0] = "onclick='paginar_mensagens(\"$idcampo[0]\", \"$idcampo_resultados\");'";

// campo de progresso
$campo_progresso = campo_progresso_gif($idcampo[0]);

// html
$html = "
$campo_progresso

<div class='classe_paginador_padrao classe_cor_29 span_link' $eventos[0]>
$idioma_sistema[61]
</div>
";

// retorno
return $html;

};

?>