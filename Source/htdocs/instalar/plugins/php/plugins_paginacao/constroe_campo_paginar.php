<?php

// constroe o campo paginar
function constroe_campo_paginar($titulo){

// globals
global $idioma_sistema;

// valida titulo
if($titulo == null){
	
	// seta valor padrao de titulo
	$titulo = $idioma_sistema[61];
	
};

// id de campos
$idcampo[0] = retorna_idcampo_progresso_gif_geral();
$idcampo[1] = retorna_idcampo_conteudo_geral();
 
// barra de progresso gif
$progresso[0] = campo_progresso_gif($idcampo[0]);

// tipo de acao
$tipo_acao = retorne_tipo_acao_pagina();

// eventos
$eventos[0] = "exibe_elemento_oculto(\"$idcampo[0]\", 0)";
$eventos[1] = "executador_acao(null, $tipo_acao, \"$idcampo[1]\")";

// eventos
$eventos[0] = "onclick='$eventos[0], $eventos[1];'";

// html
$html = "
<div class='classe_paginador_geral'>

$progresso[0]

<div class='classe_paginador_padrao classe_cor_29 span_link' $eventos[0]>
$titulo
</div>

</div>
";

// retorno
return $html;

};

?>