<?php

// campo conta ativada
function campo_conta_ativada($uid){

// globals
global $idioma_sistema;

// valida se o usuário ativou sua conta
if(retorne_usuario_ativou_conta($uid) == false){
	
	// retorno nulo
	return null;
	
};

// valida usuário dono do perfil
if(retorne_usuario_dono_perfil($uid) == true){
	
	// tooltip
	$tooltip = gera_tooltip("$idioma_sistema[618]$idioma_sistema[163]");
	
}else{
	
	// tooltip
	$tooltip = gera_tooltip("$idioma_sistema[617]$idioma_sistema[163]");
	
};

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(134, null, false);

// html
$html = "
<div class='classe_campo_conta_ativada' $tooltip>
	$imagem_sistema[0]
</div>
";

// retorno
return $html;

};

?>