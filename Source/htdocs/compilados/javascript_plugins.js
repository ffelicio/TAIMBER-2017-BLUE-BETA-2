
function abrir_aba(idcampo_1, idcampo_2, classe_1, array_ids){
for(i = 0; i <= array_ids.length; i++){
	var v_id = array_ids[i];
	if(retorna_elemento_id_existe(v_id) == true){
		var aba_1 = $("#" + v_id).css('display').toLowerCase();
		var aba_2 = $("#" + idcampo_1).css('display').toLowerCase();
		if(idcampo_1 == v_id){
			if(aba_1 != "table" && aba_2 != "table"){
				oculta_exibe_elemento_idcampo(v_id, 0);
			};
		}else{
			oculta_exibe_elemento_idcampo(v_id, null);			
		};
	};
};
seta_elementos_classe(classe_1, "classe_cor_4", "classe_cor_32");
$("#" + idcampo_2).addClass("classe_cor_4");
};

function executador_acao(array_valores, tipo_acao, id){
tipo_acao = parseInt(tipo_acao);
var v_uid = v_variaveis_javascript["uid"];
var v_pagina = v_variaveis_javascript["id_pagina_visualizando"];
var elemento_id = id;
var v_token_pagina = v_variaveis_javascript['token_pagina'];
var v_modo_mobile = v_variaveis_javascript['modo_mobile'];
var v_permalink = v_variaveis_javascript['permalink'];
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
	if(v_permalink.length == 0){
		var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
		exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
	}else{
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
	if(v_permalink.length == 0){
		var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
		exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
	}else{
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
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
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
if(query_parametro == null){
    var query_parametro = $.param({token_pagina:v_token_pagina, uid:v_uid, pagina:v_pagina, tipo_acao:tipo_acao, dataType:"json"});
};
$.post(v_variaveis_javascript["pagina_acoes"], query_parametro, function(retorno){
var v_objeto = jQuery.parseJSON(retorno);
if(retorne_variavel_existe(v_objeto) == false){
	return null;
};
exibir_campos_ocultos();
var v_dados = v_objeto["dados"];
var v_chave = v_objeto["chave"];
switch(tipo_acao){
    case 1:
	oculta_exibe_elemento_idcampo(array_valores[2], 0);
	oculta_exibe_elemento_idcampo(array_valores[3], 0);
	$("#" + elemento_id).html("");
	if(v_dados == -1){
		$("#" + v_variaveis_javascript['id_formulario_cadastro']).html("");
		oculta_exibe_elemento_idcampo(array_valores[4], null);
		location.reload();
		return false;
	}else{
		exibe_dialogo(array_valores[5]);
		oculta_exibe_elemento_idcampo(array_valores[6], 0);
	};
	break;
	case 2:
	if(v_dados == -1){
		location.reload();
		return false;
	};
	$("#" + elemento_id).html("");
	exibe_elemento_oculto(v_variaveis_javascript['campo_cadastro_7'], null);
	exibe_elemento_oculto(v_variaveis_javascript['campo_cadastro_6'], 0);
	break;
	case 7:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	case 8:
	if(retorna_elemento_id_existe("id_campo_numero_publicacoes") == true){
		document.getElementById("id_campo_numero_publicacoes").innerHTML = v_objeto["linhas"];
	};
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
	document.getElementById("id_div_numero_imagens_visualizador_imagens_album_perfil").innerHTML = v_objeto["linhas"];
	break;
	case 12:
	if(retorna_elemento_id_existe("id_campo_numero_publicacoes") == true){
		document.getElementById("id_campo_numero_publicacoes").innerHTML = v_objeto["linhas"];
	};
	break;
	case 13:
	if(parseInt(v_dados) == -1){
		document.getElementById(v_variaveis_javascript["campo_mensagem_falha_add_amizade"]).innerHTML = v_objeto["mensagem_retorno"];
        return null;
	}else{
	    location.reload();
	};
	break;
	case 14:
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
	    $("#" + elemento_id).html("");
	};
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	case 15:
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;
	case 16:
	exibe_elemento_oculto(array_valores[0], null);
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;
	case 18:
	if(retorne_variavel_existe(v_objeto["numero_comentarios"]) == true && retorne_variavel_existe(v_objeto["numero_comentarios_2"]) == true){
		document.getElementById(v_variaveis_javascript["campo_numero_comentarios"]).innerHTML = v_objeto["numero_comentarios"];
		if(retorna_elemento_id_existe(array_valores[0]) == true){
			document.getElementById(array_valores[0]).innerHTML = v_objeto["numero_comentarios_2"];
		};
	};
	break;
	case 19:
	exibe_elemento_oculto(array_valores[0], null);
	document.getElementById(v_variaveis_javascript["campo_comentario_paginacao_atual"]).innerHTML = v_objeto["linhas_faltam"];
	if(v_objeto["linhas"] == 0){
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
	oculta_exibe_elemento_idcampo(array_valores[0], 0);
	break;
	case 34:
	$("#" + elemento_id).html("");
	break;
	case 35:
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	oculta_exibe_elemento_idcampo(array_valores[0], 0);
	break;
	case 36:
	remove_elemento_id(elemento_id);
	if(parseInt(v_objeto["deletou"]) == -1){
	remove_elemento_id(v_variaveis_javascript["idcampo_depoimento_usuario"]);
	};
	elemento_id = v_variaveis_javascript["idcampo_visualizador_depoimentos"];
	$("#" + elemento_id).html("");
	break;
	case 37:
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
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
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
    exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;
	case 58:
    exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_visualizar_paginas'], null);
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	break;
	case 60:
	$("#" + elemento_id).html("");
	break;
	case 61:
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
	aloca_atualizacoes_notifica(v_dados, array_valores);
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
	if(parseInt(v_objeto["linhas"]) != 0){
		exibe_dialogo(array_valores[0]);
	};
	return null;
	break;
	case 75:
	$("#" + elemento_id).html("");
	break;
	case 77:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_musicas_usuario'], null);
	break;
	case 78:
	var v_informacoes = v_objeto["informacoes"];
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	exibe_elemento_oculto(array_valores[0], null);
	case 79:
	if(v_id != null){
		location.reload();
	};
	break;
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_pesquisa_musicas'], null)
	$("#" + v_variaveis_javascript['id_campo_pesquisa_musicas_informacoes']).html(v_informacoes);
	break;
	case 81:
	location.reload();
	break;
	case 82:
	var v_informacoes = v_objeto["informacoes"];
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_pesquisa_videos'], null)
	$("#" + v_variaveis_javascript['id_campo_pesquisa_videos_informacoes']).html(v_informacoes);
	break;
	case 83:
	if(v_dados == false){
		location.reload();
	};
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
	if(parseInt(v_objeto["zerou_contador"]) == 1){
	    $("#" + elemento_id).html("");
	};
	oculta_exibe_elemento_idcampo(array_valores[0], null);
	break;
	case 89:
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
	aloca_dados_conteudo_url(v_dados, id, array_valores[1]);
	exibe_elemento_oculto(array_valores[2], null);
	exibe_elemento_oculto(array_valores[3], 0);
	return null;
	break;
	case 96:
	remove_elemento_id(array_valores[1]);
	break;
	case 97:
	if(parseInt(v_dados) == 1){
		location.reload();
		return null;
	};
	case 98:
	return null;
	break;
	case 101:
	$("#" + elemento_id).html("");
	break;
    case 102:
	$("#" + elemento_id).html("");
	if(v_dados == 1){
		location.reload();
		return false;
	};
	break;
	case 103:
	$("#" + elemento_id).html("");
	break;
	case 104:
	exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
	break;
	case 105:
	if(v_dados == 1){
		location.reload();
		return false;
	};
	break;
	case 106:
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
		$("#" + elemento_id).html("");
	};
	break;
	case 112:
	$("#" + elemento_id).html("");
	break;
	case 113:
	if(retorne_variavel_existe(array_valores[0]) == true){
		location.reload();
		return null;
	};
	break;
	case 115:
	location.reload();
	return null;
	break;
	case 116:
	exibe_elemento_oculto(array_valores[0], null);
	if(parseInt(v_objeto["zerou_contador"]) == 1){
		$("#" + elemento_id).html("");
	};
	break;
	case 117:
	$("#" + elemento_id).html("");
	break;
	case 118:
	location.reload();
	break;
	case 119:
	location.reload();
	break;
	case 120:
	$("#" + elemento_id).html("");
	break;
	case 121:
	exibe_elemento_oculto(array_valores[1], null);
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
		$("#" + elemento_id).html("");
	};
	break;
	case 122:
	return null;
	break;
	case 123:
	exibe_elemento_oculto(array_valores[0], null);
	break;
	case 125:
	if(parseInt(v_objeto["limpar_dados_antigos"]) == 1){
		$("#" + elemento_id).html("");
	};
	v_array_ids_imagens_albuns_abertos[array_valores[2]] = v_objeto["id"];
	break;
	case 126:
	$("#" + elemento_id).html("");
	break;
};
if($('#' + elemento_id).length){
	switch(tipo_acao){
		case 14:
		document.getElementById(elemento_id).style.display = "block";
		break;
		case 15:
		document.getElementById(elemento_id).style.display = "block";
		break;
		case 16:
		document.getElementById(elemento_id).style.display = "block";    
		break;
		case 18:
		document.getElementById(elemento_id).style.display = "block";
		break;
		case 19:
		if(v_modo_mobile == false){
			document.getElementById(elemento_id).style.display = "block";
		};
		break;
		case 37:
		document.getElementById(elemento_id).style.display = "block";    
		break;
		case 44:
		document.getElementById(elemento_id).style.display = "block";    
		break;
		case 48:
		if(retorne_variavel_numerica(v_variaveis_javascript['elementos_ocultos_chat']) == true){
			if(parseInt(v_variaveis_javascript['elementos_ocultos_chat']) == 1){
				document.getElementById(elemento_id).style.display = "block";
			};
		};
		var v_valor = obtem_valor_campo(elemento_id, 1);
		if(retorne_variavel_existe(v_dados) == true && v_valor.length > 0 && v_dados != null){
			move_scroll_bottom(elemento_id);
			som_sistema(0, elemento_id);
		};
		break;
		case 49:
		document.getElementById(elemento_id).style.display = "block";    
		break;
		case 57:
		document.getElementById(elemento_id).style.display = "block";    
		break;
		case 58:
		document.getElementById(elemento_id).style.display = "block";    
		break;
		case 61:
		document.getElementById(elemento_id).style.display = "block";    
		break;
		case 72:
		document.getElementById(elemento_id).style.display = "block";  
		exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_visualizador_aniversariantes'], null);
		break;	
		case 77:
		document.getElementById(elemento_id).style.display = "block";    
		break;
		case 89:
		document.getElementById(elemento_id).style.display = "block";
		break;
		case 111:
		document.getElementById(elemento_id).style.display = "block";    
		break;
		default:
		document.getElementById(elemento_id).style.display = "table";
	};
};
exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], null);
if(retorna_elemento_id_existe(elemento_id) == false){
	return null;
};
if(document.getElementById(elemento_id).innerHTML.length == 0){
	$("#" + elemento_id).html(v_dados);
}else{
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

function exibir_campos_ocultos(){
var v_idcampo = "id_div_campo_publicacao_usuario";
if(retorna_elemento_id_existe(v_idcampo) == true){
	document.getElementById(v_idcampo).style.display = "table";
};
};

function atualizar_descricao_imagem_album(idcampo_1, id, chave){
var array_valores = [];
array_valores[0] = obtem_valor_campo(idcampo_1, 1);
array_valores[1] = id;
array_valores[2] = chave;
executador_acao(array_valores, 98, null);
};

function carregar_visualizador_imagens_album(idcampo_1){
executador_acao(null, 7, idcampo_1);
};

function excluir_imagem_album(idcampo_1, id, idcampo_2){
var array_valores = [];
remove_elemento_id(idcampo_2);
remove_elemento_id(idcampo_1);
array_valores[0] = id;
executador_acao(array_valores, 11, null);
};

function paginar_slide_album(id, modo, idcampo_1, uid){
var array_valores = [];
array_valores[0] = id;
array_valores[1] = modo;
array_valores[2] = idcampo_1;
array_valores[3] = uid;
v_array_ids_imagens_albuns[idcampo_1] = idcampo_1;
executador_acao(array_valores, 125, idcampo_1);
};

function paginar_slide_album_teclado(idcampo_1, uid, tecla){
if(retorne_conteudo_editavel_mantem_foco() == true){
	return null;
};
var v_modo = -1;
if(v_variaveis_javascript['modo_mobile'] == 1){
	if(tecla == 37){
		var v_modo = 0;
	};
	if(tecla == 39){
		var v_modo = 1;	
	};
}else{
	if(tecla == 37 || tecla == 40){
		var v_modo = 0;
	};
	if(tecla == 39 || tecla == 38){
		var v_modo = 1;	
	};	
};
if(v_modo == -1){
	return null;
};
var id = v_array_ids_imagens_albuns_abertos[idcampo_1];
paginar_slide_album(id, v_modo, idcampo_1, uid);
};

function restaurar_imagem_album_dados(id, idcampo_1){
var array_valores = [];
if(retorne_variavel_existe((v_array_ids_imagens_albuns[idcampo_1])) == false){
	return null;
}else{
	delete(v_array_ids_imagens_albuns[idcampo_1]);
};
array_valores[0] = id;
array_valores[1] = idcampo_1;
v_array_ids_imagens_albuns_abertos[idcampo_1] = id;
executador_acao(array_valores, 126, idcampo_1);
};

function alterar_senha(campo_mensagem, senha_atual, nova_senha, nova_senha_confirma){
var v_senha_atual = document.getElementById(senha_atual).value;
var v_nova_senha = document.getElementById(nova_senha).value;
var v_nova_senha_confirma = document.getElementById(nova_senha_confirma).value;
if(v_senha_atual.length == 0){
    document.getElementById(senha_atual).focus()
	return null;
};
if(v_nova_senha.length == 0){
    document.getElementById(nova_senha).focus()
	return null;
};
if(v_nova_senha_confirma.length == 0){
    document.getElementById(nova_senha_confirma).focus()
	return null;
};
v_variaveis_javascript['senha_atual'] = v_senha_atual;
v_variaveis_javascript['nova_senha'] = v_nova_senha;
v_variaveis_javascript['nova_senha_confirma'] = v_nova_senha_confirma;
v_variaveis_javascript['campo_carrega_conteudo'] = campo_mensagem;
document.getElementById(senha_atual).value = "";
document.getElementById(nova_senha).value = "";
document.getElementById(nova_senha_confirma).value = "";
document.getElementById(campo_mensagem).innerHTML = "";
executador_acao(null, 30, campo_mensagem);
};

function adicionar_amizade(uidamigo, idcampo_email, idcampo_mensagem, id, modo){
v_variaveis_javascript['modo_temp_adicionar_amizade'] = modo;
if($("#" + idcampo_email).length > 0){
    v_variaveis_javascript['e_mail_campo_add_amizade'] = document.getElementById(idcampo_email).value;
};
v_variaveis_javascript['uidamigo'] = uidamigo;
v_variaveis_javascript['campo_mensagem_falha_add_amizade'] = idcampo_mensagem
executador_acao(null, 13, id);
};

function alterar_modo_opcoes_solicitacao(idcampo, id_campo_conteudo){
v_variaveis_javascript['modo_opcoes_solicitacao_amizade'] = document.getElementById(idcampo).value;
v_variaveis_javascript['campo_carrega_conteudo'] = id_campo_conteudo;
executador_acao(null, 26, id_campo_conteudo);
};

function altera_parametro_pesquisa_amigos(conteudo, idcampo_1){
seta_valor_campo(idcampo_1, null, 0);
v_variaveis_javascript['parametro_pesquisa_amigos'] = parseInt(conteudo);
};

function atualizar_numero_amigos_online(idcampo_1){
executador_acao(null, 87, idcampo_1);
};

function carregar_visualizador_amigos(id_visualizador){
var array_valores = [];
v_variaveis_javascript['nome_pesquisa_amigo_local'] = obtem_valor_campo("id_campo_pesquisa_amigos_local", 0);
array_valores[0] = v_variaveis_javascript['parametro_pesquisa_amigos'];
oculta_exibe_elemento_idcampo("id_campo_progresso_gif_paginar_publicacoes", 0);
executador_acao(array_valores, 14, id_visualizador);
};

function carrega_solicitacoes_amizade(id){
v_variaveis_javascript['campo_carrega_conteudo'] = id;
exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
executador_acao(null, 25, id);
};
function exibir_amigos_online(idcampo_1, idcampo_2, zerar_contador){
v_variaveis_javascript['zera_contador_amigos_online'] = parseInt(zerar_contador);
oculta_exibe_elemento_idcampo(idcampo_2, 0);
var array_valores = [];
array_valores[0] = idcampo_2;
executador_acao(array_valores, 88, idcampo_1);
};

function visualizar_todas_amizades_inicial(id_visualizador){
altera_parametro_pesquisa_amigos(null, "id_campo_pesquisa_amigos_local");
document.getElementById("id_campo_pesquisa_amigos_local").value = "";
$("#" + id_visualizador).html("");
v_variaveis_javascript['nome_pesquisa_amigo_local'] = "";
executador_acao(null, 15, id_visualizador);
document.getElementById("id_campo_pesquisa_amigos_local").focus();
};

function carregar_aniversariantes(idcampo_1, idcampo_2, zera_contador){
var array_valores = [];
exibe_elemento_oculto(idcampo_2, 0);
v_variaveis_javascript['id_campo_progresso_gif_visualizador_aniversariantes'] = idcampo_2;
v_variaveis_javascript['zera_contador_aniversariantes'] = zera_contador;
array_valores[0] = parseInt(zera_contador);
executador_acao(array_valores, 72, idcampo_1);
};

function bloquear_usuario(uid){
executador_acao(null, 24, uid)
};

function carrega_usuarios_bloqueados(id_campo_conteudo){
v_variaveis_javascript['campo_carrega_conteudo'] = id_campo_conteudo;
exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
executador_acao(null, v_variaveis_javascript['tipo_acao_pagina'], id_campo_conteudo);
};

function desbloquear_usuario(uid){
executador_acao(null, 28, uid)
};

function excluir_capa(pagina){
var array_valores = [];
if(retorne_variavel_existe(pagina) == true){
	array_valores[0] = parseInt(pagina);
}else{
	array_valores[0] = null;		
};
executador_acao(array_valores, 67, null);
};

function reposicionar_capa(modo, idcampo_1){
var array_valores = [];
array_valores[0] = modo;
array_valores[1] = idcampo_1;
array_valores[2] = $("#" + idcampo_1).height();;
executador_acao(array_valores, 128, idcampo_1);
};

function aloca_atualizacoes_chat(dados, mensagens){
var v_contador = 0;
aloca_mensagens_chat(mensagens);
for(v_contador == v_contador; v_contador <= dados.length; v_contador++){
	if(retorne_variavel_existe(dados[v_contador]) == true){
		var v_uid = dados[v_contador][0];
		var v_online = dados[v_contador][1];
		var v_numero_online = dados[v_contador][2];
		if(retorne_variavel_existe(v_uid) == true){
			var v_idcampos = [];
			v_idcampos[0] = v_variaveis_javascript['pcu_0'] + v_uid;
			v_idcampos[1] = v_variaveis_javascript['pcu_5'] + v_uid;
			v_idcampos[2] = v_variaveis_javascript['pcu_4'];
			v_idcampos[3] = v_variaveis_javascript['pcu_7'];
			if(retorna_elemento_id_existe(v_idcampos[0]) == true){
				document.getElementById(v_idcampos[0]).innerHTML = v_online;
			};
			if(retorna_elemento_id_existe(v_idcampos[1]) == true){
				document.getElementById(v_idcampos[1]).innerHTML = v_online;
			};
			if(retorna_elemento_id_existe(v_idcampos[2]) == true){
				document.getElementById(v_idcampos[2]).innerHTML = v_numero_online;
			};
			if(retorna_elemento_id_existe(v_idcampos[3]) == true){
				document.getElementById(v_idcampos[3]).innerHTML = v_numero_online;
			};
		};
	};
};
};

function aloca_mensagens_chat(dados){
var v_contador = 0;
for(v_contador == v_contador; v_contador <= dados.length; v_contador++){
	if(retorne_variavel_existe(dados[v_contador]) == true){
		var v_uid = dados[v_contador][0];
		var v_numero_mensagens = dados[v_contador][1];
		var v_numero_novas_mensagens = dados[v_contador][2];
		var v_numero_conversando = dados[v_contador][3];
		if(retorne_variavel_existe(v_uid) == true){
			var v_idcampos = [];
			v_idcampos[0] = v_variaveis_javascript['pcu_2'] + v_uid;
			v_idcampos[1] = v_variaveis_javascript['pcu_6'] + v_uid;
			v_idcampos[2] = v_variaveis_javascript['id_campo_numero_usuarios_abertos_chat'];
			if(retorna_elemento_id_existe(v_idcampos[0]) == true){
				carregar_mensagens_usuario_chat(v_uid, v_idcampos[0]);
			};
			if(v_numero_mensagens == 0){
				if(retorna_elemento_id_existe(v_idcampos[0]) == true){
					seta_valor_campo(v_idcampos[0], null, 1);
				};
			};
			if(retorna_elemento_id_existe(v_idcampos[1]) == true){
				document.getElementById(v_idcampos[1]).innerHTML = v_numero_novas_mensagens;
			};
			if(retorna_elemento_id_existe(v_idcampos[2]) == true){
				document.getElementById(v_idcampos[2]).innerHTML = v_numero_conversando;
			};
			ocultar_janela_usuarios_abertos(v_numero_conversando);
		};
	};
};
};

function atualizador_chat_usuario(){
executador_acao(null, 47, null);
};

function carregar_mensagens_usuario_chat(v_uid, idcampo_1){
v_variaveis_javascript['uidamigo_conversa_chat_temp'] = v_uid;
if(retorne_variavel_existe(v_variaveis_javascript['zera_contador_mensagens_chat'][v_uid]) == false){
    v_variaveis_javascript['zera_contador_mensagens_chat'][v_uid] = 1;
};
executador_acao(null, 48, idcampo_1);
v_variaveis_javascript['zera_contador_mensagens_chat'][v_uid] = 0;
};

function constroe_janela_chat(uid, modo, idcampo_1){
var v_modo_mobile = parseInt(v_variaveis_javascript['modo_mobile']);
if(v_modo_mobile == 1){
	oculta_exibe_elemento_idcampo(v_variaveis_javascript['id_janela_chat_principal'], null);
	oculta_exibe_elemento_idcampo(v_variaveis_javascript['id_janela_principal_chat'], null);
};
if(modo == 1){
	for(i = 0; i <= v_array_usuarios_ocultos_chat.length; i++){
	    if(v_array_usuarios_ocultos_chat[i] != null){
		    if(retorne_elemento_array_existe(v_array_usuarios_abertos_chat, uid) == true){
			    return null;
		    };
			exibe_elemento_oculto(v_array_usuarios_ocultos_chat[i], 0);
		};
	};
	exibe_elemento_oculto(idcampo_1, null);
	v_array_usuarios_ocultos_chat[v_variaveis_javascript['contador_lista_janelas_chat_abertos']] = idcampo_1;
	v_array_usuarios_abertos_chat[v_variaveis_javascript['contador_lista_janelas_chat_abertos']] = uid;
	v_variaveis_javascript['contador_lista_janelas_chat_abertos']++;
	if(v_variaveis_javascript['contador_lista_janelas_chat_abertos'] >= v_variaveis_javascript['numero_maximo_janelas_chat']){
		v_variaveis_javascript['contador_lista_janelas_chat_abertos'] = 0;
	};
};
if(retorne_elemento_array_existe(v_usuarios_chat, uid) == false && modo == 0){
	v_usuarios_chat[uid] = uid;
}else{
    if(modo == 0){
        return null;
    };
};
v_variaveis_javascript['uid_usuario_novo_chat'] = uid;
if(modo == 0){
    executador_acao(null, 49, v_variaveis_javascript['id_janela_usuarios_abertos_chat']);
};
if(v_variaveis_javascript['contador_nova_janela_chat'] >= v_variaveis_javascript['numero_maximo_janelas_chat'] && modo == 0){
	return null;
};
var v_html = obtem_valor_campo(v_variaveis_javascript['id_janela_chat_mensagens'], 1);
v_variaveis_javascript['contador_nova_janela_chat']++;
if(v_modo_mobile == 1){
	v_direita = 0;
}else{
	v_direita = (v_variaveis_javascript['tamanho_nova_janela_chat'] * v_variaveis_javascript['contador_nova_janela_chat']) + v_variaveis_javascript['tamanho_desconto_primeira_janela_chat'];
};
if(modo == 0){
	v_janelas_chat_posicoes[v_variaveis_javascript['contador_nova_janela_chat']] = v_direita;
	v_janelas_chat_uids[v_variaveis_javascript['contador_nova_janela_chat']] = uid;
};
var v_nova_id = v_variaveis_javascript['id_nova_janela_chat'] + uid;
if(modo == 1){
	if(v_variaveis_javascript['contador_abrir_janela_chat'] > v_variaveis_javascript['numero_maximo_janelas_chat']){
		v_variaveis_javascript['contador_abrir_janela_chat'] = 1;
	};
	var v_nova_posicao = v_janelas_chat_posicoes[v_variaveis_javascript['contador_abrir_janela_chat']];
	var v_uidamigo = v_janelas_chat_uids[v_variaveis_javascript['contador_abrir_janela_chat']];
	var v_nova_id = v_variaveis_javascript['id_nova_janela_chat'] + v_uidamigo;
    remove_elemento_id(v_nova_id);	
	v_direita = v_nova_posicao;
	v_variaveis_javascript['contador_abrir_janela_chat']++;
};
v_html = "<div class='classe_janela_troca_mensagens classe_chat_cor_1' id='" + v_nova_id + "'>" + v_html + "</div>";
$("body").after(v_html);
$("#" + v_nova_id).css({right: v_direita, display: 'table'});
v_janelas_chat_id[uid] = v_nova_id;
if(retorna_elemento_id_existe(v_nova_id) == false){
	location.reload();
	return null;
};
executador_acao(null, 46, v_nova_id);
};

function fechar_janela_chat(uid, idcampo_1){
var v_modo_mobile = parseInt(v_variaveis_javascript['modo_mobile']);
if(v_modo_mobile == 1){
	oculta_exibe_elemento_idcampo(v_variaveis_javascript['id_janela_chat_principal'], 0);
	oculta_exibe_elemento_idcampo(v_variaveis_javascript['id_janela_principal_chat'], 0);
};
var id_janela = v_janelas_chat_id[uid];
if(retorna_elemento_id_existe(id_janela) == false){
	return null;
};
delete v_array_usuarios_abertos_chat[v_array_usuarios_abertos_chat.indexOf(uid)];
delete v_usuarios_chat[v_usuarios_chat.indexOf(uid)];
v_variaveis_javascript['uid_usuario_fecha_chat'] = uid;
executador_acao(null, 50, null);
remove_elemento_id(id_janela);
remove_elemento_id(idcampo_1);
v_variaveis_javascript['contador_nova_janela_chat']--;
v_usuarios_chat[uid] = null;
};

function minimizar_chat_usuario(idcampo_1, idcampo_2){
if(v_variaveis_javascript['chat_minimizado'] == 0){
	v_variaveis_javascript['chat_minimizado'] = 1;
	exibe_elemento_oculto(idcampo_1, 2);
	exibe_elemento_oculto(idcampo_2, 3);
}else{
	v_variaveis_javascript['chat_minimizado'] = 0;
	exibe_elemento_oculto(idcampo_1, 3);
	exibe_elemento_oculto(idcampo_2, 2);
};
};

function ocultar_elementos_chat_digitar(modo, idcampo_1){
v_variaveis_javascript['elementos_ocultos_chat'] = modo;
switch(parseInt(modo)){
	case 0:
	oculta_exibe_elemento_idcampo(idcampo_1, null);
	break;
	case 1:
	oculta_exibe_elemento_idcampo(idcampo_1, 1);
	break;
};
};

function ocultar_janela_usuarios_abertos(v_numero_conversando){
if(v_numero_conversando > v_variaveis_javascript['numero_maximo_janelas_chat']){
    exibe_elemento_oculto(v_variaveis_javascript['id_lista_usuarios_abertos_chat'], 0);	
};
if(v_numero_conversando == 0){
	exibe_elemento_oculto(v_variaveis_javascript['id_lista_usuarios_abertos_chat'], null);
};
};

function paginar_amigos_chat(idcampo_2){
executador_acao(null, 89, idcampo_2);
};

function pesquisar_amigos_chat(idcampo_1, idcampo_2){
if(idcampo_1 != null){
	v_variaveis_javascript['nome_pesquisa_amigo_local_chat'] = obtem_valor_campo(idcampo_1, 0);
	if(v_variaveis_javascript['nome_pesquisa_amigo_local_chat'].length == 0){
		$("#" + idcampo_2).html("");
		executador_acao(null, 91, null);
	};
};
executador_acao(null, 89, idcampo_2);
};

function carregar_comentarios(tipo_campo, idpost, idcampo_1, idcampo_2, idcampo_3){
var array_valores = [];
exibe_elemento_oculto(idcampo_3, 0);
document.getElementById(idcampo_2).style.display = "block";
v_variaveis_javascript['campo_comentario_paginacao_atual'] = idcampo_2;
v_variaveis_javascript['tabela_campo'] = tipo_campo;
v_variaveis_javascript['comentario_idpostar'] = idpost;
array_valores[0] = idcampo_3;
executador_acao(array_valores, 19, idcampo_1);
};

function excluir_comentario(id, uid, id_comentario_usuario, id_dialogo_excluir, tabela_comentario, id_post){
v_variaveis_javascript['comentario_usuario_excluir_id'] = id;
v_variaveis_javascript['comentario_usuario_excluir_idusuario'] = uid;
v_variaveis_javascript['tabela_campo'] = tabela_comentario;
v_variaveis_javascript['id_post'] = id_post;
executador_acao(null, 21, id_comentario_usuario);
exibe_dialogo(id_dialogo_excluir);
};

function exibir_responder_comentario(idcampo_1, idcampo_2){
exibe_elemento_oculto(idcampo_1, null);
exibe_elemento_oculto(idcampo_2, 0)
};

function postar_comentario(id_campo_entrada_comentario, id_visualizador_comentarios, tipo_campo, idpost, id_campo_numero_comentarios, id_campo_paginar_comentarios, idusuario, idcampo_1){
var v_comentario = obtem_valor_campo(id_campo_entrada_comentario, 1);
if(v_comentario.length == 0){
    document.getElementById(id_campo_entrada_comentario).focus();
	return null;
};
v_variaveis_javascript['comentario_postar'] = v_comentario;
v_variaveis_javascript['tabela_campo'] = tipo_campo;
v_variaveis_javascript['comentario_idpostar'] = idpost;
v_variaveis_javascript['campo_numero_comentarios'] = id_campo_numero_comentarios;
v_variaveis_javascript['uidamigo'] = idusuario;
seta_valor_campo(id_campo_entrada_comentario, null, 2);
document.getElementById(id_campo_entrada_comentario).focus();
carregar_comentarios(tipo_campo, idpost, id_visualizador_comentarios, id_campo_paginar_comentarios);
var array_valores = [];
array_valores[0] = idcampo_1;
executador_acao(array_valores, 18, id_visualizador_comentarios);
};

function salvar_comentario_editado(id_campo_entrada, id_comentario, id_campo_texto_comentario, id_dialogo_editar){
var v_comentario = obtem_valor_campo(id_campo_entrada, 1);
if(v_comentario.length == 0){
    document.getElementById(id_campo_entrada).focus();
	return null;
};
v_variaveis_javascript['campo_temp_texto_coment_editado'] = v_comentario;
v_variaveis_javascript['comentario_idatualizar'] = id_comentario;
executador_acao(null, 20, id_campo_texto_comentario);
exibe_dialogo(id_dialogo_editar);
};

function compartilhar(idcampo_1, id, idcampo_2, idcampo_3, idcampo_4){
v_variaveis_javascript['id_post_compartilha'] = id;
var array_valores = [];
array_valores[0] = idcampo_2;
array_valores[1] = idcampo_3;
executador_acao(array_valores, 73, idcampo_1);
};

function atualizar_email(idcampo_1, idcampo_2){
var array_valores = [];
array_valores[0] = obtem_valor_campo(idcampo_1, 0);
if(array_valores[0].length == 0){
	document.getElementById(idcampo_1).focus();
	return null;
};
executador_acao(array_valores, 103, idcampo_2);
};

function adicionar_conteudo_url(idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5){
var array_valores = [];
var v_url = obtem_valor_campo(idcampo_1, 0);
array_valores[0] = v_url;
array_valores[1] = idcampo_3;
array_valores[2] = idcampo_4;
array_valores[3] = idcampo_5;
exibe_elemento_oculto(idcampo_4, 0);
executador_acao(array_valores, 94, idcampo_2);
};

function aloca_dados_conteudo_url(dados, idcampo_1, idcampo_2){
v_array_conteudo_url[0] = dados;
v_array_conteudo_url[1] = idcampo_1;
v_array_conteudo_url[2] = idcampo_2;
if(v_array_conteudo_url.length == 0){
	return null;
};
dados = v_array_conteudo_url[0];
idcampo_1 = v_array_conteudo_url[1];
$("#" + idcampo_1).html(dados["conteudo"]);
};

function excluir_imagem_conteudo_url(idcampo_1, contador){
v_array_conteudo_url_imagens[contador] = null;
remove_elemento_id(idcampo_1);
};

function exclui_conteudo_url(chave, idcampo_1){
var array_valores = [];
array_valores[0] = chave;
array_valores[1] = idcampo_1;
executador_acao(array_valores, 96, null);
};

function publicar_conteudo_url(idcampo_1, idcampo_2, idcampo_3){
var v_idcampo_1 = v_variaveis_javascript['id_campo_textarea_publicar'];
var v_imagens = null;
dados = v_array_conteudo_url[0];
for(i = 0; i <= v_array_conteudo_url_imagens.length; i++){
	var v_url_imagem = v_array_conteudo_url_imagens[i];
	if(v_url_imagem != null){
		v_imagens += v_url_imagem + "," + "\n";
	};
};
var array_valores = [];
var v_titulo = dados["titulo"];
var v_descricao = dados["descricao"];
array_valores[0] = v_titulo;
array_valores[1] = v_descricao;
array_valores[2] = v_imagens;
array_valores[3] = dados["url"];
executador_acao(array_valores, 95, v_array_conteudo_url[2]);
seta_valor_campo(idcampo_1, null, 0);
exibe_elemento_oculto(idcampo_2, null);
seta_valor_campo(idcampo_3, null, 1);
};

function curtir(tipo_campo, id, id_elemento, idusuario){
v_variaveis_javascript['id_post'] = id;
v_variaveis_javascript['tabela_campo'] = tipo_campo;
v_variaveis_javascript['uidamigo'] = idusuario;
executador_acao(null, 23, id_elemento);
};

function carregar_depoimentos(idcampo_1, idcampo_2, idcampo_3, modo, limpar_antigos, idcampo_4){
if(modo == 3){
	modo = v_variaveis_javascript['modo_carrega_depoimento'];
}else{
	v_variaveis_javascript['modo_carrega_depoimento'] = modo;
};
v_variaveis_javascript['modo_carrega_depoimento'] = modo;
v_variaveis_javascript['idcampo_paginador_depoimentos'] = idcampo_2;
v_variaveis_javascript['modo_carrega_depoimento_limpa'] = limpar_antigos;
v_variaveis_javascript['idcampo_visualizador_depoimentos'] = idcampo_3;
if(modo == null || limpar_antigos == 1){
    document.getElementById(idcampo_1).innerHTML = "";
};
oculta_exibe_elemento_idcampo(idcampo_4, 0);
var array_valores = [];
array_valores[0] = idcampo_4;
executador_acao(array_valores, 35, idcampo_1);
document.getElementById(idcampo_2).style.display = "block";
};

function escrever_depoimento(idcampo_1, idcampo_2, uidamigo){
var v_depoimento = obtem_valor_campo(idcampo_1, 1);
v_variaveis_javascript['depoimento_escreveu'] = v_depoimento;
v_variaveis_javascript['uidamigo_depoimento'] = uidamigo;
seta_valor_campo(idcampo_1, null, 2);
document.getElementById(idcampo_1).focus();
document.getElementById(idcampo_2).innerHTML = "";
if(v_depoimento.length == 0 || uidamigo.length == 0){
	return null;
};
executador_acao(null, 34, idcampo_2);
};

function excluir_aceitar_depoimento(id, idcampo_1, idcampo_2, modo){
v_variaveis_javascript['id_depoimento_excluir'] = id;
v_variaveis_javascript['modo_aceita_exclui_depoimento'] = modo;
v_variaveis_javascript['idcampo_depoimento_usuario'] = idcampo_2;
executador_acao(null, 36, idcampo_1);
};

function exibe_dialogo(identificador){
if(retorna_elemento_id_existe(identificador) == false){
    return null;
};
if(document.getElementById(identificador).style.display == "none" || document.getElementById(identificador).style.display.length == 0){
	ocultar_elementos_classe("div_janela_mensagem_dialogo_acao");
    document.getElementById(identificador).style.display = "block";
	exibe_scrool_pagina(false); 
}else{
    document.getElementById(identificador).style.display = "none"
	if(retorne_classes_abertas_fechar_dialogo() == false){
		exibe_scrool_pagina(true);
	};
};
};

function exibe_menu_acao(menu_id, element){
ocultar_elementos_classe("classe_div_menu_suspense");
ocultar_elementos_classe("div_janela_mensagem_dialogo_acao");
var v_posicao = $(element).position();
var x = element.offsetTop + 3;
var y = element.offsetLeft;
var v_elemento = document.getElementById(menu_id);
v_elemento.style.display = "table";
v_elemento.style.position = "absolute";
v_elemento.style.left = y + "px";
v_elemento.style.top = x + "px";
};

function retorne_classes_abertas_fechar_dialogo(){
if(retorne_classe_oculta("classe_div_menu_suspense") == false){
	return true;
};
if(retorne_classe_oculta("div_janela_principal_mensagem_dialogo") == false){
	return true;
};
if(retorne_classe_oculta("classe_div_visualizador_album") == false){
	return true;
};
if(retorne_classe_oculta("div_janela_mensagem_dialogo_acao") == false){
	return true;
};
if(retorne_classe_oculta("div_janela_principal_mensagem_dialogo_grande") == false){
	return true;
};
return false;
};

function adicionar_emoticon_campo(url, idcampo_1){
var v_posicao = v_variaveis_javascript['posicao_atual_cursor_emoticon'];
var v_html = "<img src='" + url + "'>";
$("#" + idcampo_1).append(v_html);
};

function atualiza_posicao_cursor_emoticon(idcampo_1){
v_variaveis_javascript['posicao_atual_cursor_emoticon'] = obter_posicao_cursor(idcampo_1, true);
};

function carregar_emoticons(idcampo_1, idcampo_2){
var array_valores = [];
v_variaveis_javascript['id_campo_entrada_insere_emoticon'] = idcampo_2;
executador_acao(null, 44, idcampo_1);
};

function excluir_conta_usuario(id_campo_senha, id_campo_mensagem, idcampo_1){
v_variaveis_javascript['campo_senha_excluir_conta'] = document.getElementById(id_campo_senha).value;
document.getElementById(id_campo_senha).value = null;
document.getElementById(id_campo_senha).focus();
oculta_exibe_elemento_idcampo(idcampo_1, null);
var array_valores = [];
array_valores[0] = idcampo_1;
executador_acao(array_valores, 32, id_campo_mensagem);	
};

function excluir_feed_usuario(idpublicacao, identificador_publicacao){
v_variaveis_javascript['id_temp_publicacao_excluir'] = idpublicacao;
executador_acao(null, 110, identificador_publicacao);
remove_elemento_id(identificador_publicacao);
};

function exibe_itens_frase_efeito(idcampo_1, idcampo_2){
if(retorne_elemento_visivel(idcampo_2) == true){
	return null;
};
oculta_exibe_elemento_idcampo(idcampo_1, 0);
oculta_exibe_elemento_idcampo(idcampo_2, 0);
};

function oculta_itens_frase_efeito(idcampo_1, idcampo_2){
oculta_exibe_elemento_idcampo(idcampo_1, 0);
oculta_exibe_elemento_idcampo(idcampo_2, 0);
};

function salvar_frase_efeito(idcampo_1, idcampo_2, idcampo_3){
var array_valores = [];
array_valores[0] = obtem_valor_campo(idcampo_1, 0);
oculta_exibe_elemento_idcampo(idcampo_2, 0);
oculta_exibe_elemento_idcampo(idcampo_3, null);
executador_acao(array_valores, 66, null);
};

function adiciona_classe_elemento(idcampo_1, classe){
$('#' + idcampo_1).addClass(classe);
};

function atualiza_modo_deslogar(event){
v_variaveis_javascript['deslogar_modo'] = event.pageX;
};

$(document).keyup(function(e){
	v_variaveis_javascript['deslogar_modo'] += 1; 
});

function auto_ajustar_campo_textarea(o){
o.style.height = "1px";
o.style.height = (2+o.scrollHeight)+"px";
};

function encurtar_texto(idcampo_1, idcampo_2, idcampo_3, modo){
if(modo == true){
	oculta_exibe_elemento_idcampo(idcampo_1, null);
	oculta_exibe_elemento_idcampo(idcampo_2, 0);
	oculta_exibe_elemento_idcampo(idcampo_3, 0);
}else{
	oculta_exibe_elemento_idcampo(idcampo_1, 0);
	oculta_exibe_elemento_idcampo(idcampo_2, null);
	oculta_exibe_elemento_idcampo(idcampo_3, 0);
};
};

function exibe_elemento_oculto(idcampo_1, modo){
if(retorna_elemento_id_existe(idcampo_1) == false){
    return null;	
};
var v_valor = $("#" + idcampo_1).css('display');
if(v_valor.toLowerCase() == "none"){
    switch(modo){
	    case 0:
	    document.getElementById(idcampo_1).style.display = "table";
	    break;
	    case 1:
	    document.getElementById(idcampo_1).style.display = "block";
	    break;
		case 2:
		$("#" + idcampo_1).show();
		break;
		case 3:
		$("#" + idcampo_1).hide();
		break;
		default:
        document.getElementById(idcampo_1).style.display = "none";
    };	
}else{
    if(modo == null){
        document.getElementById(idcampo_1).style.display = "none";
    };
};
if(modo == 3){
	if(v_valor.toLowerCase() == "none"){
		document.getElementById(idcampo_1).style.display = "table";
	}else{
		document.getElementById(idcampo_1).style.display = "none";
	};
};
};

function exibe_scrool_pagina(modo){
if(modo == true){
	$("body").css("overflow-y", "scroll");	
	$("body").css("overflow-x", "hidden");
}else{
	$("body").css("overflow", "hidden");	
};
};

function inserir_texto_campo_entrada(idcampo_1, texto){
var txtarea = document.getElementById(idcampo_1);
if(!txtarea){ return; }
var scrollPos = txtarea.scrollTop;
var strPos = 0;
var br =((txtarea.selectionStart || txtarea.selectionStart == '0') ? "ff" :(document.selection ? "ie" : false));
if(br == "ie"){
	txtarea.focus();
	var range = document.selection.createRange();
	range.moveStart('character', -txtarea.value.length);
	strPos = range.texto.length;
}else if(br == "ff"){
	strPos = txtarea.selectionStart;
}
var front =(txtarea.value).substring(0, strPos);
var back =(txtarea.value).substring(strPos, txtarea.value.length);
txtarea.value = front + texto + back;
strPos = strPos + texto.length;
if(br == "ie"){
	txtarea.focus();
	var ieRange = document.selection.createRange();
	ieRange.moveStart('character', -txtarea.value.length);
	ieRange.moveStart('character', strPos);
	ieRange.moveEnd('character', 0);
	ieRange.select();
}else if(br == "ff"){
	txtarea.selectionStart = strPos;
	txtarea.selectionEnd = strPos;
	txtarea.focus();
}
txtarea.scrollTop = scrollPos;
};

function mover_foco_elemento(idcampo_1){
document.getElementById(idcampo_1).focus();
};

function move_scroll_bottom(idcampo_1){
$("#" + idcampo_1).animate({ scrollTop: $("#" + idcampo_1)[0].scrollHeight}, 1000);
};

function obtem_valor_campo(idcampo_1, modo){
if(retorna_elemento_id_existe(idcampo_1) == false){
	return null;
};
switch(parseInt(modo)){
	case 0: // campo de entrada comum, text, password
	return document.getElementById(idcampo_1).value;
	break;
	case 1: // codigo html de elemento
	return document.getElementById(idcampo_1).innerHTML;
	break;
	case 2: // obtem elemento checado
	return document.getElementById(idcampo_1).checked;
	break;
	case 3: // obtem elemento de div
	return $("#" + idcampo_1).text();
	break;
};
};

function obter_posicao_cursor(idcampo_1, modo){
if(modo == true){
	return $("#" + idcampo_1).prop("selectionStart");
}else{
	return $("#" + idcampo_1).prop("selectionEnd");
};
};

$(document).keyup(function(e){
    if(e.keyCode == 27){
		ocultar_elementos_classe("classe_div_menu_suspense");
		ocultar_elementos_classe("div_janela_mensagem_dialogo_acao");
		ocultar_elementos_classe("div_janela_principal_mensagem_dialogo");
   		ocultar_elementos_classe("classe_div_visualizador_album");
		ocultar_elementos_classe("div_janela_principal_mensagem_dialogo_grande");
		ocultar_elementos_classe("div_janela_principal_mensagem_dialogo_medio");
		exibe_scrool_pagina(true);
	};
});
function ocultar_elementos_classe(classe_elemento){
var elements = document.getElementsByClassName(classe_elemento);
    for(var i = 0; i < elements.length; i++){
        elements[i].style.display = "none";
    };
};

function oculta_exibe_elemento_idcampo(idcampo_1, modo){
if(retorna_elemento_id_existe(idcampo_1) == false){
    return null;	
};
var v_valor = $("#" + idcampo_1).css('display');
if(v_valor.toLowerCase() == "none"){
    switch(modo){
	    case 0:
	    document.getElementById(idcampo_1).style.display = "table";
	    break;
	    case 1:
	    document.getElementById(idcampo_1).style.display = "block";
	    break;
		case 2:
		$("#" + idcampo_1).show();
		break;
    };	
}else{
    document.getElementById(idcampo_1).style.display = "none";
};
};

function opacidade_elemento(idcampo_1, modo){
switch(modo){
	case 0:
	document.getElementById(idcampo_1).style.opacity = "1";
	break;
	case 1:
	document.getElementById(idcampo_1).style.opacity = "0";
	break;
};
};

function remove_elemento_id(elemento_id){
exibe_scrool_pagina(true);
$('#' + elemento_id).remove();
};

function retorne_classe_oculta(classe_elemento){
var elements = document.getElementsByClassName(classe_elemento);
for(var i = 0; i < elements.length; i++){
	if(elements[i].style.display.length > 0){
		if(elements[i].style.display != "none"){
			return false;
		};
	};
};
return true;
};

function retorna_elemento_id_existe(id_elemento){
if($("#" + id_elemento).length == 0) {
    return false;
}else{
    return true;
};
};

function retorne_conteudo_editavel_mantem_foco(){
var contenteditable = document.querySelector('[contenteditable]'), text = contenteditable.textContent;
if(text.length > 0){
	return true;
}else{
	return false;
};
};

function retorne_elemento_array_existe(array_elementos, elemento){
if(array_elementos.indexOf(elemento) > -1){
	return true;
}else{
	return false;
};
};

function retorne_elemento_focus(id_elemento){
if(retorna_elemento_id_existe(id_elemento) == false){
	return false;
};
if($("#" + id_elemento).is(":focus")) {
	return true;
}else{
	return false;
};
};
function retorne_elemento_visivel(idcampo_1){
var v_valor = $("#" + idcampo_1).css('display');
if(retorna_elemento_id_existe(idcampo_1) == false){
    return false;	
};
return v_valor.toLowerCase() == "none";
};

function retorne_variavel_existe(v_variavel){
if(typeof v_variavel === 'undefined'){
    return false;
}else{
	return true;
};
};

function retorne_variavel_numerica(variavel){
var eNaN = Number.isNaN(variavel);
return eNaN;
};

function seta_elementos_classe(classe_1, classe_2, classe_3){
var elements = document.getElementsByClassName(classe_1);
for(var i = 0; i < elements.length; i++){
    var idcampo_1 = $(elements[i]).attr("id");
	$("#" + idcampo_1).removeClass(classe_2);
	$("#" + idcampo_1).removeClass(classe_3);
};
};

function seta_valor_campo(idcampo_1, valor, modo){
switch(modo){
	case 0: // campo de entrada comum, text, password
	document.getElementById(idcampo_1).value = valor;
	break;
	case 1: // codigo html de elemento
	$("#" + idcampo_1).html(valor);
	break;
	case 2:
	$("#" + idcampo_1).empty();
	break;
};
};

function atualiza_numero_hashtag(idcampo_1, hashtag){
executador_acao(null, 75, idcampo_1);
};

function alterar_idioma(modo){
var array_valores = [];
array_valores[0] = parseInt(modo);
executador_acao(array_valores, 107, null);
};

function exibe_info_link(modo, uid, idcampo_1, idcampo_2, ponto){
exibe_menu_acao(idcampo_1, ponto);
var array_valores = [];
array_valores[0] = modo;
array_valores[1] = uid;
executador_acao(array_valores, 93, idcampo_2);
};

function alterar_modo_limpar_perfil(idcampo){
v_variaveis_javascript['opcao_limpar_perfil'] = document.getElementById(idcampo).value;
};

function limpar_perfil(){
executador_acao(null, 31, null);
};

function obtem_geolocalizacao(){
if(navigator.geolocation){
	navigator.geolocation.getCurrentPosition(retorna_geolocalizacao);
};
};

function retorna_geolocalizacao(position){
var array_valores = [];
array_valores["latitude"] = position.coords.latitude;
array_valores["longitude"] = position.coords.longitude;
executador_acao(array_valores, 122, null);
};

function exibir_amigos_marcados(chave, idcampo_1){
v_variaveis_javascript["chave_marcar_usuario"] = chave;
executador_acao(null, 40, idcampo_1);
};

function limpar_marcadores(){
exibe_elemento_oculto(v_variaveis_javascript['idcampo_balao_notifica_marcador'], null);
};

function marcacoes_concluidas(chave, identificador, modo){
document.getElementById(v_variaveis_javascript['id_campo_pesquisa_usuarios_marcados']).innerHTML = null;
v_variaveis_javascript['marcacoes_concluidas_modo'] = modo;
exibe_dialogo(identificador);
executador_acao(null, 39, v_variaveis_javascript['idcampo_balao_notifica_marcador']);
};

function marcar_usuario(uidamigo, chave, modo, idcampo_1){
v_variaveis_javascript['idusuario_marcar'] = uidamigo;
v_variaveis_javascript['chave_marcar_usuario'] = chave;
v_variaveis_javascript['marcar_usuario_modo'] = modo;
executador_acao(null, 38, idcampo_1);
};

function pesquisar_marcador(idcampo_entrada, idcampo_resultados, idcampo_balao, chave, id, tabela_campo){
if(id.length == 0){
    id = -1;	
};
v_variaveis_javascript['termo_pesquisa_marcador'] = document.getElementById(idcampo_entrada).value;
v_variaveis_javascript['idcampo_balao_notifica_marcador'] = idcampo_balao;
v_marcadores_usuario[idcampo_resultados] = chave;
v_variaveis_javascript['id_campo_pesquisa_usuarios_marcados'] = idcampo_resultados;
v_variaveis_javascript['id_publicacao_campo_marcar'] = id;
v_variaveis_javascript['tabela_campo_marcar'] = tabela_campo;
if(v_variaveis_javascript['termo_pesquisa_marcador'].length == 0){
    return null;
};
executador_acao(null, 37, idcampo_resultados);
};

function carregar_amigos_mensageiro(idcampo_1, idcampo_2){
var array_valores = [];
array_valores[0] = obtem_valor_campo(idcampo_2, 0);
executador_acao(array_valores, 111, idcampo_1);
};

function constroe_campos_troca_mensagens_mensageiro(uid, idcampo_1){
var array_valores = [];
array_valores[0] = parseInt(uid);
executador_acao(array_valores, 112, idcampo_1);
};

function resetar_amigos_mensageiro(){
var array_valores = [];
array_valores[0] = v_variaveis_javascript['chave'];
executador_acao(array_valores, 113, null);
};

function carregar_mensagens_usuario(idcampo_1, idcampo_2, uidamigo){
exibe_elemento_oculto(idcampo_1, 0);
if(v_variaveis_javascript['ultimo_uidamigo_mensagem'] != uidamigo && v_variaveis_javascript['uidamigo_mensagem_abrir'] != -1){
    v_variaveis_javascript['ultimo_uidamigo_mensagem'] = uidamigo;
	v_variaveis_javascript['zera_contador_mensagens'] = 1;
}else{
	v_variaveis_javascript['zera_contador_mensagens'] = 0;
};
if(uidamigo == null){
    v_variaveis_javascript['campo_carrega_conteudo'] = idcampo_2;
    v_variaveis_javascript['zera_contador_mensagens'] = 0;
    v_variaveis_javascript['uidamigo_mensagem_abrir'] = null;
    v_variaveis_javascript['modo_mensagens'] = 0;
}else{
    v_variaveis_javascript['modo_mensagens'] = 1;
    v_variaveis_javascript['uidamigo_mensagem_abrir'] = uidamigo;
};
var array_valores = [];
array_valores[0] = idcampo_1;
executador_acao(array_valores, 42, v_variaveis_javascript['campo_carrega_conteudo']);
};

function enviar_mensagem_usuario(tecla_pressionada, uid, idcampo_1, id_dialogo_1, id_dialogo_2){
if(tecla_pressionada == 27){
	fechar_janela_chat(uid, idcampo_1);
	return null;
};
if(tecla_pressionada != 13){
	return null;	
};
v_variaveis_javascript['mensagem_enviar_usuario'] = obtem_valor_campo(idcampo_1, 1);
v_variaveis_javascript['uidamigo_envia_mensagem'] = uid;
if(v_variaveis_javascript['mensagem_enviar_usuario'].length == 0){
    document.getElementById(idcampo_1).focus();
    return null;	
};
executador_acao(null, 41, null);
if(retorna_elemento_id_existe(id_dialogo_1) == true && retorna_elemento_id_existe(id_dialogo_2) == true){
    exibe_dialogo(id_dialogo_1);
    exibe_dialogo(id_dialogo_2);
};
seta_valor_campo(idcampo_1, null, 2);
document.getElementById(idcampo_1).focus();
};

function excluir_mensagem_usuario(id, idcampo_1, uidamigo, modo){
if(modo == true){
    v_variaveis_javascript['modo_excluir_mensagem'] = 1;
}else{
	v_variaveis_javascript['modo_excluir_mensagem'] = 2;
};
remove_elemento_id(idcampo_1);
v_variaveis_javascript['id_mensagem_excluir'] = id;
v_variaveis_javascript['uidamigo_exclui_mensagem'] = uidamigo;
executador_acao(null, 43, null);
};

function paginar_mensagens(idcampo_1, idcampo_2){
carregar_mensagens_usuario(idcampo_1, idcampo_2, v_variaveis_javascript['uidamigo_mensagem_abrir']);
};
function pesquisar_troca_mensagem(idcampo_1, idcampo_2){
v_variaveis_javascript['termo_pesquisa_mensagem'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['zera_contador_mensagens'] = 1;
v_variaveis_javascript['modo_mensagens'] = 1;
v_variaveis_javascript['uidamigo_mensagem_abrir'] = -1;
executador_acao(null, 42, idcampo_2);
};
function abrir_menu_suspense(modo_topo, menu_id, element, modo){
ocultar_elementos_classe("classe_div_menu_suspense");
ocultar_elementos_classe("div_janela_mensagem_dialogo_acao");
var v_posicao = $(element).position();
if(modo == true){
	var x = element.offsetTop - 5;
	var y = element.offsetLeft + 0;	
}else{
	var x = element.offsetTop - 5;
	var y = element.offsetLeft - 193;
};
if(modo_topo == true){
	var x = element.offsetTop - 225;	
};
var v_elemento = document.getElementById(menu_id);
v_elemento.style.display = "table";
v_elemento.style.position = "absolute";
v_elemento.style.left = y + "px";
v_elemento.style.top = x + "px";
};

function fechar_menu_suspense(menu_id){
exibe_scrool_pagina(true);
document.getElementById(menu_id).style.display = "none";
};

function define_modo_mobile(){
var array_valores = [];
array_valores[0] = v_variaveis_javascript['chave'];
executador_acao(array_valores, 106, null)
};

function detecta_resolucao(){
var largura = window.screen.availWidth;
var array_valores = [];
array_valores[0] = largura;
executador_acao(array_valores, 97, null);
};

function carregar_musicas_usuario(uid, idcampo_1, idcampo_2){
v_variaveis_javascript['uid_musicas_usuario'] = uid;
v_variaveis_javascript['id_campo_progresso_musicas_usuario'] = idcampo_2;
exibe_elemento_oculto(idcampo_2, 0);
executador_acao(null, 77, idcampo_1)
};

function excluir_musica_usuario(id, idcampo_1, idcampo_2){
v_variaveis_javascript['id_musica_excluir'] = id;
remove_elemento_id(idcampo_1);
remove_elemento_id(idcampo_2);
executador_acao(null, 79, idcampo_1);
};

function pesquisar_musicas_usuarios(idcampo_1, idcampo_2, idcampo_3, idcampo_4){
var array_valores = [];
v_variaveis_javascript['musica_pesquisa'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['id_campo_progresso_pesquisa_musicas'] = idcampo_2;
v_variaveis_javascript['id_campo_pesquisa_musicas_informacoes'] = idcampo_4;
array_valores[0] = idcampo_2;
array_valores[1] = v_variaveis_javascript['chave'];
exibe_elemento_oculto(idcampo_2, 0)
executador_acao(array_valores, 78, idcampo_3);
};

function previsualiza_musicas_publicacao(idcampo_1){
executador_acao(null, 84, idcampo_1);
};

function carregar_noticias(idcampo_1, idcampo_2, modo){
exibe_elemento_oculto(idcampo_1, 0);
var array_valores = [];
array_valores[0] = idcampo_1;
array_valores[1] = modo;
executador_acao(array_valores, 108, idcampo_2);
};

function aloca_atualizacoes_notifica(v_dados, array_valores){
if(parseInt(v_dados[0]) == 0){
	exibe_elemento_oculto(v_variaveis_javascript['id_notifica_num_geral'], null);
}else{
	exibe_elemento_oculto(v_variaveis_javascript['id_notifica_num_geral'], 0);	
};
seta_valor_campo(v_variaveis_javascript['id_notifica_num_geral'], v_dados[0], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_curtida'], v_dados[1], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_comentario'], v_dados[2], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_mensagens'], v_dados[3], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_depoimentos'], v_dados[4], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_amizades_add'], v_dados[5], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_marcacoes'], v_dados[6], 1);
seta_valor_campo(v_variaveis_javascript['id_notifica_num_amizdeaceitos_acc'], v_dados[7], 1);
if(parseInt(v_dados[8]) > 0){
	seta_valor_campo(array_valores[0], v_dados[8], 1);
}else{
	seta_valor_campo(array_valores[0], null, 1);
};
altera_titulo_notifica(v_dados[9]);
};

function altera_titulo_notifica(numero_notifica){
numero_notifica = parseInt(numero_notifica);
if(numero_notifica > 0){
	var v_titulo = "(" + numero_notifica + ") - " + v_variaveis_javascript['titulo_pagina'];
}else{
	var v_titulo = v_variaveis_javascript['titulo_pagina'];
};
$('title').html(v_titulo);
};

function atualiza_notifica_timer(idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5, idcampo_6, idcampo_7, idcampo_8, idcampo_9){
var array_valores = [];
v_variaveis_javascript['id_notifica_num_geral'] = idcampo_1;
v_variaveis_javascript['id_notifica_num_comentario'] = idcampo_2;
v_variaveis_javascript['id_notifica_num_curtida'] = idcampo_3;
v_variaveis_javascript['id_notifica_num_mensagens'] = idcampo_4;
v_variaveis_javascript['id_notifica_num_depoimentos'] = idcampo_5;
v_variaveis_javascript['id_notifica_num_amizades_add'] = idcampo_6;
v_variaveis_javascript['id_notifica_num_marcacoes'] = idcampo_7;
v_variaveis_javascript['id_notifica_num_amizdeaceitos_acc'] = idcampo_8;
array_valores[0] = idcampo_9;
executador_acao(array_valores, 64, null);
};

function excluir_imagem_perfil(){
var array_valores = [];
array_valores[0] = 1;
executador_acao(array_valores, 105, null);
};

function carregar_visualizador_pesquisa_geral(idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5, modo){
var v_nome_pesquisa = obtem_valor_campo(idcampo_3, 0);
if(idcampo_4.length > 0){
	var v_modo_pesquisa = obtem_valor_campo(idcampo_4, 0);
}else{
	var v_modo_pesquisa = null;
};
if(idcampo_5.length > 0){
	var v_cidade_pesquisa = obtem_valor_campo(idcampo_5, 0);
}else{
	var v_cidade_pesquisa = null;
};
var array_valores = [];
if(v_variaveis_javascript['nome_pesquisa_geral'] != v_nome_pesquisa || v_variaveis_javascript['modo_pesquisa_geral'] != v_modo_pesquisa || v_variaveis_javascript['cidade_pesquisa_geral'] != v_cidade_pesquisa){
	array_valores["modo_limpa_contador"] = 1;
}else{
	array_valores["modo_limpa_contador"] = 0;
};
v_variaveis_javascript['nome_pesquisa_geral'] = v_nome_pesquisa;
v_variaveis_javascript['modo_pesquisa_geral'] = v_modo_pesquisa;
v_variaveis_javascript['cidade_pesquisa_geral'] = v_cidade_pesquisa;
array_valores[0] = idcampo_2;
array_valores[1] = v_cidade_pesquisa;
array_valores[2] = modo;
exibe_elemento_oculto(idcampo_2, 0);
move_scroll_bottom(idcampo_1);
executador_acao(array_valores, 16, idcampo_1);
};

function exibe_visualizador_pesquisa_geral(classe_1, idcampo_1, modo){
if(modo == true){
	exibe_elemento_oculto(idcampo_1, 0);
}else{
	ocultar_elementos_classe(classe_1);
	exibe_elemento_oculto(idcampo_1, null);
};
};

function remover_plano_fundo_usuario(){
executador_acao(null, 115, null);
};

function carrega_links_medias(idcampo_1, idcampo_2){
var array_valores = [];
array_valores[0] = idcampo_2;
executador_acao(array_valores, 123, idcampo_1);
};

function seta_valor_checkbox_campo_privacidade(icampo_1, idcampo_2){
if(document.getElementById(idcampo_2).checked == true){
    var v_valor = 1;
}else{
    var v_valor = 0;	
};
document.getElementById(icampo_1).value = v_valor; 
};

function atualizar_publicacao(id, idcampo_1, idcampo_2, idcampo_3){
var v_conteudo = obtem_valor_campo(idcampo_2, 1);
if(v_conteudo.length == 0){
	document.getElementById(idcampo_2).focus();
	return null;
};
v_variaveis_javascript['conteudo_atualiza_publicacao'] = v_conteudo;
v_variaveis_javascript['id_post'] = id;
executador_acao(null, 71, idcampo_1);
exibe_dialogo(idcampo_3);
};

function excluir_publicacao_usuario(idpublicacao, identificador_publicacao){
v_variaveis_javascript['id_temp_publicacao_excluir'] = idpublicacao;
executador_acao(null, 12, identificador_publicacao);
remove_elemento_id(identificador_publicacao);
};

function publicar_conteudo(idcampo_0, idcampo_1, idcampo_2, idcampo_3, pagina, idcampo_4, idcampo_5){
var array_valores = [];
array_valores[0] = obtem_valor_campo(idcampo_0, 1);
array_valores[1] = idcampo_0;
document.getElementById(array_valores[1]).focus();
exibe_elemento_oculto(idcampo_2, null);
exibe_elemento_oculto(idcampo_3, 0);
executador_acao(array_valores, 8, idcampo_1);
exibe_elemento_oculto(idcampo_3, null);
limpar_marcadores();
exibe_elemento_oculto(v_variaveis_javascript['idcampo_previsualiza_musicas'], null);
exibe_elemento_oculto(v_variaveis_javascript['idcampo_previsualiza_videos'], null);
seta_valor_campo(idcampo_4, null, 1);
seta_valor_campo(idcampo_5, null, 1);
exibe_elemento_oculto(idcampo_4, null);
seta_valor_campo(idcampo_0, null, 2);
};

function paginar_recomendacoes_usuario(modo, idcampo_1, idcampo_2){
var array_valores = [];
array_valores[0] = modo;
array_valores[1] = idcampo_2;
exibe_elemento_oculto(idcampo_2, 0);
executador_acao(array_valores, 121, idcampo_1);
};

function envia_redefinir_senha(idcampo_1, idcampo_2){
var array_valores = [];
array_valores[0] = obtem_valor_campo(idcampo_1, 0);
if(array_valores[0].length == 0){
	document.getElementById(idcampo_1).focus();
	return null;
};
executador_acao(array_valores, 101, idcampo_2);
};

function nova_senha(chave, idcampo_1, idcampo_2, idcampo_3){
var v_nova_senha = document.getElementById(idcampo_2).value;
var v_nova_senha_confirma = document.getElementById(idcampo_3).value;
if(v_nova_senha.length == 0){
    document.getElementById(idcampo_2).focus()
	return null;
};
if(v_nova_senha_confirma.length == 0){
    document.getElementById(idcampo_3).focus()
	return null;
};
var array_valores = [];
array_valores[0] = v_nova_senha;
array_valores[1] = v_nova_senha_confirma;
array_valores[2] = chave;
document.getElementById(idcampo_2).value = "";
document.getElementById(idcampo_3).value = "";
executador_acao(array_valores, 102, idcampo_1);
};

function aceita_relacionamento(uidamigo, relacao){
var array_valores = [];
array_valores[0] = parseInt(uidamigo);
array_valores[1] = parseInt(relacao);
executador_acao(array_valores, 119, null);
};

function alterar_relacionamento(modo, idcampo_1, idcampo_2){
var array_valores = [];
array_valores[0] = obtem_valor_campo(idcampo_1, 0);
array_valores[1] = parseInt(modo);
executador_acao(array_valores, 117, idcampo_2);
};

function atualiza_notifica_relacionamento(idcampo_1){
executador_acao(null, 120, idcampo_1);
};

function excluir_relacionamento(uidamigo, relacao){
var array_valores = [];
array_valores[0] = parseInt(uidamigo);
array_valores[1] = parseInt(relacao);
executador_acao(array_valores, 118, null);
};

function som_sistema(modo, idcampo_1){
var v_pasta_sons_sistema = v_variaveis_javascript['pasta_sons_sistema'];
switch(modo){
    case 0:
	url_som = v_pasta_sons_sistema + "pling.mp3";
    break;
};
html = "<audio src='" + url_som + "' autoplay>";
$("#" + idcampo_1).append(html);
};

function salvar_url_amigavel_usuario(idcampo_1, idcampo_2, modo){
var array_valores = [];
array_valores[0] = obtem_valor_campo(idcampo_1, 0);
array_valores[1] = parseInt(modo);
executador_acao(array_valores, 92, idcampo_2)
};

function cadastrar_usuario(idcampo_0, idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5, idcampo_6, idcampo_7){
v_variaveis_javascript['campo_cadastro_0'] = obtem_valor_campo(idcampo_0, 0);
v_variaveis_javascript['campo_cadastro_1'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['campo_cadastro_2'] = obtem_valor_campo(idcampo_2, 0);
v_variaveis_javascript['campo_cadastro_3'] = obtem_valor_campo(idcampo_3, 0);
v_variaveis_javascript['campo_cadastro_4'] = obtem_valor_campo(idcampo_4, 0);
v_variaveis_javascript['campo_cadastro_5'] = idcampo_5;
v_variaveis_javascript['campo_cadastro_6'] = idcampo_6;
v_variaveis_javascript['campo_cadastro_7'] = idcampo_7;
if(v_variaveis_javascript['campo_cadastro_0'].length == 0){
	document.getElementById(idcampo_0).focus();
	return null;
};
if(v_variaveis_javascript['campo_cadastro_1'].length == 0){
	document.getElementById(idcampo_1).focus();
	return null;
};
if(v_variaveis_javascript['campo_cadastro_2'].length == 0){
	document.getElementById(idcampo_2).focus();
	return null;
};
if(v_variaveis_javascript['campo_cadastro_3'].length == 0){
	document.getElementById(idcampo_3).focus();
	return null;
};
if(v_variaveis_javascript['campo_cadastro_4'].length == 0){
	document.getElementById(idcampo_4).focus();
	return null;
};
if(v_variaveis_javascript['campo_cadastro_3'] != v_variaveis_javascript['campo_cadastro_4']){
	document.getElementById(idcampo_4).focus();
	return null;	
};
exibe_elemento_oculto(idcampo_6, 0);
exibe_elemento_oculto(idcampo_7, 0);
executador_acao(null, 2, v_variaveis_javascript['campo_cadastro_5']);
};

function logar_usuario(idcampo_1, idcampo_2, idcampo_3, idcampo_4, idcampo_5, idcampo_6, idcampo_7){
var array_valores = [];
array_valores[0] = obtem_valor_campo(idcampo_2, 0);
array_valores[1] = obtem_valor_campo(idcampo_3, 0);
array_valores[2] = idcampo_1;
array_valores[3] = idcampo_5;
array_valores[4] = idcampo_6;
array_valores[5] = idcampo_7;
array_valores[6] = v_variaveis_javascript['id_formulario_cadastro'];
if(array_valores[0].length == 0){
	document.getElementById(idcampo_2).focus();
	return false;
};
if(array_valores[1].length == 0){
	document.getElementById(idcampo_3).focus();
	return false;
};
oculta_exibe_elemento_idcampo(idcampo_1, 0);
oculta_exibe_elemento_idcampo(idcampo_5, 1);
oculta_exibe_elemento_idcampo(array_valores[6], null);
seta_valor_campo(idcampo_3, null, 0);
executador_acao(array_valores, 1, idcampo_4);
};

function carregar_videos_usuario(uid, idcampo_1, idcampo_2){
v_variaveis_javascript['uid_videos_usuario'] = uid;
v_variaveis_javascript['id_campo_progresso_videos_usuario'] = idcampo_2;
exibe_elemento_oculto(idcampo_2, 0);
executador_acao(null, 82, idcampo_1)
};

function excluir_video_usuario(id, idcampo_1, idcampo_2){
v_variaveis_javascript['id_video_excluir'] = id;
remove_elemento_id(idcampo_1);
remove_elemento_id(idcampo_2);
executador_acao(null, 81, idcampo_1);
};

function pesquisar_videos_usuarios(idcampo_1, idcampo_2, idcampo_3, idcampo_4){
var array_valores = [];
v_variaveis_javascript['video_pesquisa'] = obtem_valor_campo(idcampo_1, 0);
v_variaveis_javascript['id_campo_progresso_pesquisa_videos'] = idcampo_2;
v_variaveis_javascript['id_campo_pesquisa_videos_informacoes'] = idcampo_4;
exibe_elemento_oculto(idcampo_2, 0)
array_valores[0] = v_variaveis_javascript['chave'];
executador_acao(array_valores, 82, idcampo_3);
};

function previsualiza_videos_publicacao(idcampo_1){
executador_acao(null, 86, idcampo_1);
};

function carrega_visitas_perfil(id_campo_conteudo){
v_variaveis_javascript['campo_carrega_conteudo'] = id_campo_conteudo;
exibe_elemento_oculto(v_variaveis_javascript['id_campo_progresso_gif_geral'], 0);
executador_acao(null, v_variaveis_javascript['tipo_acao_pagina'], id_campo_conteudo);
};
