<?php

// adiciona amizade
function adicionar_amizade(){

// globals
global $tabela_banco;
global $idioma_sistema;

// id de usuario
$uidamigo = retorne_idusuario_request();

// valida uidamigo é o proprio usuário logado
if(retorne_usuario_dono_perfil($uidamigo) == true){
	
	// array de retorno
	$array_retorno["dados"] = null;

	// retorno
	return json_encode($array_retorno);	
	
};

// id de usuario
$idusuario = retorne_idusuario_logado();

// data atual
$data = data_atual();

// modo de adicionar
$modo = retorne_campo_formulario_request(6);

// solicita email ao adicionar
if(retorna_configuracao_privacidade(0, $uidamigo) == true and $modo == 1){
	
	// e-mail
    $email = retorne_campo_formulario_request(0);

	// dados compilados do usuario
    $dados_compilados_usuario = retorne_dados_compilados_usuario($uidamigo);

    // dados separados
    $dados_login = $dados_compilados_usuario[$tabela_banco[0]];

	// valida email de cadastro com email informado em formulario
	if($email != $dados_login[E_MAIL]){
		
		// nome de amigo
		$nome_usuario = retorne_nome_usuario(true, $uidamigo);
		
		// nome de usuario logado
		$nome_usuario_logado = retorne_nome_usuario(true, $idusuario);
		
		// array de retorno
        $array_retorno["dados"] = -1;
        $array_retorno["mensagem_retorno"] = mensagem_erro($nome_usuario_logado.$idioma_sistema[162].$nome_usuario.$idioma_sistema[163]);
		
        // retorno
        return json_encode($array_retorno);
		
	};
	
};

// querys
$query[0] = "select *from $tabela_banco[6] where (uid='$idusuario' and uidamigo='$uidamigo') or (uid='$uidamigo' and uidamigo='$idusuario');";
$query[1] = "delete from $tabela_banco[6] where (uid='$idusuario' and uidamigo='$uidamigo') or (uid='$uidamigo' and uidamigo='$idusuario');";
$query[2] = "insert into $tabela_banco[6] values(null, '$idusuario', '$uidamigo', '$idusuario', '0', null, null, null, null, null, null, null, '$data');";
$query[3] = "insert into $tabela_banco[6] values(null, '$uidamigo', '$idusuario', '$idusuario', '0', null, null, null, null, null, null, null, '$data');";
$query[4] = "update $tabela_banco[6] set aceito='1', data='$data' where (uid='$uidamigo' and uidamigo='$idusuario') or (uid='$idusuario' and uidamigo='$uidamigo');";

// verifica amizade atual
$dados_amizade = plugin_executa_query($query[0]);

// usuario tenta enviar uma solicitacao, quando ela ja foi recebida
if($modo == 1 and $dados_amizade["linhas"] != 0){

    // anula o modo
    $modo = null;
	
};

// valida o modo
switch($modo){

    case 1: // envia solicitacao
    plugin_executa_query($query[2]);
	plugin_executa_query($query[3]);
    break;
	
	case 2: // cancela solicitacao enviada
    plugin_executa_query($query[1]);
	// exclui dados de amizade
	excluir_dados_amizade($uidamigo, true);
	break;
	
	case 3: // aceita solicitacao recebida
	plugin_executa_query($query[4]);
	// atualiza os novos feeds do usuario, util quando adicionar uma nova amizade
	atualiza_novos_feeds_usuario($uidamigo);
	break;
	
	case 4: // desfazer amizade aceita recebida
	plugin_executa_query($query[1]);
	// exclui dados de amizade
	excluir_dados_amizade($uidamigo, true);
	break;
	
	case 5: // desfazer amizade aceita enviada
	plugin_executa_query($query[1]);
	// exclui dados de amizade
	excluir_dados_amizade($uidamigo, true);
	break;

};

// verifica amizade atual
$dados_amizade = plugin_executa_query($query[0]);
	
// valida o modo envia solicitacao
if($modo == 1){

	// adiciona notificacao
	adicionar_notifica($dados_amizade["dados"][0]["id"], $uidamigo, $tabela_banco[6], $tabela_banco[6], null);

};

// valida o modo aceita solicitacao recebida
if($modo == 3){

	// adiciona notificacao
	adicionar_notifica($dados_amizade["dados"][0]["id"], $uidamigo, -1, $tabela_banco[6], null);
	
};

// remove as recomendacoes de usuario
remover_recomendacoes_usuario();

// erradica as recomendacoes
erradicar_recomendacoes();

// atualiza os dados do amigo
atualize_dados_amigo($idusuario, $uidamigo, true);

// atualiza ou retorna os dados da sessao do usuario
atualiza_retorna_dados_usuario_sessao(true, true);

// array de retorno
$array_retorno["dados"] = null;

// retorno
return json_encode($array_retorno);

};

?>