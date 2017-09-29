<?php

// constroe o topo da pagina
function constroe_topo_pagina(){

// modo mobile
$modo_mobile = retorne_modo_mobile();

// usuario logado
$usuario_logado = retorne_usuario_logado();

// sexo de usuario
$sexo_usuario = retorne_sexo_usuario_logado();

// campo de pesquisa
$campo[0] = constroe_barra_pesquisa_topo();

// valida usuario logado
if($usuario_logado == true){
	
	// valida sexo de usuario
	if($sexo_usuario == 1){
		
		// imagem de servidor
		$imagem_servidor[0] = retorne_imagem_sistema(48, null, false);
		
	}else{
		
		// imagem de servidor
		$imagem_servidor[0] = retorne_imagem_sistema(78, null, false);

	};

}else{
	
	// imagem de servidor
	$imagem_servidor[0] = retorne_imagem_sistema(126, null, false);
	
};

// valida modo mobile
if($modo_mobile == true){
	
	// imagem de servidor
	$imagem_servidor[0] = retorne_imagem_sistema(0, null, false);

};

// campo menu
$campo_menu[0] = constroe_opcoes_menu_topo_usuario();

// campo de notificacao
$campo[1] = constroe_campo_notifica();

// campos
$campo[3] = "

<div class='classe_div_logotipo_topo'>
	$imagem_servidor[0]
</div>

";

// valida modo mobile
if($modo_mobile == false){
	
	// campo logotipo
	$campo_logotipo = $campo[3];

}else{
	
	// valida usuario logado
	if($usuario_logado == true){
		
		// campo logotipo
		$campo_logotipo = campo_navegacao_perfil_mobile();
		
	}else{
		
		// campo logotipo
		$campo_logotipo = $campo[3];	
		
	};
	
};

// formulário de login
$campo[2] = formulario_login_topo();

// html
$html = "
<div class='classe_conteudo_div_topo_pagina'>
	$campo_logotipo
	$campo[1]
	$campo_menu[0]
	$campo[0]
	$campo[2]
</div>
";

// retorno
return $html;

};

?>