<?php

// constroe os campos do perfil de usuario lateral direito
function constroe_campos_perfil_usuario_lateral_direito($modo){

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorna o formulario de login
	return plugin_formulario_login();
	
};

// campos
$campo[0] = constroe_campo_desenvolvedor();
$campo[1] = constroe_links_navegacao_lateral();

// valida modo
if($modo == true){
	
	// html
	$html = "
	<div class='classe_campos_perfil_usuario_lateral_direito_espacado'>
	$campo[1]
	$campo[0]
	</div>
	";	
	
}else{
	
	// html
	$html = "
	$campo[1]
	$campo[0]
	";

};

// retorno
return $html;

};

?>