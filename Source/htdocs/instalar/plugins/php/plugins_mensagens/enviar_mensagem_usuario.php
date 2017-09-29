<?php

// envia mensagem
function enviar_mensagem_usuario($mensagem, $modo, $uid_envia, $chave_imagem){

// modo true envia mensagem para os dois usuarios
// modo false envia mensagem para um dos usuarios
// modo false e utilizado no chat

// globals
global $tabela_banco;

// id de usuario amigo
$uidamigo = retorne_idusuario_request();

// valida usuario amigo, e se ele e o dono do perfil
if(retorne_usuario_amigo($uidamigo) == false or retorne_usuario_dono_perfil($uidamigo) == true){
	
	// retorno nulo
    return null;
	
};

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// data atual
$data = data_atual();

// valida mensagem, e pega mensagem de formulario
if($mensagem == null){
	
    // dados de formulario
    $mensagem = trata_html_requeste($_REQUEST[MENSAGEM]);

}else{
	
	// trata o html para salvar em banco de dados
	$mensagem = trata_html_requeste($mensagem);
	
};

// valida mensagem
if($mensagem == null){

    // retorno nulo
    return null;
	
};

// valida o modo
if($modo == true){
	
    // query
    $query[0] = "insert into $tabela_banco[15] values(null, '$uidamigo', '$idusuario', '$mensagem', '$idusuario', '0', '0', '$chave_imagem', '$data');";
    $query[1] = "insert into $tabela_banco[15] values(null, '$idusuario', '$uidamigo', '$mensagem', '$idusuario', '1', '1', '$chave_imagem', '$data');";

    // envia mensagem
    plugin_executa_query($query[0]);
    plugin_executa_query($query[1]);

}else{
	
	// valida uid recebe e o dono do perfil
	if(retorne_usuario_dono_perfil($uid_envia) == true){
		
		// query
        $query[0] = "insert into $tabela_banco[15] values(null, '$idusuario', '$uidamigo', '$mensagem', '$idusuario', '1', '1', '$chave_imagem', '$data');";	

	}else{
		
	    // query
		$query[0] = "insert into $tabela_banco[15] values(null, '$uidamigo', '$idusuario', '$mensagem', '$idusuario', '0', '0', '$chave_imagem', '$data');";

	};

    // envia mensagem
    plugin_executa_query($query[0]);	
	
};

// query
$query[2] = "update $tabela_banco[15] set visualizado='1' where uid='$idusuario' and uidamigo='$uidamigo' and visualizado='0';";

// seta as mensagens como visualizadas
plugin_executa_query($query[2]);

};

?>