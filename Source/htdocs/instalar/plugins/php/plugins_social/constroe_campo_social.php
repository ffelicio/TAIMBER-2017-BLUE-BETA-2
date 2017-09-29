<?php

// constroe o campo social
function constroe_campo_social($tipo_campo, $id, $modo, $idusuario){

// globals
global $tabela_banco;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno nulo
	return null;
	
};

// valida o tipo de campo
switch($tipo_campo){
	
	case 1:
	$uid_dono = retorne_idusuario_dono_publicacao($id);
	$usuario_amigo = retorne_usuario_amigo($uid_dono);
	$pagina = retorne_idpagina_postagem($id);
	$campo_visualizado = constroe_visualizado($id, $tabela_banco[5]);
	break;
	
	case 2:
	$uid_dono = retorne_uid_dono_imagem($id);
	$usuario_amigo = retorne_usuario_amigo($uid_dono);
	$pagina = retorne_idpagina_request();
	break;

};

// valida se o usuario é amigo ou se é uma publicacao de página
if($usuario_amigo == false and $pagina == null and retorne_usuario_dono_perfil($uid_dono) == false){
	
	// retorno nulo
	return null;
	
};

// campo de curtida
$campo_curtida = constroe_campo_curtir($tipo_campo, $id, $modo, $idusuario);

// campo de comentario
$campo_comentario = constroe_campo_comentario(null, $tipo_campo, $id, $modo, $idusuario);

// valida o tipo de campo
if($tipo_campo == 1){
	
	// campo compartilhar
	$campo_compartilhar = constroe_campo_compartilhamentos($id, $tipo_campo, $idusuario);

};

// html
$html = "
<div class='classe_div_campo_social'>

	$campo_compartilhar
	$campo_curtida
	$campo_visualizado
	$campo_comentario
	
</div>
";

// retorno
return $html;

};

?>