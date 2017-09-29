<?php

// compartilhar
function compartilhar(){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela = $tabela_banco[5];

// id
$id = retorne_campo_formulario_request(11);

// retorna se o id de um item de tabela existe
if(retorne_id_existe($id, $tabela) == false){

	// array de retorno
	$array_retorno["dados"] = mensagem_erro($idioma_sistema[316]);
	$array_retorno["linhas"] = 0;

	// retorno nulo
	return json_encode($array_retorno);
	
};

// id de usuario dono da publicacao
$uid = retorne_idusuario_dono_publicacao($id);

// valida modo pode interagir social
if(retorne_pode_interagir_social($id, true) == false){
	
	// retorno nulo
	return null;
	
};

// valida configuracao
if(retorna_configuracao_privacidade(10, $uid) == true){

	// nome de usuario
	$nome = retorne_nome_usuario_logado();
	
	// valida usuario dono do perfil
	if(retorne_usuario_dono_perfil($uid) == true){
		
		// html
	    $html = constroe_caixa(false, $nome.$idioma_sistema[420]);
		
	}else{
		
		// html
	    $html = constroe_caixa(false, $nome.$idioma_sistema[421]);
	
	};

	// array de retorno
	$array_retorno["dados"] = $html;

	// retorno
	return json_encode($array_retorno);
	
};

// valida usuario ja compartilhou postagem
if(retorne_usuario_logado_compartilhou($id) == true){
	
	// array de retorno
	$array_retorno["dados"] = "(".retorne_tamanho_resultado(retorne_numero_compartilhamentos($id)).")";

	// retorno
	return json_encode($array_retorno);
	
};

// atualiza o array de publicacao
$array_publicacao[ID_COMPARTILHADO] = $id;

// publica o conteudo de usuario
publicar_conteudo_usuario($array_publicacao, 4);

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(33, null, false);

// array de retorno
$array_retorno["dados"] = retorne_tamanho_resultado(retorne_numero_compartilhamentos($id));
$array_retorno["compartilhado"] = $imagem_sistema[0];

// retorno
return json_encode($array_retorno);

};

?>