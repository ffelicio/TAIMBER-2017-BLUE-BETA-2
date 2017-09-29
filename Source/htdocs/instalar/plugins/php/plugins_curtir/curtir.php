<?php

// curtir
function curtir(){

// globals
global $tabela_banco;
global $idioma_sistema;

// tipo de campo
$tipo_campo = retorne_campo_formulario_request(10);

// id
$id = retorne_campo_formulario_request(4);

// tabela
$tabela = retorne_tabela_comentario($tipo_campo);

// retorna se o id de um item de tabela existe
if(retorne_id_existe($id, $tabela) == false){

	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[316]);

	// retorno nulo
	return json_encode($array_retorno);
	
};

// valida o tipo de campo
switch($tipo_campo){
	
	case 1:
	
	// id de usuario dono da publicacao
	$uid = retorne_idusuario_dono_publicacao($id);

	// valida modo pode interagir social
	if(retorne_pode_interagir_social($id, false) == false){
		
		// retorno nulo
		return null;
		
	};
	
	break;
	
	case 2:
	
	// id de usuario dono de imagem
	$uid = retorne_uid_dono_imagem($id);
	
	// valida usuario amigo
	if(retorne_usuario_amigo($uid) == false and retorne_usuario_dono_perfil($uid) == false and retorne_idpagina_request() == null){
		
		// retorno nulo
		return null;
		
	};
	
	break;
	
};

// valida configuracao de privacidade
if(retorna_configuracao_privacidade(6, retorne_idamigo_request()) == true){
	
    // retorno nulo
    return null;
	
};

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// id de amigo
$uidamigo = retorne_idamigo_request();

// data atual
$data = data_atual();

// query
$query[0] = "select *from $tabela_banco[9] where id_post='$id' and uid='$idusuario' and tabela_curtiu='$tabela';";
$query[1] = "delete from $tabela_banco[9] where id_post='$id' and uid='$idusuario' and tabela_curtiu='$tabela';";
$query[2] = "insert into $tabela_banco[9] values('null', '$idusuario', '$uidamigo', '$id', '$tabela', '$data');";

// executa querys
$dados_query = plugin_executa_query($query[0]);

// valida numero de linhas
if($dados_query["linhas"] != 0){
	
	// deleta curtida
	plugin_executa_query($query[1]);
	
}else{
	
	// adiciona curtida
	plugin_executa_query($query[2]);
	
};

// adiciona uma notificacao
adicionar_notifica($id, $uidamigo, $tabela, $tabela_banco[9], null);

// retorno
return json_encode(constroe_campo_curtir($tabela, $id, false, $uidamigo));

};

?>