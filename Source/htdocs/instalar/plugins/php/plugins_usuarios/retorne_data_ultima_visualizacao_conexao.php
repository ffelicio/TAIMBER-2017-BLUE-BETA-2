<?php

// retorna a data da ultima visualizacao de perfil do usuario
function retorne_data_ultima_visualizacao_conexao($uid, $modo_json){

// valida uid
if($uid == null){
	
    // id de usuario
    $uid = retorne_idusuario_logado();

};

// valida usuario online
if(retorne_usuario_online($uid) == true){
	
	// imagem de sistema
	$imagem[0] = retorne_imagem_sistema(107, null, false);

	// html
	$html = "
	<span>$imagem[0]</span>
	";

}else{
	
	// html
	$html = retorne_data_texto_ultima_visualizacao_conexao($uid, $modo_json);
	
};

// valida o modo json
if($modo_json == true){

	// array de retorno
	$array_retorno["dados"] = $html;
	
	// retorno
	return json_encode($array_retorno);
	
}else{
	
	// retorno
	return $html;
	
};

};

?>