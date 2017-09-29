<?php

// constroe o campo de previsualizacao de videos de publicacao
function constroe_campo_previsualizar_videos_publicacao(){

// id de campo
$idcampo[0] = retorne_idcampo_previsualiza_videos_publicacao();

// html
$html = "
<div class='classe_campo_previsualizar_videos_publicacao' id='$idcampo[0]'></div>
";

// retorno
return $html;

};

?>