<?php

// exibe informacoes de link
function exibe_info_link(){

// dados de formulario
$uid = retorne_idusuario_request();
$modo = retorne_campo_formulario_request(6);

// valida o modo
switch($modo){
	
	case 0:
	$conteudo .= constroe_imagem_perfil_miniatura(false, true, $uid);
	break;

};

// array de retorno
$array_retorno["dados"] = $conteudo;

// retorno
return json_encode($array_retorno);

};

?>