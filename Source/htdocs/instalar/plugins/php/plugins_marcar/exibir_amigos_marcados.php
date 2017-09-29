<?php

// exibe os amigos marcados
function exibir_amigos_marcados(){

// chave de marcador
$chave = retorna_chave_request();

// array com amigos marcados
$array_amigos_marcados = sessao_marcador_usuario_seta_retorna(null, null, retorna_chave_request(), null, 5);

// valida array de amigos
if(is_array($array_amigos_marcados) == false){
	
	// array de retorno
    $array_retorno["dados"] = null;

    // retorno
    return json_encode($array_retorno);
	
};

// listando amigos marcados
foreach($array_amigos_marcados as $uidamigo){
	
	// valida uidamigo
	if($uidamigo != null){
		
		// atualiza retorno
		$array_retorno["dados"] .= constroe_uidamigo_marcado($uidamigo, $chave);

	};
	
};

// retorno
return json_encode($array_retorno);

};

?>