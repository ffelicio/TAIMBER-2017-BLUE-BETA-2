<?php

// constroe o campo de previsualizacao de musicas de publicacao
function constroe_campo_previsualizar_musicas_publicacao(){

// id de campo
$idcampo[0] = retorne_idcampo_previsualiza_musicas_publicacao();

// html
$html = "
<div class='classe_campo_previsualizar_musicas_publicacao' id='$idcampo[0]'></div>
";

// retorno
return $html;

};

?>