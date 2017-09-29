<?php

// erradica as marcacoes de usuarios
function erradicar_marcacoes_usuarios($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[14];

// id de usuario
$idusuario = retorne_idusuario_logado();

// chave de publicacao atual
$chave = retorna_chave_request();

// data
$data = data_atual();

// array de usuarios
$array_usuarios = sessao_marcador_usuario_seta_retorna(null, null, $chave, null, 5);

// valida array possui conteudo
if(is_array($array_usuarios) == false){

    // retorno nulo
    return null;
	
};

// marcando amigos
foreach($array_usuarios as $uidamigo){
	
	// valida uidamigo
    if($uidamigo != null){

    // valida id de postagem
	if($id == null){
		
		// id de post
		$idpost = $_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][0]; 
	
	}else{
		
		// id de post
		$idpost = $id;
		
	};
	
	// tabela
	$tabela_referencia = $_SESSION[SESSAO_MARCADOR_USUARIO_REFERENCIA][$chave][$uidamigo][1];

	// query
	$query = "insert into $tabela values(null, '$chave', '$tabela_referencia', '$idusuario', '$uidamigo', '0', '$idpost', '$data');";

	// valida usuario amigo
	#caso o script original tenha cido alterado
	if(retorne_usuario_amigo($uidamigo) == true){
		
		// marca amigo
	    plugin_executa_query($query);
		
		// adiciona uma notificacao
		adicionar_notifica($idpost, $uidamigo, $tabela, $tabela_referencia, $idpost);

	};
	
	};
	
};

// limpa a sessao com usuarios marcados
sessao_marcador_usuario_seta_retorna(null, null, $chave, null, 6);

};

?>