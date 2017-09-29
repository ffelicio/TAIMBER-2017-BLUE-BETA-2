<?php

// constroe o campo de opcoes do perfil
function constroe_campo_opcoes_perfil($modo){

// id de usuario via requeste
$uid = retorne_idusuario_request();

// valida configuracao de privacidade
if(retorna_configuracao_privacidade(1, $uid) == true){
	
	// retorno nulo
	return null;
	
};

// classe
$classe[0] = "classe_separa_opcao_perfil_usuario classe_cor_13";

// valida modo
switch($modo){

	## >>> case 1 está disponível! <<<
	
	case 2: // outros formatos etc
	$html .= constroe_visualizador_amigos_perfil();
	break;
	
	case 3: // bloqueia usuario
	$html .= campo_bloquear_usuario(false, $uid);
	break;
	
	case 4: // campo envia mensagem para usuario
	$html .= campo_envia_mensagem($uid);
	$classe[0] = "classe_separa_opcao_perfil_usuario_2";
	break;
	
	case 5: // constroe as paginas do perfil basico
	$html .= constroe_paginas_perfil_basico();
	break;
	
	case 6: // constroe o visualizador de musicas de perfil
	$html .= constroe_visualizador_musicas_perfil();
	break;

};

// valida html
if($html == null){
	
	// retorno nulo
	return null;
	
};

// html
$html = "
<div class='$classe[0]'>
$html
</div>
";

// retorno
return $html;

};

?>