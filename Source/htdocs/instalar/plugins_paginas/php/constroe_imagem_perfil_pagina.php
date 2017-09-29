<?php

// constroe a imagem de perfil da pagina
function constroe_imagem_perfil_pagina(){

// globals
global $idioma_sistema;

// id da pagina
$id = retorne_idpagina_request();

// imagens de perfil
$imagem[0] = retorne_imagem_perfil_pagina($id, true);

// campo alterar imagem de perfil da pagina
if(retorne_usuario_dono_pagina(retorne_idusuario_request(), $id) == true){

    // campo editar imagem de perfil
    $campo_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "if_formulario_upload_img_perfil_pagina", "foto", 53, false, 1);

	// campo recortar imagem
	$imagem[0] = campo_redimensionar_imagem($imagem[0], 1);

	// campos
	$campo[0] = "

	<div class='campo_editar_imagem_perfil_upload'>
	$campo_upload
	</div>

	";	
	
};

// campo editar perfil
$campo_imagem_perfil = "
<div class='classe_perfil_basico_usuario_imagem'>
$imagem[0]
</div>
";

// html
$html = "

<div class='classe_div_imagem_perfil_grande'>
$campo_imagem_perfil
</div>

<div class='classe_opcoes_imagem_perfil_pagina'>
$campo[0]
</div>

";

// retorno
return $html;

};

?>