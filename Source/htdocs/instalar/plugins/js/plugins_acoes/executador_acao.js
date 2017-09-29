
// executador de acoes
function executador_acao(array_valores, tipo_acao, id){

// converte tipo de acao para inteiro
tipo_acao = parseInt(tipo_acao);

// id de usuario atual
var v_uid = v_variaveis_javascript["uid"];
var v_pagina = v_variaveis_javascript["id_pagina_visualizando"];

// define valor id de elemento
var elemento_id = id;

// token da pagina
var v_token_pagina = v_variaveis_javascript['token_pagina'];

// modo mobile
var v_modo_mobile = v_variaveis_javascript['modo_mobile'];

// permalink
var v_permalink = v_variaveis_javascript['permalink'];

// tipo de acao
switch(tipo_acao){
	
	case 1:
	var v_email = array_valores[0];
	var v_senha = array_valores[1];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, campo_email:v_email, campo_senha:v_senha, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 2:
	var v_nome = v_variaveis_javascript['campo_cadastro_0'];
	var v_sobrenome = v_variaveis_javascript['campo_cadastro_1'];
	var v_email = v_variaveis_javascript['campo_cadastro_2'];
	var v_senha = v_variaveis_javascript['campo_cadastro_3'];
	var v_senha_confirma = v_variaveis_javascript['campo_cadastro_4'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, nome: v_nome, sobrenome: v_sobrenome, email: v_email, senha: v_senha, senha_confirma: v_senha_confirma, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;

	case 7:
	var v_modo_album = v_variaveis_javascript['modo_album'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, modo_album:v_modo_album, dataType:"json"});
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
	break;
	
	case 8:
	var v_texto = array_valores[0];
	var v_chave = v_variaveis_javascript["chave"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, chave:v_chave, campo_texto:v_texto, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;

	case 9:
	
	// valida o permalink
	if(v_permalink.length == 0){
		
		var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
		exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
		
	}else{
		
		// retorno nulo
		return null;
		
	};
	
	break;
	
	case 10:
	var v_chave = v_variaveis_javascript["chave"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, chave:v_chave, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 11:
	var v_id_imagem = array_valores[0];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, id:v_id_imagem, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 12:
	var v_id_publicacao = v_variaveis_javascript["id_temp_publicacao_excluir"];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, id:v_id_publicacao, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 13:
	var v_modo = v_variaveis_javascript["modo_temp_adicionar_amizade"];
	var v_uidamigo = v_variaveis_javascript["uidamigo"];
	var v_email = v_variaveis_javascript["e_mail_campo_add_amizade"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uidamigo, modo:v_modo, campo_email:v_email, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 14:
	var v_nome_pesquisa = v_variaveis_javascript["nome_pesquisa_amigo_local"];
	var v_modo_chat = 0;
	var v_chave = v_variaveis_javascript["chave"];
	var v_parametro = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, nome_pesquisa:v_nome_pesquisa, modo_chat:v_modo_chat, chave:v_chave, parametro_pesquisa:v_parametro, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 15:
	var v_nome_pesquisa = null;
	var v_modo_chat = 0;
	var v_chave = v_variaveis_javascript["chave"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, nome_pesquisa:v_nome_pesquisa, modo_chat:v_modo_chat, chave:v_chave, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 16:
	var v_nome_pesquisa = v_variaveis_javascript["nome_pesquisa_geral"];
	var v_modo_pesquisa_geral = v_variaveis_javascript["modo_pesquisa_geral"];
	var v_modo = 1;
	var v_modo_limpa_contador = array_valores["modo_limpa_contador"];
	var v_cidade = array_valores[1];
	var v_modo_usuarios = array_valores[2];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, nome_pesquisa:v_nome_pesquisa, cidade:v_cidade, modo_pesquisa:v_modo_pesquisa_geral, modo_usuarios:v_modo_usuarios, modo:v_modo, modo_limpa_contador:v_modo_limpa_contador, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 17:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 18:
	var v_comentario = v_variaveis_javascript["comentario_postar"];
	var v_tabela_campo = v_variaveis_javascript["tabela_campo"];
	var v_id = v_variaveis_javascript["comentario_idpostar"];
	var v_uidamigo = v_variaveis_javascript["uidamigo"];
	var v_chave = v_variaveis_javascript["chave_marcar_usuario"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, uidamigo:v_uidamigo, comentario:v_comentario, tabela_campo:v_tabela_campo, id:v_id, chave:v_chave, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 19:
	var v_tabela_campo = v_variaveis_javascript["tabela_campo"];
	var v_id = v_variaveis_javascript["comentario_idpostar"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tabela_campo:v_tabela_campo, id:v_id, elemento_id:id, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 20:
	var v_comentario = v_variaveis_javascript["campo_temp_texto_coment_editado"];
	var v_id = v_variaveis_javascript["comentario_idatualizar"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, comentario:v_comentario, id:v_id, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 21:
	var v_uid = v_variaveis_javascript["comentario_usuario_excluir_idusuario"];
	var v_id = v_variaveis_javascript["comentario_usuario_excluir_id"];
	var v_tabela_campo = v_variaveis_javascript["tabela_campo"];
	var v_id_post = v_variaveis_javascript["id_post"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, id:v_id, tabela_campo:v_tabela_campo, id_post:v_id_post, tipo_acao:tipo_acao, dataType:"json"});
	break;

	case 22:
	
	// valida o permalink
	if(v_permalink.length == 0){
		
		var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
		exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
	
	}else{
		
		// retorno nulo
		return null;
		
	};
	
	break;
	
	case 23:
	var v_tabela_campo = v_variaveis_javascript["tabela_campo"];
	var v_id = v_variaveis_javascript["id_post"];
    var v_uidamigo = v_variaveis_javascript["uidamigo"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, id:v_id, uidamigo:v_uidamigo, tabela_campo:v_tabela_campo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 24:
	// neste parametro o uid = id
	// caso mais opcoes de bloqueio aparecem...
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:id, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 25:
	var v_modo_solicitacao = v_variaveis_javascript["modo_opcoes_solicitacao_amizade"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, modo_solicitacao:v_modo_solicitacao, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 26:
	var v_modo_solicitacao = v_variaveis_javascript["modo_opcoes_solicitacao_amizade"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, modo_solicitacao:v_modo_solicitacao, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 27:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 28:
	// neste parametro o uid = id
	// caso mais opcoes de bloqueio aparecem...
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:id, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 29:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 30:
	var v_senha_atual = v_variaveis_javascript["senha_atual"];
    var v_nova_senha = v_variaveis_javascript["nova_senha"];
    var v_nova_senha_confirma = v_variaveis_javascript["nova_senha_confirma"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, senha_atual:v_senha_atual, nova_senha:v_nova_senha, nova_senha_confirma:v_nova_senha_confirma, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 31:
	var v_opcao_limpar_perfil = v_variaveis_javascript["opcao_limpar_perfil"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, opcao_limpar_perfil:v_opcao_limpar_perfil, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 32:
	var v_senha_excluir_conta = v_variaveis_javascript["campo_senha_excluir_conta"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, senha_atual:v_senha_excluir_conta, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 34:
	var v_uidamigo = v_variaveis_javascript["uidamigo_depoimento"];
	var v_depoimento = v_variaveis_javascript["depoimento_escreveu"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uidamigo, depoimento:v_depoimento, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 35:
	var v_modo = v_variaveis_javascript["modo_carrega_depoimento"];
	var v_modo_limpa_contador = v_variaveis_javascript["modo_carrega_depoimento_limpa"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, modo:v_modo, modo_limpa_contador:v_modo_limpa_contador, dataType:"json"});
	break;
	
	case 36:
	var v_id = v_variaveis_javascript["id_depoimento_excluir"];
    var v_modo = v_variaveis_javascript["modo_aceita_exclui_depoimento"];
	var v_idcampo = v_variaveis_javascript["idcampo_visualizador_depoimentos"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, modo:v_modo, id:v_id, idcampo:v_idcampo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 37:
	var v_nome_pesquisa = v_variaveis_javascript["termo_pesquisa_marcador"];
	var v_chave = v_marcadores_usuario[elemento_id];
	var v_id = v_variaveis_javascript['id_publicacao_campo_marcar'];
	var v_tabela_campo = v_variaveis_javascript['tabela_campo_marcar'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, nome_pesquisa:v_nome_pesquisa, chave:v_chave, id:v_id, tabela_campo:v_tabela_campo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 38:
	var v_uidamigo = v_variaveis_javascript["idusuario_marcar"];
	var v_chave = v_variaveis_javascript["chave_marcar_usuario"];
	var v_modo = v_variaveis_javascript["marcar_usuario_modo"];
	var v_id = v_variaveis_javascript['id_publicacao_campo_marcar'];
	var v_tabela_campo = v_variaveis_javascript['tabela_campo_marcar'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, uidamigo:v_uidamigo, chave:v_chave, modo:v_modo, id:v_id, tabela_campo:v_tabela_campo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 39:
	var v_chave = v_variaveis_javascript["chave_marcar_usuario"];
	var v_modo = v_variaveis_javascript["marcacoes_concluidas_modo"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, chave:v_chave, modo:v_modo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 40:
	var v_chave = v_variaveis_javascript["chave_marcar_usuario"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, chave:v_chave, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 41:
	var v_mensagem = v_variaveis_javascript['mensagem_enviar_usuario'];
	var v_uid = v_variaveis_javascript['uidamigo_envia_mensagem'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, mensagem:v_mensagem, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 42:
	var v_termo_pesquisa = v_variaveis_javascript['termo_pesquisa_mensagem'];
	var v_chave = v_variaveis_javascript['chave'];
	var v_zera = v_variaveis_javascript['zera_contador_mensagens'];
	var v_uidamigo = v_variaveis_javascript['uidamigo_mensagem_abrir'];
	var v_modo = v_variaveis_javascript['modo_mensagens'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, termo_pesquisa:v_termo_pesquisa, modo_limpa_contador:v_zera, chave:v_chave, uidamigo:v_uidamigo, modo:v_modo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 43:
	var v_id = v_variaveis_javascript['id_mensagem_excluir'];
    var v_modo = v_variaveis_javascript['modo_excluir_mensagem'];
	var v_uidamigo = v_variaveis_javascript['uidamigo_exclui_mensagem'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, id:v_id, uidamigo:v_uidamigo, modo:v_modo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 44:
	var v_idcampo_entrada = v_variaveis_javascript['id_campo_entrada_insere_emoticon'];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, idcampo_entrada_emoticon:v_idcampo_entrada, tipo_acao:tipo_acao, dataType:"json"});
	break;

	case 45:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;

	case 46:
	var v_uidamigo = v_variaveis_javascript['uid_usuario_novo_chat'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, uidamigo:v_uidamigo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 47:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 48:
	var v_uidamigo = v_variaveis_javascript['uidamigo_conversa_chat_temp'];
	var v_zera = v_variaveis_javascript['zera_contador_mensagens_chat'][v_uidamigo];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uidamigo, modo_limpa_contador:v_zera, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 49:
	var v_uidamigo = v_variaveis_javascript['uid_usuario_novo_chat'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, uidamigo:v_uidamigo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 50:
	var v_uidamigo = v_variaveis_javascript['uid_usuario_fecha_chat'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, uidamigo:v_uidamigo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 56:
	var v_pagina = v_variaveis_javascript['id_pagina_visualizando'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 57:
	var v_pagina = v_variaveis_javascript['id_pagina_visualizando'];
	var v_modo = v_variaveis_javascript['zera_contador_avanco_exibir_inscritos_pagina'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, pagina:v_pagina, modo:v_modo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 58:
	var v_modo = v_variaveis_javascript['modo_visualiza_paginas_usuario'];
	var v_modo_paginar = v_variaveis_javascript['modo_visualiza_paginas_usuario_paginar'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, modo:v_modo, modo_paginar:v_modo_paginar, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 59:
	var v_valor = v_variaveis_javascript['valor_configuracao_pagina'];
	var v_numero_configuracao = v_variaveis_javascript['numero_configuracao_pagina'];
	var v_pagina = v_variaveis_javascript['id_pagina_salva_configuracao'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, valor_campo:v_valor, numero_configuracao:v_numero_configuracao, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 60:
	var v_senha_atual = v_variaveis_javascript['senha_atual'];
	var v_pagina = v_variaveis_javascript['id_pagina_excluir'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, senha_atual:v_senha_atual, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 61:
	var v_termo_pesquisa = v_variaveis_javascript['termo_pesquisa_pagina'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, termo_pesquisa: v_termo_pesquisa, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 62:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
	break;
	
	case 63:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
	break;
	
	case 64:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 65:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
	break;
	
	case 66:
	var v_conteudo = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, conteudo:v_conteudo, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 67:
	var v_pagina = array_valores[0];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 68:
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 69:
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 70:
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;

	case 71:
	var v_conteudo = v_variaveis_javascript['conteudo_atualiza_publicacao'];
	var v_id = v_variaveis_javascript['id_post'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, id:v_id, conteudo:v_conteudo, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 72:
	var v_zera = v_variaveis_javascript['zera_contador_aniversariantes'];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, modo_limpa_contador:v_zera, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 73:
	var v_id_post = v_variaveis_javascript['id_post_compartilha'];
	query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, id_post:v_id_post, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 74:
	var v_hashtag = v_variaveis_javascript['hashtag'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, hashtag:v_hashtag, tipo_acao:tipo_acao, dataType:"json"});
	break;

	case 75:
	var v_hashtag = v_variaveis_javascript['hashtag'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, hashtag:v_hashtag, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 77:
	var v_uid = v_variaveis_javascript['uid_musicas_usuario'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 78:
	var v_musica = v_variaveis_javascript['musica_pesquisa'];
	var v_chave = array_valores[1];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, musica:v_musica, tipo_acao:tipo_acao, chave:v_chave, dataType:"json"});
	break;

	case 79:
	var v_id = v_variaveis_javascript['id_musica_excluir'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, id:v_id, tipo_acao:tipo_acao, dataType:"json"});
	break;	

	case 81:
	var v_id = v_variaveis_javascript['id_video_excluir'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, id:v_id, tipo_acao:tipo_acao, dataType:"json"});
	break;

	case 82:
	var v_video = v_variaveis_javascript['video_pesquisa'];
	var v_chave = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, video:v_video, tipo_acao:tipo_acao, chave:v_chave, dataType:"json"});
	break;

	case 83:
	var v_modo = v_variaveis_javascript['deslogar_modo'];
	var query_parametro = $.param({token_pagina:v_token_pagina, modo:v_modo, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 84:
	var v_chave = v_variaveis_javascript['chave'];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, chave:v_chave, dataType:"json"});	
	break;
	
	case 86:
	var v_chave = v_variaveis_javascript['chave'];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, chave:v_chave, dataType:"json"});	
	break;	
	
	case 88:
	var v_zera = v_variaveis_javascript['zera_contador_amigos_online'];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, modo_limpa_contador:v_zera, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 89:
	var v_nome_pesquisa = v_variaveis_javascript["nome_pesquisa_amigo_local_chat"];
	var v_modo_chat = 1;
	var v_chave = v_variaveis_javascript["chave"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, nome_pesquisa:v_nome_pesquisa, modo_chat:v_modo_chat, chave:v_chave, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 92:
	var v_nome = array_valores[0];
	var v_modo = array_valores[1];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, nome:v_nome, modo:v_modo, dataType:"json"});
	break;
	
	case 93:
	var v_modo = array_valores[0];
	var v_uid = array_valores[1];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, modo:v_modo, dataType:"json"});
	break;
	
	case 94:
	var v_url = array_valores[0];
	var v_chave = v_variaveis_javascript["chave"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, url:v_url, chave:v_chave, dataType:"json"});
	break;
	
	case 95:
	var v_titulo = array_valores[0];
	var v_descricao = array_valores[1];
	var v_imagens = array_valores[2];
	var v_chave = v_variaveis_javascript["chave"];
	var v_url = array_valores[3];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, titulo:v_titulo, descricao:v_descricao, imagens:v_imagens, chave:v_chave, url:v_url, dataType:"json"});
	break;
	
	case 96:
	var v_chave = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, chave:v_chave, dataType:"json"});
	break;
	
	case 97:
	var v_largura = array_valores[0];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, largura:v_largura, dataType:"json"});	
	break;
	
	case 98:
	var v_conteudo = array_valores[0];
	var v_id = array_valores[1];
	var v_chave = array_valores[2];
	var query_parametro = $.param({token_pagina:v_token_pagina, conteudo:v_conteudo, id:v_id, chave:v_chave, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 101:
	var v_email = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, email:v_email, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 102:
    var v_nova_senha = array_valores[0];
    var v_nova_senha_confirma = array_valores[1];
	var v_chave = array_valores[2];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, nova_senha:v_nova_senha, nova_senha_confirma:v_nova_senha_confirma, chave:v_chave, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 103:
	var v_email = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, email:v_email, dataType:"json"});
	break;
	
	case 104:
	// exibe a barra de progresso gif
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
	// parametro padrao
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 105:
	var v_modo = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, modo:v_modo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 106:
	var v_chave = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, chave:v_chave, dataType:"json"});
	break;
	
	case 107:
	var v_modo = array_valores[0];
	var v_chave = v_variaveis_javascript["chave"];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, modo:v_modo, tipo_acao:tipo_acao, chave:v_chave, dataType:"json"});
	break;
	
	case 108:
	var v_modo = array_valores[1];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, modo:v_modo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 110:
	var v_id_publicacao = v_variaveis_javascript["id_temp_publicacao_excluir"];
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, id:v_id_publicacao, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 111:
	var v_nome_pesquisa = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, nome_pesquisa: v_nome_pesquisa, dataType:"json"});
	break;
	
	case 112:
	var v_uidamigo = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, uidamigo:v_uidamigo, tipo_acao:tipo_acao, dataType:"json"});
	break;
	
	case 113:
	var v_chave = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, chave:v_chave, dataType:"json"});
	break;

	case 116:
	var v_modo = array_valores[1];
	var v_termo_pesquisa = array_valores[2];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, modo: v_modo, termo_pesquisa:v_termo_pesquisa, dataType:"json"});
	break;
	
	case 117:
	var v_uidamigo = array_valores[0];
	var v_relacao = array_valores[1];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, uidamigo:v_uidamigo, relacao:v_relacao, dataType:"json"});
	break;
	
	case 118:
	var v_uidamigo = array_valores[0];
	var v_relacao = array_valores[1];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, uidamigo:v_uidamigo, relacao:v_relacao, dataType:"json"});
	break;
	
	case 119:
	var v_uidamigo = array_valores[0];
	var v_relacao = array_valores[1];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, uidamigo:v_uidamigo, relacao:v_relacao, dataType:"json"});
	break;
	
	case 121:
	var v_modo = array_valores[0];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, modo:v_modo, dataType:"json"});
	break;
	
	case 122:
	var v_latitude = array_valores["latitude"];
	var v_longitude = array_valores["longitude"];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, latitude:v_latitude, longitude:v_longitude, dataType:"json"});
	break;
	
	case 125:
	var v_id = array_valores[0];
	var v_modo = array_valores[1];
	var v_idcampo = array_valores[2];
	var v_uid = array_valores[3];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, id:v_id, modo:v_modo, idcampo:v_idcampo, dataType:"json"});
	break;
	
	case 126:
	var v_id = array_valores[0];
	var v_idcampo = array_valores[1];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, id:v_id, idcampo:v_idcampo, dataType:"json"});
	break;
	
	case 127:
	var v_modo = v_variaveis_javascript['modo_apps'];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, modo:v_modo, dataType:"json"});
	break;
	
	case 128:
	var v_modo = array_valores[0];
	var v_idcampo = array_valores[1];
	var v_altura = array_valores[2];
	var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, modo:v_modo, idcampo:v_idcampo, altura:v_altura, dataType:"json"});
	break;
	
};

// valida parametro
if(query_parametro == null){
	
	// parametro padrao
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});

};

// monta requisicao
$.post(v_variaveis_javascript["pagina_acoes"], query_parametro, function(retorno){

// objeto de retorno
var v_objeto = jQuery.parseJSON(retorno);

// valida se a variavel de objeto existe
if(retorne_variavel_existe(v_objeto) == false){
	
	// retorno nulo
	return null;
	
};

// exibe os campos ocultos
exibir_campos_ocultos();

// separa dados
var v_dados = v_objeto["dados"];
var v_chave = v_objeto["chave"];

// tipo de acao
switch(tipo_acao){

    case 1:
	
	// oculta a barra de progresso gif
	oculta_exibe_elemento_idcampo(array_valores[2], 0);
	oculta_exibe_elemento_idcampo(array_valores[3], 0);
	
	// limpa dados antigos
	$("#" + elemento_id).html("");
	
	// atualiza a pagina
	if(v_dados == -1){
		
		// limpa o formulario de cadastro
		$("#" + v_variaveis_javascript['id_formulario_cadastro']).html("");
	
		// oculta o formulario
		oculta_exibe_elemento_idcampo(array_valores[4], null);
		
		// recarrega a pagina
		location.reload();
		
		// retorno
		return false;
		
	}else{
		
		// exibe o dialogo informando que o login esta incorreto
		exibe_dialogo(array_valores[5]);
		
		// exibe o formulario de cadastro
		oculta_exibe_elemento_idcampo(array_valores[6], 0);
		
	};
	
	break;
	
	case 2:
	// atualiza a pagina
	if(v_dados == -1){
		// atualiza a pagina
		location.reload();
		
		// retorna false
		return false;
	};
	// limpa dados antigos
	$("#" + elemento_id).html("");
	// oculta campos
	exibe_elemento_oculto(v_variaveis_javascript['campo_cadastro_7'], null);
	exibe_elemento_oculto(v_variaveis_javascript['campo_cadastro_6'], 0);
	break;
	
	case 7:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	
	case 8:

	// valida se elemento existe
	if(retorna_elemento_id_existe("id_campo_numero_publicacoes") == true){
		
		// numero de publicacoes
		document.getElementById("id_campo_numero_publicacoes").innerHTML = v_objeto["linhas"];
		
	};
	
	// setando valores
	v_variaveis_javascript["chave"] = v_chave;
	document.getElementById("id_campo_chave_publicacao_imagem").value = v_chave;
	document.getElementById("id_campo_chave_publicacao_musica").value = v_chave;
	document.getElementById("id_campo_chave_publicacao_video").value = v_chave;
	document.getElementById("id_div_exibe_imagens_upload_publicacao").innerHTML = "";
	document.getElementById(array_valores[1]).focus();
	break;
	
	case 9:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	
	case 10:
	$("#" + elemento_id).html("");
	break;
	
	case 11:
	// numero de imagens
	document.getElementById("id_div_numero_imagens_visualizador_imagens_album_perfil").innerHTML = v_objeto["linhas"];
	break;
	
	case 12:
	
	// valida se elemento existe
	if(retorna_elemento_id_existe("id_campo_numero_publicacoes") == true){
		
		// numero de publicacoes
		document.getElementById("id_campo_numero_publicacoes").innerHTML = v_objeto["linhas"];
	
	};
	
	break;
	
	case 13:
	// recarrega a pagina
	if(parseInt(v_dados) == -1){
		document.getElementById(v_variaveis_javascript["campo_mensagem_falha_add_amizade"]).innerHTML = v_objeto["mensagem_retorno"];
        return null;
	}else{
	    location.reload();
	};
	break;
	
	case 14:
	// limpa dados antigos
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
	    $("#" + elemento_id).html("");
	};
	// exibe a barra de progresso gif
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	
	case 15:
	// limpa dados antigos
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;
	
	case 16:
	
	// exibe a barra de progresso
	exibe_elemento_oculto(array_valores[0], null);

	// limpa dados antigos
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
		
	    $("#" + elemento_id).html("");
		
	};
	
	break;
	
	case 18:
	
	// valida variaveis existem.
	if(retorne_variavel_existe(v_objeto["numero_comentarios"]) == true && retorne_variavel_existe(v_objeto["numero_comentarios_2"]) == true){
		
		// setando valor...
		document.getElementById(v_variaveis_javascript["campo_numero_comentarios"]).innerHTML = v_objeto["numero_comentarios"];
		
		// valida elemento existe
		if(retorna_elemento_id_existe(array_valores[0]) == true){
			
			// setando valor...
			document.getElementById(array_valores[0]).innerHTML = v_objeto["numero_comentarios_2"];
		
		};
	
	};
	
	break;
	
	case 19:

	// oculta exibe a barra de progresso
	exibe_elemento_oculto(array_valores[0], null);
	
	// oculta o paginador
	document.getElementById(v_variaveis_javascript["campo_comentario_paginacao_atual"]).innerHTML = v_objeto["linhas_faltam"];

	// valida numero de linhas
	if(v_objeto["linhas"] == 0){

		// retorno nulo
	    return null;
		
	};
	
	break;
	
	case 20:
	$("#" + elemento_id).html("");
	break;
	
	case 21:
	remove_elemento_id(elemento_id);
	break;
	
	case 22:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	
	case 23:
	$("#" + elemento_id).html("");
	break;

	case 24:
	location.reload();
	return null;
	break;
	
	case 26:
	$("#" + elemento_id).html("");
	break;
	
	case 28:
	location.reload();
	return null;
	break;
	
	case 30:
	if(parseInt(v_dados) == 1){
		location.reload();
		return null;
	}else{
		$("#" + elemento_id).html("");
	};
	break;
	
	case 31:
	location.reload();
	return null;
	break;
	
	case 32:
	if(parseInt(v_dados) == 1){
		location.reload();
		return null;
	}else{
		$("#" + elemento_id).html("");
	};
	// oculta campo excluir conta de usuario
	oculta_exibe_elemento_idcampo(array_valores[0], 0);
	break;
	
	case 34:
	$("#" + elemento_id).html("");
	break;
	
	case 35:
	// limpa depoimentos antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	// oculta campo excluir conta de usuario
	oculta_exibe_elemento_idcampo(array_valores[0], 0);
	break;
	
	case 36:
	remove_elemento_id(elemento_id);
	if(parseInt(v_objeto["deletou"]) == -1){
	remove_elemento_id(v_variaveis_javascript["idcampo_depoimento_usuario"]);
	};
	
	// define o novo elemento_id
	elemento_id = v_variaveis_javascript["idcampo_visualizador_depoimentos"];
	$("#" + elemento_id).html("");
	break;
	
	case 37:
	// limpa chats antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;
	
	case 38:
	$("#" + elemento_id).html("");
	break;
	
	case 39:
	$("#" + elemento_id).html("");
	break;
	
	case 40:
	$("#" + elemento_id).html("");
	break;
	
	case 41:
	return null;
	break;
	
	case 42:
	// limpa chats antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	// oculta barra de progresso gif
    exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	
	case 46:
	$("#" + elemento_id).html("");
	break;
	
	case 47:
	aloca_atualizacoes_chat(v_dados, v_objeto["mensagens"]);
	return null;
	break;
	
	case 56:
	$("#" + elemento_id).html("");
	break;
	
	case 57:
	// oculta a barra de progresso gif
    exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	// limpa resultados antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;
	
	case 58:
	// oculta a barra de progresso gif
    exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_visualizar_paginas'], null);
	// limpa resultados antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;

	case 60:
	$("#" + elemento_id).html("");
	break;
	
	case 61:
	// limpa depoimentos antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;
	
	case 62:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	
	case 63:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	
	case 64:
	
	// aloca as atualizacoes das notificacoes
	aloca_atualizacoes_notifica(v_dados, array_valores);
	
	// retorno nulo
	return null;
	
	break;
	
	case 65:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	
	case 66:
	location.reload();
	break;
	
	case 67:
	location.reload();
	break;
	
	case 69:
	$("#" + elemento_id).html("");
	break;
	
	case 70:
	$("#" + elemento_id).html("");
	break;
	
	case 71:
	$("#" + elemento_id).html("");
	break;

	case 72:
	
	if(array_valores[0] == 1){
		
		$("#" + elemento_id).html("");
		
	};
	
	break;
	
	case 73:
	$("#" + elemento_id).html(v_dados);
	$("#" + array_valores[1]).html(v_objeto["compartilhado"]);
	
	// valida ainda pode compartilhar
	if(parseInt(v_objeto["linhas"]) != 0){
		
		// exibe o dialogo de compartilhamento bem sucedido
		exibe_dialogo(array_valores[0]);
		
	};

	// retorno nulo
	return null;
	
	break;
	
	case 75:
	$("#" + elemento_id).html("");
	break;
	
	case 77:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_musicas_usuario'], null);
	break;
	
	case 78:
	
	// informacoes complementares
	var v_informacoes = v_objeto["informacoes"];
	
	// limpa chats antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	
	// ocultando a barra de progresso
	exibe_elemento_oculto(array_valores[0], null);
	
	case 79:
	
	// valida id de musica
	if(v_id != null){
		
		// atualizando a pagina
		location.reload();
	
	};
	
	break;
	
	// oculta a barra de progresso
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_pesquisa_musicas'], null)
	
	// informacoes
	$("#" + v_variaveis_javascript['id_campo_pesquisa_musicas_informacoes']).html(v_informacoes);
	break;
	
	case 81:
	
	// atualizando a pagina
	location.reload();
	
	break;
	
	case 82:
	
	// informacoes complementares
	var v_informacoes = v_objeto["informacoes"];
	
	// limpa chats antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	
	// oculta a barra de progresso
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_pesquisa_videos'], null)
	
	// informacoes
	$("#" + v_variaveis_javascript['id_campo_pesquisa_videos_informacoes']).html(v_informacoes);
	break;
	
	case 83:
	
	// valida dados
	if(v_dados == false){
		
		// atualiza a pagina
		location.reload();
		
	};
	
	// atualiza as variaveis globais
	v_variaveis_javascript['deslogar_modo'] = v_objeto["modo"];
	
	break;
	
	case 84:
	$("#" + elemento_id).html("");
	break;

	case 85:
	$("#" + elemento_id).html("");
	break;
	
	case 86:
	$("#" + elemento_id).html("");
	break;	
	
	case 87:
	$("#" + elemento_id).html("");
	break;	
	
	case 88:
	// limpa chats antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	// oculta a barra de progresso gif
	oculta_exibe_elemento_idcampo(array_valores[0], null);
	break;
	
	case 89:
	// limpa dados antigos
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;
	
	case 92:
	$("#" + elemento_id).html("");
	break;

	case 93:
	$("#" + elemento_id).html("");
	break;

	case 94:
	
	$("#" + elemento_id).html("");

	// aloca os dados de conteudo de url
	aloca_dados_conteudo_url(v_dados, id, array_valores[1]);
	
	// oculta a barra de progresso
	exibe_elemento_oculto(array_valores[2], null);
	
	// exibe o botao de publicacao
	exibe_elemento_oculto(array_valores[3], 0);
	
	// retorno nulo
	return null;
	
	break;
	
	case 96:
	
	// remove o conteudo de url
	remove_elemento_id(array_valores[1]);

	break;
	
	case 97:
	
	// valida dados de retorno
	if(parseInt(v_dados) == 1){
		
		// atualiza a pagina
		location.reload();
		
		// retorno nulo
		return null;
		
	};
	
	case 98:
	
	// retorno nulo
	return null;
	
	break;
	
	case 101:
	$("#" + elemento_id).html("");
	break;
	
    case 102:
	$("#" + elemento_id).html("");
	
	// atualiza a pagina
	if(v_dados == 1){
		location.reload();
		return false;
	};
	break;
	
	case 103:
	$("#" + elemento_id).html("");
	break;

	case 104:
	// exibe a barra de progresso gif
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;

	case 105:
	
	// atualiza a pagina
	if(v_dados == 1){
		location.reload();
		return false;
	};
	
	break;
	
	case 106:
	// atualiza a pagina
	if(v_dados == 1){
		location.reload();
		return false;
	};
	break;
	
	case 107:
	location.reload();
	break;
	
	case 108:
	$("#" + elemento_id).html("");
	exibe_elemento_oculto(array_valores[0], null);
	break;
	
	case 110:
	return null;
	break;
	
	case 111:
	
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
		
		// limpando dados
		$("#" + elemento_id).html("");
		
	};
	
	break;
	
	case 112:
	$("#" + elemento_id).html("");
	break;
	
	case 113:
	
	// valida se a variavel existe
	if(retorne_variavel_existe(array_valores[0]) == true){
		
		// recarrega a pagina
		location.reload();
		
		// retorno nulo
		return null;
	
	};
	
	break;
	
	case 115:
	
	// recarrega a pagina
	location.reload();
	
	// retorno nulo
	return null;
	
	break;
	
	case 116:
	
	// exibe elemento oculto
	exibe_elemento_oculto(array_valores[0], null);
	
	// limpa depoimentos antigos
	if(parseInt(v_objeto["zerou_contador"]) == 1){
		$("#" + elemento_id).html("");
	};
	
	break;
	
	case 117:
	$("#" + elemento_id).html("");
	break;
	
	case 118:
	// recarrega a pagina
	location.reload();
	break;
	
	case 119:
	// recarrega a pagina
	location.reload();
	break;
	
	case 120:
	$("#" + elemento_id).html("");
	break;
	
	case 121:
	
	// exibe elemento oculto
	exibe_elemento_oculto(array_valores[1], null);
	
	// valida limpar dados antigos
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
		
		// limpando dados
		$("#" + elemento_id).html("");
		
	};
	
	break;
	
	case 122:
	// retorno nulo
	return null;
	break;
	
	case 123:
	// exibe elemento oculto
	exibe_elemento_oculto(array_valores[0], null);
	break;
	
	case 125:

	// valida limpar dados antigos
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
		
		// limpando dados
		$("#" + elemento_id).html("");
		
	};

	// atualiza variaveis globais
	v_array_ids_imagens_albuns_abertos[array_valores[2]] = v_objeto["id"];
	
	break;
	
	case 126:
	$("#" + elemento_id).html("");
	break;
	
};

// valida elemento existe
if($('#' + elemento_id).length){
	
	// valida o tipo de acao
	switch(tipo_acao){

		case 14:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";
		break;
		
		case 15:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";
		break;
		
		case 16:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";    
		break;
		
		case 18:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";
		break;
		
		case 19:
		
		// valida o modo mobile
		if(v_modo_mobile == false){
			
			// exibe elemento
			document.getElementById(elemento_id).style.display = "block";
		
		};
		
		break;
		
		case 37:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";    
		break;
		
		case 44:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";    
		break;

		case 48:
		
		// retorna se uma variavel e numerica
		if(retorne_variavel_numerica(v_variaveis_javascript['elementos_ocultos_chat']) == true){
			
			// valida elementos ocultos
			if(parseInt(v_variaveis_javascript['elementos_ocultos_chat']) == 1){
				
				// exibindo elemento oculto
				document.getElementById(elemento_id).style.display = "block";
				
			};
			
		};
	   
		var v_valor = obtem_valor_campo(elemento_id, 1);
		
		// valida dados novos
		if(retorne_variavel_existe(v_dados) == true && v_valor.length > 0 && v_dados != null){

			// move para o bottom para exibir as novas mensagens
			move_scroll_bottom(elemento_id);
			
			// som de sistema
			som_sistema(0, elemento_id);
			
		};
		break;
		
		case 49:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";    
		break;
		
		case 57:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";    
		break;
		
		case 58:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";    
		break;
		
		case 61:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";    
		break;
		
		case 72:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";  
		exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_visualizador_aniversariantes'], null);
		break;	
		
		case 77:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";    
		break;
		
		case 89:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";
		break;

		case 111:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "block";    
		break;
		
		default:
		// exibe elemento
		document.getElementById(elemento_id).style.display = "table";
		
	};

};

// oculta a barra de progresso gif
exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);

// valida elemento id existe
if(retorna_elemento_id_existe(elemento_id) == false){
	
	// retorno nulo
	return null;
	
};

// valida conteudo de div
if(document.getElementById(elemento_id).innerHTML.length == 0){
	
	// aplica os dados
	$("#" + elemento_id).html(v_dados);
	
}else{

	// tipo de acao
    switch(tipo_acao){
	    
		case 8:
        $("#" + elemento_id).prepend(v_dados);
		break;
		
		case 18:
        $("#" + elemento_id).prepend(v_dados);
		break;
		
		default:
		$("#" + elemento_id).append(v_dados);
	
    };

};

});

};

