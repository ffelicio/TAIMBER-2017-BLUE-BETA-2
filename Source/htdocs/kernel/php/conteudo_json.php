<?php

// conteudo de json
function conteudo_json(){

// globals
global $tabela_banco;

// carrega conteudo
switch(retorne_campo_formulario_request(2)){

	case 1:
	$conteudo = logar_usuario(null, null, true);
	break;

	case 2:
	$conteudo = cadastrar_usuario();
	break;

	case 3:
	// atualiza o perfil do usuario
	atualiza_perfil_usuario();
	// sai do script
	die();
	break;

	case 4:
	// upload de imagem de perfil
	upload_imagem_perfil();
	// sai do script
	die();
	break;

	case 5:
	// upload de imagem de capa de perfil
	upload_imagem_capa();
	// sai do script
	die();
	break;

	case 6:
	// upload de imagem de album
	upload_imagem_album(2);
	// sai do script
	die();
	break;

	case 7:
	$conteudo = carrega_imagens_album_usuario();
	break;

	case 8:
	$conteudo = publicar_conteudo_usuario(null, 0);
	break;

	case 9:
	$conteudo = carrega_publicacoes_usuario();
	break;

	case 10:
	$array_imagens["dados"] = constroe_imagens_publicacao(retorna_chave_request(), 0, retorne_idusuario_logado());
	$conteudo = json_encode($array_imagens);
	break;

	case 11:
	$conteudo = excluir_imagem_album();
	break;

	case 12:
	$conteudo .= excluir_compartilhamentos(retorne_campo_formulario_request(4));
	$conteudo .= excluir_publicacao_usuario(retorne_campo_formulario_request(4), false);
	break;

	case 13:
	$conteudo = adicionar_amizade();
	break;

	case 14:
	$conteudo = carrega_amigos_usuario(null, true);
	break;

	case 15:
	// paginacao de amizades
	contador_avanco(14, 2);
	// zera dados de sessao
	zera_dados_sessao();
	// atualiza variavel de requeste para carregar amigos
	$_REQUEST[$variavel_campo[2]] = 14;
	// contaudo
	$conteudo = carrega_amigos_usuario(null, true);
	break;

	case 16:
	$conteudo = pesquisa_geral();
	break;

	case 17:
	// paginacao de amizades
	contador_avanco(17, 2);
	// zera dados de sessao
	zera_dados_sessao();
	break;

	case 18:
	$conteudo = postar_comentario();
	break;

	case 19:
	$conteudo = carregar_comentarios();
	break;

	case 20:
	$conteudo = salvar_comentario_editado();
	break;

	case 21:
	$conteudo = excluir_comentario();
	break;

	case 22:
	$conteudo = carrega_feeds_usuario();
	break;

	case 23:
	$conteudo = curtir();
	break;

	case 24:
	$conteudo = bloquear_usuario();
	break;

	case 25:
	// carrega dados...
	if(retorne_campo_formulario_request(14) != null){
		$array_retorno["dados"] = carrega_solicitacoes_amizade();
		$conteudo = json_encode($array_retorno);
	};
	break;

	case 26:
	// zera o contador de avanco
	contador_avanco(25, 2);
	contador_avanco(26, 2);
	contador_avanco(25, 1);
	// carrega dados...
	$array_retorno["dados"] = carrega_solicitacoes_amizade();
	$conteudo = json_encode($array_retorno);
	break;

	case 27:
	// carrega dados...
	$array_retorno["dados"] = carrega_usuarios_bloqueados(true);
	$conteudo = json_encode($array_retorno);
	break;

	case 28:
	$conteudo = desbloquear_usuario();
	break;

	case 29:
	$conteudo = carrega_visitas_perfil();
	break;

	case 30:
	$conteudo = alterar_senha();
	break;

	case 31:
	$conteudo = limpar_perfil();
	break;

	case 32:
	$conteudo = excluir_conta_usuario();
	break;

	case 33:
	$conteudo = atualiza_privacidade_usuario();
	// sai do script
	die();
	break;

	case 34:
	$conteudo = escrever_depoimento();
	break;

	case 35:
	$conteudo = carregar_depoimentos();
	break;

	case 36:
	$conteudo = excluir_aceitar_depoimento();
	break;

	case 37:
	$conteudo = pesquisar_marcador();
	break;

	case 38:
	$conteudo = marcar_usuario();
	break;

	case 39:
	$conteudo = marcacoes_concluidas();
	break;

	case 40:
	$conteudo = exibir_amigos_marcados();
	break;

	case 41:
	$conteudo = enviar_mensagem_usuario(null, true, null, null);
	break;

	case 42:
	$conteudo = carregar_mensagens_usuario();
	break;

	case 43:
	$conteudo = excluir_mensagem_usuario();
	break;

	case 44:
	$conteudo = carregar_emoticons();
	break;

	case 45:
	$conteudo = atualizar_conexao_usuario();
	break;

	case 46:
	$conteudo = constroe_conteudo_janela_troca_mensagens_chat();
	break;

	case 47:
	$conteudo = atualizador_chat_usuario();
	break;

	case 48:
	$conteudo = carregar_mensagens_usuario_chat();
	break;

	case 49:
	$conteudo = adicionar_usuario_janela_usuarios_abertos_chat();
	break;

	case 50:
	$conteudo = fechar_janela_chat();
	break;

	case 51:
	$conteudo = upload_imagem_album(4);
	break;

	case 52:
	$conteudo = criar_pagina();
	break;

	case 53:
	// upload de imagem de perfil
	upload_imagem_perfil();
	// sai do script
	die();
	break;

	case 54:
	$conteudo = criar_pagina();
	break;

	case 55:
	// upload de imagem de capa de pagina de usuario
	upload_imagem_capa();
	// sai do script
	die();
	break;

	case 56:
	$conteudo = adiciona_inscrito_pagina();
	break;

	case 57:
	$conteudo = exibir_inscritos_pagina();
	break;

	case 58:
	$conteudo = visualizar_paginas_usuario();
	break;

	case 59:
	$conteudo = salvar_configuracoes_pagina();
	break;

	case 60:
	$conteudo = excluir_pagina_usuario();
	break;

	case 61:
	$conteudo = pesquisar_pagina_usuario();
	break;

	case 62:
	$conteudo = carrega_notificacoes(null, $tabela_banco[7], 0);
	break;

	case 63:
	$conteudo = carrega_notificacoes(null, $tabela_banco[9], 0);
	break;

	case 64:
	$conteudo = atualiza_notifica_timer();
	break;

	case 65:
	$conteudo = carrega_notificacoes(null, $tabela_banco[13], 0);
	break;

	case 66:
	$conteudo = salvar_frase_efeito();
	break;

	case 67:
	$conteudo = excluir_capa();
	break;

	case 68:
	$conteudo = carrega_notificacoes(null, $tabela_banco[14], 0);
	break;

	case 69:
	$conteudo = constroe_imagem_redimensionar(0);
	break;

	case 70:
	$conteudo = recorta_imagem();
	break;

	case 71:
	$conteudo = atualizar_publicacao();
	break;

	case 72:
	$conteudo = carregar_aniversariantes();
	break;

	case 73:
	$conteudo = compartilhar();
	break;

	case 74:
	$conteudo = carregar_hashtags();
	break;

	case 75:
	$conteudo = atualiza_numero_hashtag();
	break;

	case 76:
	$conteudo = upload_musica_usuario();
	break;

	case 77:
	$conteudo = carregar_musicas_usuario();
	break;

	case 78:
	$conteudo = pesquisar_musicas_usuarios();
	break;

	case 79:
	$conteudo = excluir_musica_usuario(retorne_campo_formulario_request(4), null);
	break;

	case 80:
	$conteudo = upload_video_usuario();
	break;

	case 81:
	$conteudo = excluir_video_usuario(retorne_campo_formulario_request(4), null);
	break;

	case 82:
	$conteudo = pesquisar_videos_usuarios();
	break;

	case 83:
	$conteudo = verificador_usuario_logado();
	break;

	case 84:
	$conteudo = previsualiza_musicas_publicacao(retorna_chave_request());
	break;

	case 85:
	$conteudo = retorne_data_ultima_visualizacao_conexao(retorne_idusuario_request(), true);
	break;

	case 86:
	$conteudo = previsualiza_videos_publicacao(retorna_chave_request());
	break;

	case 87:
	$conteudo = atualiza_numero_amigos_online();
	break;

	case 88:
	$conteudo = exibir_amigos_online();
	break;

	case 89:
	$conteudo = carrega_amigos_usuario(null, true);
	break;

	case 90:
	$conteudo = constroe_paginas_criadas();
	break;

	case 91:
	
	// paginacao de amizades
	contador_avanco(89, 2);

	break;

	case 92:
	$conteudo = salvar_url_amigavel_usuario();
	break;

	case 93:
	$conteudo = exibe_info_link();
	break;

	case 94:
	$conteudo = adicionar_conteudo_url();
	break;

	case 95:
	$conteudo = publicar_conteudo_url();
	break;

	case 96:
	$conteudo = exclui_conteudo_url(retorna_chave_request());
	break;

	case 97:
	$conteudo = detecta_resolucao();
	break;

	case 98:
	$conteudo = atualizar_descricao_imagem_album();
	break;

	case 99:
	$conteudo = carrega_notificacoes($tabela_banco[6], null, 0);
	break;

	case 100:
	$conteudo = reenviar_ativacao_usuario();
	break;

	case 101:
	$conteudo = envia_redefinir_senha();
	break;

	case 102:
	$conteudo = nova_senha();
	break;

	case 103:
	$conteudo = atualizar_email();
	break;

	case 104:
	$conteudo = carrega_amigos_usuario(false, true);
	break;

	case 105:
	$conteudo = excluir_imagem_perfil();
	break;

	case 106:
	$conteudo = define_modo_mobile();
	break;

	case 107:
	$conteudo = alterar_idioma();
	break;

	case 108:
	$conteudo = carregar_noticias();
	break;

	case 109:
	// disponivel
	$conteudo = null;
	break;

	case 110:
	$conteudo = excluir_feed_usuario();
	break;

	case 111:
	$conteudo = carrega_amigos_usuario(true, true);
	break;

	case 112:
	$conteudo = constroe_conteudo_janela_troca_mensagens_mensageiro();
	break;

	case 113:
	$conteudo = resetar_amigos_mensageiro();
	break;

	case 114:
	$conteudo = upload_imagem_plano_fundo();
	break;

	case 115:
	$conteudo = remover_plano_fundo_usuario();
	break;

	case 116:
	$conteudo = carregar_paginas_usuario();
	break;

	case 117:
	$conteudo = alterar_relacionamento();
	break;

	case 118:
	$conteudo = excluir_relacionamento();
	break;

	case 119:
	$conteudo = aceita_relacionamento();
	break;

	case 120:
	$conteudo = atualiza_notifica_relacionamento();
	break;

	case 121:
	$conteudo = paginar_recomendacoes_usuario();
	break;

	case 122:
	$conteudo = salva_geolocalizacao();
	break;

	case 123:
	$conteudo = carrega_links_medias();
	break;

	case 124:
	$conteudo = publicar_conteudo_usuario(-1, 0);
	break;

	case 125:
	$conteudo = paginar_slide_album();
	break;

	case 126:
	$conteudo = restaurar_imagem_album_dados();
	break;

	case 127:
	$conteudo = null;
	break;

	case 128:
	$conteudo = reposicionar_capa();
	break;

	case 129:
	$conteudo = null;
	break;

	case 130:
	$conteudo = null;
	break;

	case 131:
	$conteudo = null;
	break;

	case 132:
	$conteudo = null;
	break;

	case 133:
	$conteudo = null;
	break;

	case 134:
	$conteudo = null;
	break;

	case 135:
	$conteudo = null;
	break;

	case 136:
	$conteudo = null;
	break;

	case 137:
	$conteudo = null;
	break;

	case 138:
	$conteudo = null;
	break;

	case 139:
	$conteudo = null;
	break;

	case 140:
	$conteudo = null;
	break;

	case 141:
	$conteudo = null;
	break;

	case 142:
	$conteudo = null;
	break;

	case 143:
	$conteudo = null;
	break;

	case 144:
	$conteudo = null;
	break;

	case 145:
	$conteudo = null;
	break;

	case 146:
	$conteudo = null;
	break;

	case 147:
	$conteudo = null;
	break;

	case 148:
	$conteudo = null;
	break;

	case 149:
	$conteudo = null;
	break;

	case 150:
	$conteudo = null;
	break;

	case 151:
	$conteudo = null;
	break;

	case 152:
	$conteudo = null;
	break;

	case 153:
	$conteudo = null;
	break;

	case 154:
	$conteudo = null;
	break;

	case 155:
	$conteudo = null;
	break;

	case 156:
	$conteudo = null;
	break;

	case 157:
	$conteudo = null;
	break;

	case 158:
	$conteudo = null;
	break;

	case 159:
	$conteudo = null;
	break;

	case 160:
	$conteudo = null;
	break;

	case 161:
	$conteudo = null;
	break;

	case 162:
	$conteudo = null;
	break;

	case 163:
	$conteudo = null;
	break;

	case 164:
	$conteudo = null;
	break;

	case 165:
	$conteudo = null;
	break;

	case 166:
	$conteudo = null;
	break;

	case 167:
	$conteudo = null;
	break;

	case 168:
	$conteudo = null;
	break;

	case 169:
	$conteudo = null;
	break;

	case 170:
	$conteudo = null;
	break;

	case 171:
	$conteudo = null;
	break;

	case 172:
	$conteudo = null;
	break;

	case 173:
	$conteudo = null;
	break;

	case 174:
	$conteudo = null;
	break;

	case 175:
	$conteudo = null;
	break;

	case 176:
	$conteudo = null;
	break;

	case 177:
	$conteudo = null;
	break;

	case 178:
	$conteudo = null;
	break;

	case 179:
	$conteudo = null;
	break;

	case 180:
	$conteudo = null;
	break;

	case 181:
	$conteudo = null;
	break;

	case 182:
	$conteudo = null;
	break;

	case 183:
	$conteudo = null;
	break;

	case 184:
	$conteudo = null;
	break;

	case 185:
	$conteudo = null;
	break;

	case 186:
	$conteudo = null;
	break;

	case 187:
	$conteudo = null;
	break;

	case 188:
	$conteudo = null;
	break;

	case 189:
	$conteudo = null;
	break;

	case 190:
	$conteudo = null;
	break;

	case 191:
	$conteudo = null;
	break;

	case 192:
	$conteudo = null;
	break;

	case 193:
	$conteudo = null;
	break;

	case 194:
	$conteudo = null;
	break;

	case 195:
	$conteudo = null;
	break;

	case 196:
	$conteudo = null;
	break;

	case 197:
	$conteudo = null;
	break;

	case 198:
	$conteudo = null;
	break;

	case 199:
	$conteudo = null;
	break;

	case 200:
	$conteudo = null;
	break;

};

// nao permite retornar valor sem json isto causa erro
if($conteudo == null){
	
	// seta o valor nulo
	$array_retorno["dados"] = null;
	
	// atualiza o conteudo
	$conteudo = json_encode($array_retorno);

};

// retorno
return $conteudo;

};

?>