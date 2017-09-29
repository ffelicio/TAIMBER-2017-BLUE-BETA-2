<?php

// constroe a pagina do usuario
function constroe_pagina_usuario(){

// globals
global $idioma_sistema;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// campo inscrever em pagina
$campo[0] = campo_inscrever_pagina(retorne_idpagina_request(), false);

// campo autor da pagina
$campo[1] = constroe_campo_autor_pagina();

// valida modo mobile
if($modo_mobile == false){
	
	// monta a pagina do usuario
	$html[1] .= constroe_campos_perfil_usuario_lateral_direito(true);
	
	// monta a pagina do usuario
	$html[2] = constroe_perfil_topo_pagina();
	
	// constroe a imagem de perfil de pagina
	$html[3] = constroe_imagem_perfil_pagina();

	// adiciona o chat
	$html[2] .= constroe_chat_usuario();

}else{
	
	// campo imagem de perfil
	$campo_imagem_perfil = constroe_imagem_perfil_pagina();
	
	// campo imagem de perfil
	$campo_imagem_perfil = "
	<div class='classe_campo_imagem_perfil_pagina_mobile classe_cor_2'>
	$campo_imagem_perfil
	</div>	
	";
	
	// monta a pagina do usuario
	$html[2] .= $campo_imagem_perfil;
	$html[2] .= constroe_perfil_topo_pagina();
	$html[2] .= $campo[0];
	
	// limpa o campo se inscrever
	$campo[0] = null;

};

// valida o modo
switch(retorne_campo_formulario_request(6)){
	
	case MODO_RECORTAR_IMAGEM_PAGINA:
	$html[2] = constroe_caixa(true, constroe_imagem_redimensionar(1));
	break;
	
	case MODO_CONFIG_PAGINA_1:
	$html[2] = constroe_caixa(true, constroe_configurar_pagina());
	break;
	
	case MODO_CARREGA_USUARIOS_PAGINA:
	$html[2] = constroe_caixa(true, campo_exibe_inscritos_pagina());
	break;
	
	default:
	// adiciona campo de publicacao de pagina
	$html[2] .= constroe_campo_publicar();

};

// constroe o conteudo da pagina
switch(retorne_campo_formulario_request(2)){
	
	case 7:
	$html[2] = constroe_caixa(true, constroe_carregar_imagens());
	break;

};

// adiciona campo inscrever em pagina
$html[3] .= $campo[0];

// adiciona campo autor da pagina
$html[3] .= $campo[1];

// rodape da pagina
$html[4] = constroe_conteudo_rodape();

// retorno
return $html;

};

?>