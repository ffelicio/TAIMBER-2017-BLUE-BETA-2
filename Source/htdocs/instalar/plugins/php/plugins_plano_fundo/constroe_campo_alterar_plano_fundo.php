<?php

// constroe campo alterar plano de fundo
function constroe_campo_alterar_plano_fundo(){

// id de usuario via requeste
$uid = retorne_idusuario_request();

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil($uid) == false){
	
	// retorno nulo
	return null;
	
};

// id de campo
$idcampo[0] = retorne_idcampo_md5();

// campos
$campo[0] = constroe_formulario_barra_progresso(PAGINA_ACOES, $idcampo[0], "foto", 114, false, 1);
$campo[1] = constroe_gerenciar_plano_fundo();

// html
$html = "
<div class='classe_campo_plano_fundo'>
$campo[0]
$campo[1]
</div>
";

// retorno
return $html;

};

?>