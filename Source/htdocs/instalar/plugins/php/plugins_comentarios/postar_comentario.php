<?php

// postar comentario
function postar_comentario(){

// globals
global $tabela_banco;
global $idioma_sistema;

// valida configuracao de privacidade
if(retorna_configuracao_privacidade(5, retorne_idamigo_request()) == true){
	
    // retorno nulo
    return null;
	
};

// tipo de campo
$tipo_campo = retorne_campo_formulario_request(10);

// data atual
$data = data_atual();

// id
$id = retorne_campo_formulario_request(4);

// comentario
$comentario = retorne_campo_formulario_request_htmlentites(9);

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
	
	case 3:

	// id de usuario dono de comentario
	$uid = retorne_uid_dono_comentario($id);
	
	// valida se pode responder comentario
	if(retorne_pode_responder_comentario($id) == false and retorne_idpagina_request() == null){
		
		// retorno nulo
		return null;
		
	};
	
	break;
	
};

// valida usuario logado
if(retorne_usuario_logado() == false or $comentario == null or $tabela == null){

    // retorno nulo
    return null;

};

// id de usuario
$idusuario = retorne_idusuario_logado();

// id de amigo
$uidamigo = retorne_idamigo_request();

// query
$query[0] = "select *from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela';";
$query[1] = "insert into $tabela_banco[7] values(null, '$idusuario', '$uidamigo', '$id', '$comentario', '$tabela', '$data');";
$query[2] = "select *from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela' order by id desc limit 1;";

// array com dados de comentarios
$array_dados = plugin_executa_query($query[0]);

// query
plugin_executa_query($query[1]);

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

// numero de comentarios
$numero_comentarios = retorne_tamanho_resultado(retorne_numero_comentarios($tipo_campo, $id));

// array de dados do ultimo comentario feito
$array_dados = plugin_executa_query($query[2]);

// dados
$dados = $array_dados["dados"][0];

// separa os dados
$idcomentario = $dados["id"];

// erradica as marcacoes de usuarios
erradicar_marcacoes_usuarios($idcomentario);

// array de retorno
$array_retorno["numero_comentarios"] = $idioma_sistema[75].$idioma_sistema[76].$numero_comentarios.$idioma_sistema[77];
$array_retorno["numero_comentarios_2"] = $numero_comentarios;
$array_retorno["dados"] = constroe_comentario($array_dados["dados"][0]);

// query
$query[3] = "select DISTINCT uid, id_post from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela';";

// array de dados
$array_dados = plugin_executa_query($query[3]);

// contador
$contador = 0;

// linhas
$linhas = $array_dados["linhas"];

// valida existe duplicadas
// somente de comentarios de comentarios
if($linhas > 0 and $tabela == $tabela_banco[7]){
	
	// remove notificacoes duplicadas de comentario
	remove_notifica_duplicados_comentario($id);

	// varrendo quem comentou
	for($contador == $contador; $contador <= $linhas; $contador++){
		
		// dados
		$dados = $array_dados["dados"][$contador];
		
		// separa os dados
		$uid = $dados[UID];
		$id_post = $dados[ID_POST];

		// valida id
		if($id_post != null){
			
			// adiciona uma notificacao
			// notifica cada usuario que comentou anteriormente
			adicionar_notifica($id, $uid, $tabela, $tabela_banco[7], $idcomentario);

		};

	};

};

// adiciona uma notificacao
adicionar_notifica($id, $uidamigo, $tabela, $tabela_banco[7], $idcomentario);

// retorno
return json_encode($array_retorno);

};

?>