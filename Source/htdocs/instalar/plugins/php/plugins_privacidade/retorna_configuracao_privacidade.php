<?php

// retorna a configuracao de privacidade
function retorna_configuracao_privacidade($modo, $uid){

// globals
global $idioma_sistema;
global $tabela_banco;
global $variavel_campo;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorna falso
	return false;
	
};

// valida uid
if($uid != null){
	
	// usuario dono do perfil
	$usuario_dono = retorne_usuario_dono_perfil($uid);
	
}else{
	
	// usuario dono do perfil
	$usuario_dono = retorne_usuario_dono_perfil(retorne_idusuario_logado());
	
};

// valida id de usuario
if($uid == null){
	
    // dados compilados do usuario
    $dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

}else{
	
	// dados compilados do usuario
	$dados_compilados_usuario = retorne_dados_compilados_usuario($uid);
	
};

// separa os dados do perfil
$dados_privacidade = $dados_compilados_usuario[$tabela_banco[12]];

// valida modo de retorno
switch($modo){
	
	case 0: // solicita email
	$resposta = $dados_privacidade[SOLICITA_EMAIL_ADICIONAR];
	break;
	
	case 1: // perfil privado
	if(retorne_usuario_amigo($uid) == false and $dados_privacidade[PERFIL_PRIVADO] == true){
		
		// valida se o usuario é o dono do perfil
		if($usuario_dono == true){
			
			// resposta de perfil não privado
			$resposta = false;
			
		}else{
			
			// resposta de perfil privado
			$resposta = true;
		
		};
		
	}else{
		
		// resposta de banco de dados
		$resposta = false;
		
	};
	break;
	
	case 2: // bloqueia pornografia
	$resposta = $dados_privacidade[BLOQUEIA_PORNOGRAFIA];
	break;
	
	case 3: // bloqueia palavras chave
	return $dados_privacidade[BLOQUEIA_PALAVRAS_CHAVE];
	break;
	
	case 4: // deslogar automatico
	$resposta = $dados_privacidade[DESLOGAR_AUTOMATICO];
	break;
	
	case 5: // desabilitar comentarios
	$resposta = $dados_privacidade[DESABILITAR_COMENTARIOS];
	break;
	
	case 6: // desabilitar curtidas
	$resposta = $dados_privacidade[DESABILITAR_CURTIDAS];
	break;
	
	case 7: // DISPONIVEL
	$resposta = null;
	break;
	
	case 8: // desabilitar depoimentos
	$resposta = $dados_privacidade[DESABILITAR_DEPOIMENTOS];
	break;
	
	case 9: // desabilitar o chat
	$resposta = $dados_privacidade[DESABILITAR_CHAT];
	break;
	
	case 10: // desabilitar compartilhamentos
	$resposta = $dados_privacidade[DESABILITAR_COMPARTILHAMENTOS];
	break;
	
	case 11: // desabilitar as noticias
	
	// resposta
	$resposta = $dados_privacidade[DESABILITAR_NOTICIAS];
	
	// valida resposta
	if($resposta == null){
		
		// desabilita as notícias automáticas
		$resposta = true;
		
	};

	break;
	
	case 12: // desabilitar as novidades
	$resposta = $dados_privacidade[DESABILITAR_NOVIDADES];
	break;
	
	case 13: // desabilitar a barra de atalhos
	$resposta = $dados_privacidade["ocultar_barra_atalhos"];
	break;
	
};

// retorno
if($resposta == null or $resposta == false){
	
	// retorno falso
	return false;
	
}else{
	
	// retorno verdadeiro
	return true;
	
};

};

?>