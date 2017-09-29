<?php

// marcacoes concluidas
function marcacoes_concluidas(){

// dados de formulario
$chave = retorna_chave_request();

// valida o modo
switch(retorne_campo_formulario_request(6)){
	
	case 2:
	sessao_marcador_usuario_seta_retorna(null, null, $chave, null, 6);
	break;
	
};

// array de retorno
$array_retorno["dados"] = retorne_tamanho_resultado(retorne_numero_usuarios_marcados($chave));

// retorno
return json_encode($array_retorno);

};

?>