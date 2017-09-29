<?php

// constroe a imagem de perfil em miniatura
function constroe_imagem_perfil_miniatura($usar_evento, $modo, $uid){

// globals
global $variavel_campo;

// dados da imagem
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);

// separa os dados
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];

// nome de usuario
$nome_usuario = retorne_nome_usuario(true, $uid);

// url de perfil de usuario
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);

// nome com o link de id de usuario
$nome_link_usuario = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";

// tipo de acao
$tipo_acao = retorne_campo_formulario_request(2);

// valida url de host de imagem em miniatura
if($url_host_miniatura == null){
	
	// dados do perfil
	$dados_perfil = retorne_dados_perfil_usuario($uid);

	// valida o sexo do usuario
	if(retorne_sexo_usuario($dados_perfil) == true){
	
		// separa os dados
		$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	
	}else{
	
		// separa os dados
		$url_host_miniatura = retorne_imagem_sistema(8, false, true);

	};
	
	// define o sexo do usuario
	if($dados_perfil[SEXO] == null){
		
		// separa os dados
		$url_host_miniatura = retorne_imagem_sistema(40, false, true);
		
	};
	
};

// valida o modo
switch($modo){
	
    case true: // modo normal

	// html
    $html = "
	
	<div class='classe_div_imagem_perfil_miniatura_div_img'>
    
	<a href='$url_perfil_usuario' title='$nome_usuario'>
    <img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
    </a>
	
    </div>

    <div class='classe_div_imagem_perfil_miniatura_div_nome'>
    $nome_link_usuario
    </div>
	
	";
	
	// classe
	$classe[0] = "classe_div_imagem_perfil_miniatura";
	
    break;
	
	case false: // modo do chat
	
	// valida usar evento
	if($usar_evento == true){
		
		// valia o tipo de acao
		switch($tipo_acao){
			
			case 111:
			
			// id de campos
			$idcampo_mensageiro[0] = retorne_idcampo_geral_troca_mensagens_mensageiro();
			
			// eventos
			$evento[0] = "onclick='constroe_campos_troca_mensagens_mensageiro(\"$uid\", \"$idcampo_mensageiro[0]\");'";
			
			break;
			
			default:
			
			// eventos
			$evento[0] = "onclick='constroe_janela_chat(\"$uid\", 0, null);'";
		
		};
		
	};
	
	// valia o tipo de acao
	switch($tipo_acao){
	
		case 111:
		// classes
		$classe[1] = "classe_div_imagem_perfil_miniatura_div_nome_mensageiro";
		break;
	
		case 112:
		// classes
		$classe[1] = "classe_div_imagem_perfil_miniatura_div_nome_mensageiro_topo";
		break;
		
		default:
		// classes
		$classe[1] = "classe_div_imagem_perfil_miniatura_div_nome_chat";
	
	};
	
	// id de campos
	$idcampo[0] = PREFIXO_CHAT_USUARIO_ONLINE_0.$uid;
	$idcampo[1] = PREFIXO_CHAT_USUARIO_ONLINE_1.$uid;
	$idcampo[2] = PREFIXO_CHAT_NOVAS_MENSAGENS.$uid;
	
	// campo online
	$campo_online = "
	<div class='classe_imagem_online_offline_chat' id='$idcampo[0]'></div>
	";
	
	// campo numero de mensagens
	$campo_numero_mensagens = "
	<span class='classe_numero_novas_mensagens_chat' id='$idcampo[2]'></span>
	";
	
	// html
	$html = "
	
	<div class='classe_div_imagem_perfil_miniatura_div_img_chat'>
    <img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
    </div>	
	
	<div class='$classe[1] classe_span_1' id='$idcampo[1]'>
    $nome_usuario   
	</div>
	
	$campo_online
	$campo_numero_mensagens

	";
	
	// classe
	$classe[0] = "classe_div_imagem_perfil_miniatura_chat";
	
	break;
	
};

// html
$html = "
<div class='$classe[0]' $evento[0]>
$html
</div>
";

// retorno
return $html;

};

?>