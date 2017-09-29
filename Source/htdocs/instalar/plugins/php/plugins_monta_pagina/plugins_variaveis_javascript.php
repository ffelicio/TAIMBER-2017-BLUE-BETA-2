<?php

// variaveis javascript
function plugins_variaveis_javascript(){
	
// globals
global $variavel_campo;
global $pasta_host_sistema;

// id de usuario logado
$uid = retorne_idusuario_logado();

// modo
$modo = retorne_campo_formulario_request(6);

// modo mobile
$modo_mobile = retorne_modo_mobile();

// pagina de acoes
$pagina_inicial = PAGINA_INICIAL;
$pagina_acoes = PAGINA_ACOES;

// chave de publicacao
$chave = retorna_seta_chave_publicacao(false);

// id de usuario
$idusuario = retorne_idusuario_request();

// tipo de acao
$tipo_acao = retorne_tipo_acao_pagina();

// id campo de conteudo geral
$idcampo_conteudo = retorna_idcampo_conteudo_geral();

// modo de opcoes de solicitacao de amizade
$modo_opcoes_solicitacao_amizade = retorne_campo_formulario_request(14);

// id de idcampo de progresso geral gif
$idcampo_progresso_gif_geral = retorna_idcampo_progresso_gif_geral();

// id de janela de mensagens de chat
$id_janela_chat_mensagens = retorne_id_janela_chat_mensagens();

// tamanho de nova janela de chat
$tamanho_nova_janela_chat = TAMANHO_NOVA_JANELA_CHAT;

// id de nova janela de chat
$id_nova_janela_chat = retorne_novo_id_janela_chat_mensagens();

// valida modo mobile
if($modo_mobile == false){
	
	// numero maximo de janelas de chat
	$numero_maximo_janelas_chat = NUMERO_MAXIMO_JANELAS_CHAT;

}else{
	
	// numero maximo de janelas de chat
	$numero_maximo_janelas_chat = NUMERO_MAXIMO_JANELAS_CHAT_MOBILE;
	
};

// prefixos de chat
$prefixo_chat[0] = PREFIXO_CHAT_USUARIO_ONLINE_0;
$prefixo_chat[1] = PREFIXO_CHAT_USUARIO_ONLINE_1;
$prefixo_chat[2] = PREFIXO_CHAT_USUARIO_ONLINE_2;
$prefixo_chat[3] = PREFIXO_CHAT_USUARIO_ONLINE_3;
$prefixo_chat[4] = PREFIXO_CHAT_USUARIO_ONLINE_4;
$prefixo_chat[5] = PREFIXO_CHAT_USUARIO_ONLINE_5;
$prefixo_chat[6] = PREFIXO_CHAT_NOVAS_MENSAGENS;
$prefixo_chat[7] = PREFIXO_CHAT_USUARIO_ONLINE_6;

// pasta com sons de sistema
$pasta_sons_sistema = $pasta_host_sistema["pasta_sons_sistema_host"];

// tamanho padrao para desconto de primeira janela de chat
$tamanho_desconto_primeira_janela_chat = TAMANHO_DESCONTO_PRIMEIRA_JANELA_CHAT;

// id de janela com usuarios abertos no chat
$id_janela_usuarios_abertos_chat = retorne_id_janela_usuarios_abertos_chat(1);

// id de campo com numero de usuarios abertos no chat
$id_campo_numero_usuarios_abertos_chat = PREFIXO_CHAT_ABERTOS_NUMERO_6;

// id com lista de usuarios abertos no chat
$id_lista_usuarios_abertos_chat = retorne_id_janela_usuarios_abertos_chat(0);

// id de pagina
$pagina = retorne_idpagina_request();

// hashtag
$hashtag = retorne_hashtag_requeste();

// nome de musica a pesquisar
$musica = retorne_campo_formulario_request(42);

// nome de video a pesquisar
$video = retorne_campo_formulario_request(44);

// id de campo pre visualizar musicas
$idcampo_previsualiza_musicas = retorne_idcampo_previsualiza_musicas_publicacao();

// id de campo pre visualizar videos
$idcampo_previsualiza_videos = retorne_idcampo_previsualiza_videos_publicacao();

// token da pagina
$token_pagina = gera_token_pagina();

// id de campos
$idcampo[0] = retorne_idcampo_textarea_publicar_postagem();

// id de formulario de cadastro
$id_formulario_cadastro = retorne_id_formulario_cadastro();

// id de janela principal de chat
$id_janela_principal_chat = retorne_id_janela_principal_chat();

// modo album
$modo_album = retorne_campo_formulario_request(58);

// titulo de pagina
$titulo_pagina = retorne_titulo_pagina();

// permalink
$permalink = retorna_permalink();

// campos
$campo[0] = "
<script language='javascript'>
var v_marcadores_usuario = [];
var v_usuarios_chat = [];
var v_janelas_chat_id = [];
var v_janelas_chat_posicoes = [];
var v_janelas_chat_uids = [];
var v_array_usuarios_ocultos_chat = [];
var v_array_usuarios_abertos_chat = [];
<!-- separadas -->
var v_variaveis_javascript = [];
v_variaveis_javascript['pcu_0'] = \"$prefixo_chat[0]\";
v_variaveis_javascript['pcu_1'] = \"$prefixo_chat[1]\";
v_variaveis_javascript['pcu_2'] = \"$prefixo_chat[2]\";
v_variaveis_javascript['pcu_3'] = \"$prefixo_chat[3]\";
v_variaveis_javascript['pcu_4'] = \"$prefixo_chat[4]\";
v_variaveis_javascript['pcu_5'] = \"$prefixo_chat[5]\";
v_variaveis_javascript['pcu_6'] = \"$prefixo_chat[6]\";
v_variaveis_javascript['pcu_7'] = \"$prefixo_chat[7]\";
v_variaveis_javascript['pagina_inicial'] = '$pagina_inicial';
v_variaveis_javascript['pagina_acoes'] = '$pagina_acoes';
v_variaveis_javascript['campo_email'] = '$variavel_campo[0]';
v_variaveis_javascript['campo_senha'] = '$variavel_campo[1]';
v_variaveis_javascript['tipo_acao'] = '$variavel_campo[2]';
v_variaveis_javascript['query_parametro'] = null;
v_variaveis_javascript['chave'] = '$chave';
v_variaveis_javascript['$variavel_campo[5]'] = '$idusuario';
v_variaveis_javascript['id_temp_publicacao_excluir'] = null;
v_variaveis_javascript['modo_temp_adicionar_amizade'] = null;
v_variaveis_javascript['nome_pesquisa_amigo_local'] = null;
v_variaveis_javascript['modo_pesquisa_geral'] = null;
v_variaveis_javascript['nome_pesquisa_geral'] = null;
v_variaveis_javascript['comentario_postar'] = null;
v_variaveis_javascript['comentario_idpostar'] = null;
v_variaveis_javascript['campo_numero_comentarios'] = null;
v_variaveis_javascript['campo_comentario_paginacao_atual'] = null;
v_variaveis_javascript['campo_temp_texto_coment_editado'] = null;
v_variaveis_javascript['comentario_idatualizar'] = null;
v_variaveis_javascript['id_post'] = null;
v_variaveis_javascript['tabela_campo'] = null;
v_variaveis_javascript['comentario_usuario_excluir_id'] = null;
v_variaveis_javascript['comentario_usuario_excluir_idusuario'] = null;
v_variaveis_javascript['uidamigo'] = null;
v_variaveis_javascript['modo_opcoes_solicitacao_amizade'] = \"$modo_opcoes_solicitacao_amizade\";
v_variaveis_javascript['campo_carrega_conteudo'] = '$idcampo_conteudo';
v_variaveis_javascript['tipo_acao_pagina'] = $tipo_acao;
v_variaveis_javascript['senha_atual'] = null;
v_variaveis_javascript['nova_senha'] = null;
v_variaveis_javascript['nova_senha_confirma'] = null;
v_variaveis_javascript['opcao_limpar_perfil'] = 1;
v_variaveis_javascript['campo_senha_excluir_conta'] = null;
v_variaveis_javascript['e_mail_campo_add_amizade'] = null;
v_variaveis_javascript['campo_mensagem_falha_add_amizade'] = null;
v_variaveis_javascript['uidamigo_depoimento'] = null;
v_variaveis_javascript['depoimento_escreveu'] = null;
v_variaveis_javascript['modo_carrega_depoimento'] = null;
v_variaveis_javascript['idcampo_paginador_depoimentos'] = null;
v_variaveis_javascript['modo_carrega_depoimento_limpa'] = null;
v_variaveis_javascript['id_depoimento_excluir'] = null;
v_variaveis_javascript['modo_aceita_exclui_depoimento'] = null;
v_variaveis_javascript['idcampo_depoimento_usuario'] = null;
v_variaveis_javascript['idcampo_visualizador_depoimentos'] = null;
v_variaveis_javascript['termo_pesquisa_marcador'] = null;
v_variaveis_javascript['idcampo_balao_notifica_marcador'] = null;
v_variaveis_javascript['idusuario_marcar'] = null;
v_variaveis_javascript['chave_marcar_usuario'] = null;
v_variaveis_javascript['marcar_usuario_modo'] = null;
v_variaveis_javascript['marcacoes_concluidas_modo'] = null;
v_variaveis_javascript['id_campo_pesquisa_usuarios_marcados'] = null;
v_variaveis_javascript['id_campo_progresso_gif_geral'] = \"$idcampo_progresso_gif_geral\";
v_variaveis_javascript['id_publicacao_campo_marcar'] = null;
v_variaveis_javascript['tabela_campo_marcar'] = null;
v_variaveis_javascript['mensagem_enviar_usuario'] = null;
v_variaveis_javascript['uidamigo_envia_mensagem'] = null;
v_variaveis_javascript['termo_pesquisa_mensagem'] = null;
v_variaveis_javascript['id_mensagem_excluir'] = null;
v_variaveis_javascript['zera_contador_mensagens'] = 1;
v_variaveis_javascript['zera_contador_mensagens_chat'] = [];
v_variaveis_javascript['uidamigo_mensagem_abrir'] = null;
v_variaveis_javascript['modo_mensagens'] = 0;
v_variaveis_javascript['ultimo_uidamigo_mensagem'] = null;
v_variaveis_javascript['modo_excluir_mensagem'] = null;
v_variaveis_javascript['uidamigo_exclui_mensagem'] = null;
v_variaveis_javascript['id_campo_entrada_insere_emoticon'] = null;
v_variaveis_javascript['id_janela_chat_mensagens'] = \"$id_janela_chat_mensagens\";
v_variaveis_javascript['contador_nova_janela_chat'] = 0;
v_variaveis_javascript['tamanho_nova_janela_chat'] = $tamanho_nova_janela_chat;
v_variaveis_javascript['id_nova_janela_chat'] = \"$id_nova_janela_chat\";
v_variaveis_javascript['uid_usuario_novo_chat'] = null;
v_variaveis_javascript['numero_maximo_janelas_chat'] = $numero_maximo_janelas_chat;
v_variaveis_javascript['uidamigo_conversa_chat_temp'] = null;
v_variaveis_javascript['pasta_sons_sistema'] = \"$pasta_sons_sistema\";
v_variaveis_javascript['tamanho_desconto_primeira_janela_chat'] = $tamanho_desconto_primeira_janela_chat;
v_variaveis_javascript['id_janela_usuarios_abertos_chat'] = \"$id_janela_usuarios_abertos_chat\";
v_variaveis_javascript['contador_abrir_janela_chat'] = 1;
v_variaveis_javascript['uid_usuario_fecha_chat'] = null;
v_variaveis_javascript['id_campo_numero_usuarios_abertos_chat'] = \"$id_campo_numero_usuarios_abertos_chat\";
v_variaveis_javascript['contador_lista_janelas_chat_abertos'] = 0;
v_variaveis_javascript['id_lista_usuarios_abertos_chat'] = \"$id_lista_usuarios_abertos_chat\";
v_variaveis_javascript['id_pagina_visualizando'] = \"$pagina\";
v_variaveis_javascript['zera_contador_avanco_exibir_inscritos_pagina'] = 0;
v_variaveis_javascript['modo_visualiza_paginas_usuario'] = null;
v_variaveis_javascript['id_campo_progresso_gif_visualizar_paginas'] = null;
v_variaveis_javascript['modo_visualiza_paginas_usuario_paginar'] = null;
v_variaveis_javascript['bkp_ultimo_modo_visualiza_paginas_usuario'] = null;
v_variaveis_javascript['valor_configuracao_pagina'] = null;
v_variaveis_javascript['numero_configuracao_pagina'] = null;
v_variaveis_javascript['id_pagina_salva_configuracao'] = null;
v_variaveis_javascript['id_pagina_excluir'] = null;
v_variaveis_javascript['termo_pesquisa_pagina'] = null;
v_variaveis_javascript['id_notifica_num_comentario'] = null;
v_variaveis_javascript['id_notifica_num_curtida'] = null;
v_variaveis_javascript['id_notifica_num_geral'] = null;
v_variaveis_javascript['id_notifica_num_mensagens'] = null;
v_variaveis_javascript['id_notifica_num_depoimentos'] = null;
v_variaveis_javascript['id_notifica_num_amizades_add'] = null;
v_variaveis_javascript['id_notifica_num_marcacoes'] = null;
v_variaveis_javascript['campo_cadastro_0'] = null;
v_variaveis_javascript['campo_cadastro_1'] = null;
v_variaveis_javascript['campo_cadastro_2'] = null;
v_variaveis_javascript['campo_cadastro_3'] = null;
v_variaveis_javascript['campo_cadastro_4'] = null;
v_variaveis_javascript['campo_cadastro_5'] = null;
v_variaveis_javascript['campo_cadastro_6'] = null;
v_variaveis_javascript['campo_cadastro_7'] = null;
v_variaveis_javascript['conteudo_atualiza_publicacao'] = null;
v_variaveis_javascript['id_campo_progresso_gif_visualizador_aniversariantes'] = null;
v_variaveis_javascript['zera_contador_aniversariantes'] = null;
v_variaveis_javascript['id_post_compartilha'] = null;
v_variaveis_javascript['hashtag'] = \"$hashtag\";
v_variaveis_javascript['uid_musicas_usuario'] = null;
v_variaveis_javascript['id_campo_progresso_musicas_usuario'] = null;
v_variaveis_javascript['musica_pesquisa'] = \"$musica\";
v_variaveis_javascript['id_campo_progresso_pesquisa_musicas'] = null;
v_variaveis_javascript['id_campo_pesquisa_musicas_informacoes'] = null;
v_variaveis_javascript['id_musica_excluir'] = null;
v_variaveis_javascript['id_video_excluir'] = null;
v_variaveis_javascript['video_pesquisa'] = \"$video\";
v_variaveis_javascript['id_campo_progresso_pesquisa_videos'] = null;
v_variaveis_javascript['id_campo_pesquisa_videos_informacoes'] = null;
v_variaveis_javascript['uid_videos_usuario'] = null;
v_variaveis_javascript['id_campo_progresso_videos_usuario'] = null;
v_variaveis_javascript['idcampo_previsualiza_musicas'] = \"$idcampo_previsualiza_musicas\";
v_variaveis_javascript['idcampo_previsualiza_videos'] = \"$idcampo_previsualiza_videos\";
v_variaveis_javascript['zera_contador_amigos_online'] = null;
v_variaveis_javascript['nome_pesquisa_amigo_local_chat'] = null;
v_variaveis_javascript['token_pagina'] = \"$token_pagina\";
v_variaveis_javascript['id_campo_textarea_publicar'] = \"$idcampo[0]\";
v_variaveis_javascript['modo_mobile'] = \"$modo_mobile\";
v_variaveis_javascript['elementos_ocultos_chat'] = null;
v_variaveis_javascript['deslogar_modo'] = 1;
v_variaveis_javascript['id_notifica_num_amizdeaceitos_acc'] = null;
v_variaveis_javascript['chat_minimizado'] = 1;
v_variaveis_javascript['id_formulario_cadastro'] = \"$id_formulario_cadastro\";
v_variaveis_javascript['cidade_pesquisa_geral'] = null;
v_variaveis_javascript['id_janela_principal_chat'] = \"$id_janela_principal_chat\";
v_variaveis_javascript['posicao_atual_cursor_emoticon'] = null;
v_variaveis_javascript['modo_pesquisa_pagina'] = \"$modo\";
v_variaveis_javascript['parametro_pesquisa_amigos'] = null;
v_variaveis_javascript['modo_album'] = \"$modo_album\";
v_variaveis_javascript['titulo_pagina'] = \"$titulo_pagina\";
v_variaveis_javascript['permalink'] = \"$permalink\";
</script>
";

// campos
$campo[1] = "
<script language='javascript'>
var v_array_conteudo_url = [];
var v_array_conteudo_url_imagens = [];
var v_array_ids_imagens_albuns = [];
var v_array_ids_imagens_albuns_abertos = [];
</script>
";

// html
$html = "
$campo[0]
$campo[1]
";

// retorno
return $html;

};

?>