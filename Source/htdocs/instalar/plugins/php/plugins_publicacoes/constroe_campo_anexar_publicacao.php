<?php

// constroe campo anexar em publicacao
function constroe_campo_anexar_publicacao(){

// globals
global $idioma_sistema;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// id de campo
$idcampo[0] = codifica_md5("id_menu_suspense_anexar_midia_".retorne_contador_iteracao());

// campos de upload
$campo_musica = constroe_campo_anexar_musica(true, $idcampo[0]);
$campo_video = constroe_campo_anexar_videos(true, $idcampo[0]);

// html
$html .= $campo_musica["html"];
$html .= $campo_video["html"];

// valida o modo mobile
if($modo_mobile == true){
	
	// html
	$html = constroe_menu_suspense(false, null, true, 122, $idcampo[0], $html);

}else{
	
	// html
	$html = constroe_menu_suspense(false, null, true, 122, $idcampo[0], $html);
	
};

// html
$html .= $campo_musica["dialogo"];
$html .= $campo_video["dialogo"];

// retorno
return $html;

};

?>