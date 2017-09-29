<?php

// constroe as opcoes de imagem de perfil
function constroe_opcoes_imagem_perfil(){

// id de usuario via requete
$uid = retorne_idusuario_request();

// modo mobile
$modo_mobile = retorne_modo_mobile();

// usuario dono do perfil
$usuario_dono = retorne_usuario_dono_perfil($uid);

// valida usuario dono do perfil
if($usuario_dono == true){
	
	// campos
	$campo[0] = constroe_formulario_barra_progresso(PAGINA_ACOES, "if_formulario_upload_img_perfil", "foto", 4, false, 1);

}else{
	
	// retorno nulo
	return null;
	
};

// campo editar imagem de perfil
$campo[0] = "
<div class='campo_editar_imagem_perfil_upload'>
$campo[0]
</div>
";

// constroe campo reposicionar imagem de perfil
$campo[1] = constroe_campo_reposicionar_imagem_perfil();

// constroe campo excluir imagem de perfil
$campo[2] = constroe_campo_excluir_imagem_perfil();

// constroe campo editar perfil
$campo[4] = constroe_campo_editar_perfil();

// valida o modo mobile
if($modo_mobile == false){
	
	// html
	$html = "
	$campo[1]
	$campo[2]
	$campo[4]
	";

}else{
	
	// html
	$html = "
	$campo[1]
	$campo[2]
	";

};

// adiciona o menu de suspense
$html = constroe_menu_suspense(false, null, false, null, retorne_idcampo_md5(), $html);

// html
$html = "
$campo[3]

<div class='classe_opcoes_imagem_perfil'>

<div class='classe_opcoes_imagem_perfil_separa'>
$html
</div>

$campo[0]
</div>

";

// retorno
return $html;

};

?>