<?php

// plugin conteudo de pagina
function plugin_conteudo_pagina(){

// globals
global $tabela_banco;
global $idioma_sistema;

// tipo de acao
$tipo_acao = retorne_campo_formulario_request(2);

// id de usuario via requeste
$uid = retorne_idusuario_request();

// usuario dono do perfil
$usuario_dono = retorne_usuario_dono_perfil($uid);

// id de post
$idpost = retorne_idpublicacao_requeste();

// valida se o conteudo da pagina pode ser exibido
if(retorne_conteudo_pagina_pode_exibir() == false){
	
	// conteudo de retorno
	$conteudo_retorno[2] = mensagem_conteudo_indisponivel();
	$conteudo_retorno[1] = constroe_campos_perfil_usuario_lateral_direito(true);
	
	// retorno
	return $conteudo_retorno;
	
};

// modo permalink
$modo_permalink = retorne_modo_permalink();

// modo mobile
$modo_mobile = retorne_modo_mobile();

// usuario logado
$usuario_logado = retorne_usuario_logado();

// valida o modo mobile
if($modo_mobile == true){
	
	// formulario de cadastro
	$formulario[0] = formulario_cadastro(true);

};

// valida usuario logado
if($usuario_logado == true){
	
	// limpa os dados da consulta antiga
	retorne_pode_retornar_dados_usuario_nova_consulta(1, $uid, null);
	
	// atualiza os dados de sessao
	atualiza_retorna_dados_usuario_sessao(true, false);

	// atualiza a chave de publicacao
	retorna_seta_chave_publicacao(true);

	// zera dados de sessao
	zera_dados_sessao();
	
	// visita perfil usuario
	visitar_perfil();
	
	// erradica os aniversarios dos amigos do usuario logado
	erradicar_aniversarios_amigos();

};

// valida se constroe a pagina
if(retorna_constroe_pagina() == true){
	
	// constroe uma pagina de usuario
	return constroe_pagina_usuario();
	
};

// valida usuario logado
if($usuario_logado == false){
	
	// constroe o perfil basico basico deslogado
	$campo[0] = constroe_perfil_basico_deslogado();
	
	// valida modo mobile
	if($modo_mobile == false){

		// constroe conteudo
		$conteudo_retorno[3] .= $campo[0];

		// valida o tipo de acao
		if($tipo_acao == null){

			// constroe conteudo
			$conteudo_retorno[3] .= formulario_cadastro(false);
			$conteudo_retorno[3] .= constroe_alterar_idioma();
			$conteudo_retorno[2] .= constroe_apresentacao();
			
		}else{
			
			// constroe conteudo
			$conteudo_retorno[2] = constroe_conteudo_deslogado();			
			$conteudo_retorno[3] = formulario_cadastro(false);
			$conteudo_retorno[3] .= constroe_alterar_idioma();
	
		};		

	}else{

		// valida o tipo de acao
		if($tipo_acao == null){
			
			// constroe conteudo
			$conteudo_retorno[2] .= $campo[0];
			$conteudo_retorno[2] .= constroe_conteudo_deslogado();
			$conteudo_retorno[2] .= $formulario[0];	
			$conteudo_retorno[2] .= constroe_apresentacao();
			
		}else{
			
			// constroe conteudo
			$conteudo_retorno[2] = constroe_conteudo_deslogado();
			
		};
		
	};

	// valida abrir publicacao
	if($idpost != null){

		// abrindo publicacao
		$conteudo_retorno[2] = retorne_publicacao_id($idpost);

		// conteudo especial
		$conteudo_especial = true;

	};

}else{
	
	// chat de usuario
	$chat_usuario = constroe_chat_usuario();
	
	// valida modo mobile
	if($modo_mobile == false){
		
		// constroe conteudo
		$conteudo_retorno[1] .= constroe_campos_perfil_usuario_lateral();
		$conteudo_retorno[3] .= constroe_campos_perfil_usuario_lateral_direito(false);
		
		// adiciona os aniversariantes
		$conteudo_retorno[1] .= constroe_campo_aniversario();

	};
	
	// constroe o conteudo da pagina
	switch($tipo_acao){

		case 1:
		// faz logout de usuario
		logout_usuario();
		// redireciona para onde estava
		chama_pagina_inicial();
		break;
		
		case 2:
		
		// array de titulos
		$array_titulos[] = $idioma_sistema[11];
		$array_titulos[] = $idioma_sistema[539];
		
		// array de conteudos
		$array_conteudos[] = formulario_edita_perfil();
		$array_conteudos[] = constroe_formulario_relacionamento(false);
		
		// array de ids
		$array_ids[] = retorne_idcampo_md5();
		$array_ids[] = retorne_idcampo_md5();

		// conteudo da pagina
		$conteudo_retorno[2] = constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);
		
		break;
		
		case 3:

		// array de titulos
		$array_titulos[] = $idioma_sistema[17];
		$array_titulos[] = $idioma_sistema[539];
		
		// array de conteudos
		$array_conteudos[] = constroe_caixa(false, visualizar_perfil_usuario());
		$array_conteudos[] = constroe_formulario_relacionamento(true);
		
		// array de ids
		$array_ids[] = retorne_idcampo_md5();
		$array_ids[] = retorne_idcampo_md5();
	
		// conteudo
		$conteudo_retorno[2] = constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);

		break;
		
		case 7:
		$conteudo_retorno[2] = constroe_carregar_imagens();
		break;
		
		case 25:
		$conteudo_retorno[2] = constroe_caixa(false, configuracoes_perfil());
		break;
		
		case 42:
		$conteudo_retorno[2] = constroe_caixa(false, constroe_gerenciador_mensagens());
		break;
		
		case 62:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		
		case 63:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		
		case 65:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		
		case 68:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		
		case 78:
		$conteudo_retorno[2] = constroe_pesquisar_musicas();
		break;
		
		case 82:
		$conteudo_retorno[2] = constroe_pesquisar_videos();
		break;
		
		case 90:
		$conteudo_retorno[2] = constroe_carregar_paginas_usuario();
		break;
		
		case 98:
		return constroe_mensageiro();		
		break;
		
		case 99:
		$conteudo_retorno[2] = constroe_campo_exibe_notifica();
		break;
		
		case 100:
		$conteudo_retorno[2] = reenviar_ativacao_usuario();
		break;
		
		case 104:
		$conteudo_retorno[2] = constroe_visualizar_amigos_usuario();
		break;
		
		case 105:
		$conteudo_retorno[2] = constroe_campo_editar_imagem_perfil();
		break;
		
		case 106:
		$conteudo_retorno[2] = constroe_campo_pesquisa_geral();
		break;
		
		case 107:
		return constroe_mensageiro();
		break;
		
		case 108:
		$conteudo_retorno[2] = constroe_visualizador_paginas_usuario();
		break;
		
		case 109:
		
		// array de titulos
		$array_titulos[] = $idioma_sistema[539];
		
		// array de conteudos
		$array_conteudos[] = constroe_formulario_relacionamento(false);
		
		// array de ids
		$array_ids[] = retorne_idcampo_md5();

		// conteudo da pagina
		$conteudo_retorno[2] = constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);
		
		break;
		
		case 110:
		// campo formulario construir paginas
		$conteudo_retorno[2] = campo_formulario_construir_pagina();
		break;
		
		case 111:
		// constroe o campo para exibir o mapa do bing
		$conteudo_retorno[2] = constroe_campo_exibir_mapa_bing(false);
		break;
		
		case 112:
		$conteudo_retorno[2] = carrega_recomendacoes_musicas(false);
		break;
		
		case 113:
		$conteudo_retorno[2] = abrir_media_player(true);
		break;
		
		case 114:
		$conteudo_retorno[2] = abrir_media_player(false);
		break;
		
		default:
		
		// valida abrir publicacao
		if($idpost != null){
			
			// abrindo publicacao
			$conteudo_retorno[2] = retorne_publicacao_id($idpost);
			
			// conteudo especial
			$conteudo_especial = true;
			
			// saindo de switch
			break;
			
		};
		
		// valida abrir comentario
		if(retorne_idcomentario_requeste() != null){
			
			// abrindo comentario
			$conteudo_retorno[2] = retorne_comentario_id(retorne_idcomentario_requeste());
			
			// conteudo especial
			$conteudo_especial = true;
			
			// saindo de switch
			break;
			
		};	
		
		// valida modo mobile
		if($modo_mobile == false){

			// array de titulos
			$array_titulos[] = $idioma_sistema[93];
			
			// valida se o usuário é dono do perfil
			if($usuario_dono == true){
				
				// array de titulos
				$array_titulos[] = $idioma_sistema[606];
			
			};
			
			// array de titulos
			$array_titulos[] = $idioma_sistema[381];
			$array_titulos[] = $idioma_sistema[483];
			$array_titulos[] = $idioma_sistema[180];
			
			// array de ids
			$array_ids[] = retorne_idcampo_md5();
			
			// valida se o usuário é dono do perfil
			if($usuario_dono == true){
				
				// array de ids
				$array_ids[] = retorne_idcampo_md5();
			
			};
			
			// array de ids
			$array_ids[] = retorne_idcampo_md5();
			$array_ids[] = retorne_idcampo_md5();
			$array_ids[] = retorne_idcampo_md5();
			
			// array de conteudos
			$array_conteudos[] = constroe_campo_publicar();
			
			// valida se o usuário é dono do perfil
			if($usuario_dono == true){
				
				// array de conteudos
				$array_conteudos[] = constroe_conteudo_recomendado();
			
			};
			
			// array de conteudos
			$array_conteudos[] = constroe_visualizar_videos_perfil();
			$array_conteudos[] = constroe_visualizador_musicas_perfil();
			$array_conteudos[] = constroe_campo_depoimentos_perfil();
		
			// valida usuario dono
			if($usuario_dono == false){
				
				// array de titulos
				$array_titulos[0] = $idioma_sistema[519];
				$array_titulos[] = $idioma_sistema[403];
			
				// array de ids
				$array_ids[] = retorne_idcampo_md5();
	
				// array de conteudos
				$array_conteudos[] = visualizar_perfil_usuario();
				
			}else{
				
				// array de titulos
				$array_titulos[] = $idioma_sistema[531];
				
				// array de ids
				$array_ids[] = retorne_idcampo_md5();
				
				// array de conteudos
				$array_conteudos[] = constroe_campo_alterar_plano_fundo();
				
				// valida o tipo de acao
				if($tipo_acao == 9){
				
					// array de titulos
					$array_titulos[0] = $idioma_sistema[608];
				
				};
			
			};

			// conteudo de aba
			$conteudo_aba = constroe_aba(true, false, $array_titulos, $array_conteudos, $array_ids);
			
			// conteudo de retorno
			$conteudo_retorno[2] .= $conteudo_aba;

			// conteudo de retorno
			$conteudo_retorno[6] .= constroe_perfil_ultra_basico();
			$conteudo_retorno[6] .= constroe_campo_album_perfil_basico();

			// conteudo de retorno
			$conteudo_retorno[7] = constroe_capa_perfil_usuario(null);
			
		}else{

			// valida mobile
			if($modo_mobile == false){

				// adiciona o perfil basico do usuario
				$conteudo_retorno[2] .= constroe_caixa(false, constroe_perfil_basico());			

			}else{
				
				// adiciona o perfil basico do usuario
				$conteudo_retorno[2] .= constroe_perfil_basico();
				
			};

			// constroe campo de publicacao
			$conteudo_retorno[2] .= constroe_campo_publicar();

		};

	};
	
};

// valida configuracao de privacidade
if(retorna_configuracao_privacidade(1, $uid) == true){

	// limpa conteudos
	$conteudo_retorno[2] = mensagem_privacidade_usuario();
	
};

// valida conteudo
if($conteudo_retorno[2] == null){
	
	// conteudo padrao
	$conteudo_retorno[2] = constroe_conteudo_padrao(true, null, retorna_idcampo_conteudo_geral());
	
};

// valida o modo mobile
if($modo_mobile == false){
	
	// adiciona o chat
	$conteudo_retorno[2] .= $chat_usuario;

};

// conteudo de rodape
$conteudo_retorno[4] = constroe_conteudo_rodape();

// conteudo de sub topo
$conteudo_retorno[5] = constroe_conteudo_sub_topo();

// valida conteudo especial
if($conteudo_especial == true and $conteudo_retorno[2] != null){
	
	// valida se é um permalink
	if($modo_permalink  == true){

		// adiciona div de conteudo padrao
		$conteudo_retorno[2] = constroe_conteudo_padrao(false, $conteudo_retorno[2], null);
		
	}else{
	
		// adiciona div de conteudo padrao
		$conteudo_retorno[2] = constroe_conteudo_padrao(true, $conteudo_retorno[2], null);
	
	};
	
};

// retorno
return $conteudo_retorno;

};

?>