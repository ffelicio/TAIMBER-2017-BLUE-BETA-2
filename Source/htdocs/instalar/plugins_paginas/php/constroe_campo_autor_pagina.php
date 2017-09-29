<?php

// constroe o campo autor da pagina
function constroe_campo_autor_pagina(){

// globals
global $idioma_sistema;

// id de usuario dono da pagina
$uid = retorne_idusuario_dono_pagina(retorne_idpagina_request());

// imagem de perfil de usuario
$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, true, $uid);

// valida sexo de usuário
if(retorne_sexo_idusuario($uid) == true){
	
	// texto
	$texto[0] = $idioma_sistema[589];
	
}else{
	
	// texto
	$texto[0] = $idioma_sistema[590];
	
};

// html
$html = "
<div class='classe_campo_autor_pagina classe_cor_29'>

<div class='classe_campo_autor_pagina_titulo'>
$texto[0]
</div>

<div class='classe_campo_autor_pagina_usuario'>
$imagem_perfil_usuario
</div>

</div>
";

// retorno
return $html;

};

?>