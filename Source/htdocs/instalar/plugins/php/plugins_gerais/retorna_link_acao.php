<?php

// retorna o link de acao
function retorna_link_acao($conteudo, $tipo_acao, $idusuario){

// globals
global $variavel_campo;
global $idioma_sistema;

// valida id de usuario
if($idusuario == null){
	
	// id de usuario logado
    $idusuario = retorne_idusuario_logado();
	
};

// usuario dono
$usuario_dono_perfil = retorne_usuario_dono_perfil($idusuario);

// url de perfil de usuario
$url_perfil_usuario = retorne_url_amigavel_usuario($idusuario, 0, null);

// links disponiveis
$links[0] = "<a href='$url_perfil_usuario&$variavel_campo[2]=9'>$conteudo</a>";
$links[1] = "<a href='$url_perfil_usuario&$variavel_campo[2]=22'>$conteudo</a>";
$links[2] = "<a href='$url_perfil_usuario'>$conteudo</a>";

// valida o tio de link de acao
switch($tipo_acao){

    case 9: // carrega as publicacoes
	
	// valida usuario dono do perfil
	if($usuario_dono_perfil == true){
		
		// carrega as publicacoes
		$link_acao = $links[0];
	
	}else{
		
		// carrega as publicacoes de usuario que nao e dono
		$link_acao = $links[2];
		
	};
	
	break;
	
	case 22: // carrega os feeds
	
	// valida usuario dono do perfil
	if($usuario_dono_perfil == true){
		
		// carrega os feeds
		$link_acao = $links[1];
		
	}else{
		
		// carrega as publicacoes
		$link_acao = $links[0];	
		
	};
	
	break;

};

// retorno
return $link_acao;

};

?>