<?php

// constroe campo redimensionar imagem
function constroe_imagem_redimensionar($modo){

// modo 0 usuario
// modo 1 pagina

// valida o modo
switch($modo){

	case 0:
	$dados = retorne_dados_imagem_usuario($modo, retorne_idusuario_logado());
	break;
	
	case 1:
	$dados = retorne_dados_imagem_usuario($modo, retorne_idpagina_request());
	break;
	
};

// html
$html = campo_recortar_imagem($dados, $modo);

// valida o modo
if($modo == 1){
	
	// retorno
	return $html;
	
};

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>