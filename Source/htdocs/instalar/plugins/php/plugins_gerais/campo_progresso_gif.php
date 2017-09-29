<?php

// campo progresso gif
function campo_progresso_gif($idcampo){

// globals
global $idioma_sistema;

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(16, null, false);

// valida idcampo nulo
if($idcampo == null){
	
	// retorna apenas a imagem
	return $imagem_sistema[0];
	
};

// html
$html = "
<div class='classe_campo_progresso_gif' id='$idcampo'>
$imagem_sistema[0]
</div>
";

// retorno
return $html;

};

?>