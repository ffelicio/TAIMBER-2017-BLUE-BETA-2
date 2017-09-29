<?php

// constroe opcoes de capa
function constroe_opcoes_capa($modo, $idcampo_1, $dados){

// modo false usuario
// modo true pagina

// globals
global $idioma_sistema;

// id de usuário via request
$uid = retorne_idusuario_request();

// valida o modo
if($modo == true){
	
	// id de pagina
	$pagina = retorne_idpagina_request();
	
	// valida se o usuário é o dono da página
	if(retorne_usuario_dono_pagina($uid, $pagina) == false){
		
		// retorno nulo
		return null;
		
	};
	
	// classes
	$classe[0] = "classe_div_opcoes_capa_pagina";
	
	// id da imagem da capa
	$id = $dados["id"];

}else{
	
	// valida se o usuário é o dono do perfil
	if(retorne_usuario_dono_perfil($uid) == false){
		
		// retorno nulo
		return null;
		
	};
	
	// classes
	$classe[0] = "classe_div_opcoes_capa";

	// id da imagem da capa
	$id = $dados[UID];
	
};

// funcoes
$funcao[0] = "excluir_capa($pagina)";

// eventos
$evento[0] = "onclick='$funcao[0]'";

// campos
$campo[0] = "
<span class='span_link' $evento[0]>
	$idioma_sistema[476]
</span>
";

// campos
$campo[0] = "
<div class='classe_div_opcao_menu_suspense'>
	$campo[0]
</div>
";

// html
$html = "
$campo[0]

";

// menu de suspense
$menu_suspense[0] = constroe_menu_suspense(false, null, false, 1, retorne_idcampo_md5(), $html);

// valida modo pagina
if($modo == true){

	// campo de upload
	$campo_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_campo_upload_imagem_capa_perfil", "foto", 55, false, 1);
	
}else{
	
	// campo de upload
	$campo_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_campo_upload_imagem_capa_perfil", "foto", 5, false, 1);

};

// campo adicionar capa
$campo_adicionar_capa = "

<div class='classe_div_capa_usuario_campo_upload'>
	$campo_upload
</div>
	
";

// valida id
if($id != null){
	
	// campo para reposicionar a capa do usuário
	$campo_reposicionar = campo_reposicionar_capa($idcampo_1);

};

// html
$html = "
<div class='classe_div_capa_usuario_upload'>

	$campo_adicionar_capa
	$campo_reposicionar
	
	<div class='$classe[0]'>
		$menu_suspense[0]
	</div>
	
</div>

";

// retorno
return $html;

};

?>