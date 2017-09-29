<?php

// define o timezone
date_default_timezone_set("America/Sao_Paulo");

// inicia a sessao
session_start();

// dados do servidor
define("HOST_SERVIDOR", "http://".$_SERVER['SERVER_NAME']);
define("ROOT_SERVIDOR", $_SERVER['DOCUMENT_ROOT']);

// carrega as configurações do kernel
include_once("configuracoes_kernel.php");

// nomes de funções
include_once("nomes_funcoes.php");

// logotipo
define("NOME_SISTEMA", "Taimber");

// logotipo md5
#NOTA: Não altere esta variavel, porque ela trabalha com a senha!
define("LOGOTIPO_MD5", "_nn");

// logotipo md5 de inicio
#NOTA: Esta variavel pode ser alterada!
define("LOGOTIPO_INICIO_MD5", "ssi_");

// paginas do site
define("PAGINA_INICIAL", HOST_SERVIDOR."/");
define("PAGINA_ACOES", HOST_SERVIDOR."/acoes/");
define("PAGINA_INDEX_INICIO", PAGINA_INICIAL);

// constantes de sessao
define("SESSAO_EMAIL", md5("S1"));
define("SESSAO_SENHA", md5("S2"));
define("SESSAO_LOGADO", md5("S3"));
define("SESSAO_IDUSUARIO", md5("S4"));
define("SESSAO_DADOS_USUARIO", md5("S5"));
define("SESSAO_CONTADOR_AVANCO", md5("S6"));
define("SESSAO_CHAVE_PUBLICACAO", md5("S7"));
define("SESSAO_DADOS_USUARIO_LOGADO", md5("S8"));
define("SESSAO_NOME_PESQ_AMIGO_LOCAL", md5("S9"));
define("SESSAO_NOME_PESQ_GERAL", md5("S10"));
define("SESSAO_CONTADOR_AVANCO_COMENTARIOS", md5("S11"));
define("SESSAO_CONTADOR_ITERACAO", md5("S12"));
define("SESSAO_MARCADOR_USUARIO", md5("S13"));
define("SESSAO_MARCADOR_USUARIO_REFERENCIA", md5("S14"));
define("SESSAO_CHAVE_DADOS_USUARIO", md5("S16"));
define("SESSAO_USUARIOS_ABERTOS_CHAT", md5("S17"));
define("SESSAO_UIDAMIGO_TEMP_CHAT", md5("S18"));
define("SESSAO_TERMO_PESQUISA_PAGINA", md5("S19"));
define("SESSAO_MODO_MOBILE", md5("S20"));
define("SESSAO_TERMO_PESQUISA_MUSICA", md5("S21"));
define("SESSAO_PESQUISA_MUSICA_NUMERO_ENCONTROU", md5("S22"));
define("SESSAO_TERMO_PESQUISA_VIDEO", md5("S23"));
define("SESSAO_PESQUISA_VIDEO_NUMERO_ENCONTROU", md5("S24"));
define("SESSAO_MODO_MOBILE_ATIVOU", md5("S25"));
define("SESSAO_TERMO_PESQUISA_AMIGOS", md5("S26"));
define("SESSAO_TOKEN_PAGINA", md5("S27"));
define("SESSAO_ITERACAO_TOKEN_PAGINA", md5("S28"));
define("SESSAO_TERMO_PESQUISA_MARCADOR", md5("S29"));
define("SESSAO_PESQUISA_MARCADOR_NUMERO_ENCONTROU", md5("S30"));
define("SESSAO_RESOLUCAO_DETECTA", md5("S31"));
define("SESSAO_RESOLUCAO_RETORNA", md5("S32"));
define("SESSAO_DESLOGAR_AUTOMATICO", md5("S33"));
define("SESSAO_IDIOMA", md5("S34"));
define("SESSAO_UID_PESQUISA_NOTICIAS_DESLOGADO", md5("S35"));
define("SESSAO_UIDAMIGO_TEMP_MENSAGEIRO", md5("S36"));
define("SESSAO_NOME_PESQ_PAGINA", md5("S37"));
define("SESSAO_MAPA_BING", md5("S38"));
define("SESSAO_CHAVE_ALEATORIA", md5("S39"));

// url da pagina inicial
$pagina_inicial = PAGINA_INICIAL;

// pagina de index de inicio
$pagina_index_inicio = PAGINA_INDEX_INICIO;

// administradores
include_once("administrador.php");

// carrega os idiomas
include_once("idiomas.php");

// palavras improprias
include_once("palavras_improprias.php");

// conexao com banco de dados
define("USUARIO_MYSQL", "root");
define("SENHA_MYSQL", "");
define("SERVIDOR_MYSQL", "localhost");
define("NOME_BANCO_DADOS", "taimber_azul");

// variavel de conexao
$_SESSION["CONEXAO_MYSQLI"] = null;

// define pastas roots
$pasta_root_sistema["instalar"] = ROOT_SERVIDOR."/instalar/";
$pasta_root_sistema["plugins"] = $pasta_root_sistema["instalar"]."plugins/";
$pasta_root_sistema["compilados"] = ROOT_SERVIDOR."/compilados/";
$pasta_root_sistema["arquivos_usuarios"] = ROOT_SERVIDOR."/arquivos_usuarios/";
$pasta_root_sistema["plugins_css"] = $pasta_root_sistema["plugins"]."css/";
$pasta_root_sistema["plugins_css_efeitos"] = $pasta_root_sistema["plugins"]."css_efeitos/";
$pasta_root_sistema["plugins_js"] = $pasta_root_sistema["plugins"]."js/";
$pasta_root_sistema["plugins_php"] = $pasta_root_sistema["plugins"]."php/";
$pasta_root_sistema["pasta_instala_banco"] = $pasta_root_sistema["instalar"]."banco_dados/";
$pasta_root_sistema["pasta_emoticons_root"] = ROOT_SERVIDOR."/imagens_sistema/emoticons/";
$pasta_root_sistema["plugins_paginas"] = $pasta_root_sistema["instalar"]."plugins_paginas/";
$pasta_root_sistema["plugins_paginas_css"] = $pasta_root_sistema["plugins_paginas"]."css/";
$pasta_root_sistema["plugins_paginas_js"] = $pasta_root_sistema["plugins_paginas"]."js/";
$pasta_root_sistema["plugins_paginas_php"] = $pasta_root_sistema["plugins_paginas"]."php/";

// define pastas hosts
$pasta_host_sistema["instalar"] = HOST_SERVIDOR."/instalar/";
$pasta_host_sistema["dependencias"] = HOST_SERVIDOR."/dependencias/";
$pasta_host_sistema["compilados"] = HOST_SERVIDOR."/compilados/";
$pasta_host_sistema["jquery"] = HOST_SERVIDOR."/jquery/";
$pasta_host_sistema["arquivos_usuarios"] = HOST_SERVIDOR."/arquivos_usuarios/";
$pasta_host_sistema["imagens_sistema"] = HOST_SERVIDOR."/imagens_sistema/";
$pasta_host_sistema["pasta_emoticons_host"] = HOST_SERVIDOR."/imagens_sistema/emoticons/";
$pasta_host_sistema["pasta_sons_sistema_host"] = HOST_SERVIDOR."/sons/";
$pasta_host_sistema["pasta_recursos_sistema"] = HOST_SERVIDOR."/recursos/";

// define enderecos de arquivos root
$arquivo_sistema_root["css"] = $pasta_root_sistema["compilados"]."css_aparencia".$extensao_arquivo["css"];
$arquivo_sistema_root["js"] = $pasta_root_sistema["compilados"]."javascript_plugins".$extensao_arquivo["js"];
$arquivo_sistema_root["php"] = $pasta_root_sistema["compilados"]."php_plugins".$extensao_arquivo["php"];
$arquivo_sistema_root["css_efeitos"] = $pasta_root_sistema["compilados"]."css_efeitos".$extensao_arquivo["css"];
$arquivo_sistema_root["paginas_css"] = $pasta_root_sistema["compilados"]."paginas_css_aparencia".$extensao_arquivo["css"];
$arquivo_sistema_root["paginas_js"] = $pasta_root_sistema["compilados"]."paginas_javascript_plugins".$extensao_arquivo["js"];
$arquivo_sistema_root["paginas_php"] = $pasta_root_sistema["compilados"]."paginas_php_plugins".$extensao_arquivo["php"];

// define enderecos de arquivos hosts
$arquivo_sistema_host["css"] = $pasta_host_sistema["compilados"]."css_aparencia".$extensao_arquivo["css"];
$arquivo_sistema_host["js"] = $pasta_host_sistema["compilados"]."javascript_plugins".$extensao_arquivo["js"];
$arquivo_sistema_host["php"] = $pasta_host_sistema["compilados"]."php_plugins".$extensao_arquivo["php"];
$arquivo_sistema_host["jquery"] = $pasta_host_sistema["jquery"]."jquery".$extensao_arquivo["js"];
$arquivo_sistema_host["jquery_form"] = $pasta_host_sistema["jquery"]."jquery_form".$extensao_arquivo["js"];
$arquivo_sistema_host["css_efeitos"] = $pasta_host_sistema["compilados"]."css_efeitos".$extensao_arquivo["css"];
$arquivo_sistema_host["paginas_css"] = $pasta_host_sistema["compilados"]."paginas_css_aparencia".$extensao_arquivo["css"];
$arquivo_sistema_host["paginas_js"] = $pasta_host_sistema["compilados"]."paginas_javascript_plugins".$extensao_arquivo["js"];
$arquivo_sistema_host["paginas_php"] = $pasta_host_sistema["compilados"]."paginas_php_plugins".$extensao_arquivo["php"];
$arquivo_sistema_host["tema_resolucao"] = $pasta_host_sistema["pasta_recursos_sistema"]."tema_mobile/tema_mobile".$extensao_arquivo["css"];
$arquivo_sistema_host["tema_deslogado"] = $pasta_host_sistema["pasta_recursos_sistema"]."tema_deslogado/tema_deslogado".$extensao_arquivo["css"];
$arquivo_sistema_host["tema_feminino"] = $pasta_host_sistema["pasta_recursos_sistema"]."tema_feminino/tema".$extensao_arquivo["css"];
$arquivo_sistema_host["tema_plano_fundo"] = $pasta_host_sistema["pasta_recursos_sistema"]."tema_plano_fundo/tema".$extensao_arquivo["css"];

// variaveis de campos
$variavel_campo[0] = "campo_email";
$variavel_campo[1] = "campo_senha";
$variavel_campo[2] = "tipo_acao";
$variavel_campo[3] = "chave";
$variavel_campo[4] = "id";
$variavel_campo[5] = "uid";
$variavel_campo[6] = "modo";
$variavel_campo[7] = "nome_pesquisa";
$variavel_campo[8] = "modo_pesquisa";
$variavel_campo[9] = "comentario";
$variavel_campo[10] = "tabela_campo";
$variavel_campo[11] = "id_post";
$variavel_campo[12] = "elemento_id";
$variavel_campo[13] = "uidamigo";
$variavel_campo[14] = "modo_solicitacao";
$variavel_campo[15] = "senha_atual";
$variavel_campo[16] = "nova_senha";
$variavel_campo[17] = "nova_senha_confirma";
$variavel_campo[18] = "opcao_limpar_perfil";
$variavel_campo[19] = "depoimento";
$variavel_campo[20] = "modo_limpa_contador";
$variavel_campo[21] = "idcampo";
$variavel_campo[22] = "termo_pesquisa";
$variavel_campo[23] = "idcampo_entrada_emoticon";
$variavel_campo[24] = "modo_chat";
$variavel_campo[25] = "pagina";
$variavel_campo[26] = "modo_paginar";
$variavel_campo[27] = "valor_campo";
$variavel_campo[28] = "numero_configuracao";
$variavel_campo[29] = "permalink";
$variavel_campo[30] = "modo_redimensiona";
$variavel_campo[31] = "nome";
$variavel_campo[32] = "sobrenome";
$variavel_campo[33] = "email";
$variavel_campo[34] = "senha";
$variavel_campo[35] = "senha_confirma";
$variavel_campo[36] = "conteudo";
$variavel_campo[37] = "dia";
$variavel_campo[38] = "mes";
$variavel_campo[39] = "ano";
$variavel_campo[40] = "hashtag";
$variavel_campo[41] = "campo_musica";
$variavel_campo[42] = "musica";
$variavel_campo[43] = "campo_video";
$variavel_campo[44] = "video";
$variavel_campo[45] = "token_pagina";
$variavel_campo[46] = "modo_config";
$variavel_campo[47] = "pg";
$variavel_campo[48] = "url";
$variavel_campo[49] = "largura";
$variavel_campo[50] = "cidade";
$variavel_campo[51] = "modo_usuarios";
$variavel_campo[52] = "paginador";
$variavel_campo[53] = "relacao";
$variavel_campo[54] = "parametro_pesquisa";
$variavel_campo[55] = null;
$variavel_campo[56] = "latitude";
$variavel_campo[57] = "longitude";
$variavel_campo[58] = "modo_album";
$variavel_campo[59] = "altura";

// constantes de cookies
define("COOKIE_EMAIL", md5("C1"));
define("COOKIE_SENHA", md5("C2"));
define("COOKIES_DIAS", 30);

// constantes de configuracoes
define("TAMANHO_IMAGEM_PERFIL_NORMAL", 200);
define("TAMANHO_IMAGEM_PERFIL_MINIATURA", 55);
define("TAMANHO_IMAGEM_CAPA_NORMAL", 825);
define("NUMERO_IMAGENS_CAMPO_ALBUM_PERFIL", 4);
define("NUMERO_VALOR_PAGINACAO", 10);
define("TAMANHO_IMAGEM_ALBUM_NORMAL", 1280);
define("TAMANHO_IMAGEM_ALBUM_MINIATURA", 500);
define("TEMPO_TIMER_PAGINACAO", 5000);
define("NUMERO_AMIGOS_CAMPO_PERFIL", 9);
define("NUMERO_MAXIMO_AMIGOS_USUARIO", 500);
define("TAMANHO_MINIMO_SENHA", 6);
define("NUMERO_VALOR_PAGINACAO_EMOTICONS", 54);
define("TEMPO_TIMER_CONEXAO", 6000);
define("TEMPO_FICAR_OFFLINE", 6);
define("TAMANHO_NOVA_JANELA_CHAT", 222);
define("NUMERO_MAXIMO_JANELAS_CHAT", 3);
define("NUMERO_MAXIMO_JANELAS_CHAT_MOBILE", 1);
define("TAMANHO_DESCONTO_PRIMEIRA_JANELA_CHAT", 130);
define("PREFIXO_CHAT_USUARIO_ONLINE_0", md5("PCU_0")."_");
define("PREFIXO_CHAT_USUARIO_ONLINE_1", md5("PCU_1")."_");
define("PREFIXO_CHAT_USUARIO_ONLINE_2", md5("PCU_2")."_");
define("PREFIXO_CHAT_USUARIO_ONLINE_3", md5("PCU_3")."_");
define("PREFIXO_CHAT_USUARIO_ONLINE_4", md5("PCU_4"));
define("PREFIXO_CHAT_ID_JANELA_USUARIO_ABERTO_LISTA", md5("PCU_5"));
define("PREFIXO_CHAT_ABERTOS_NUMERO_6", md5("PCU_6"));
define("PREFIXO_CHAT_IMAGEM_ALBUM_CHAVE", md5("PCU_7"));
define("NUMERO_MAXIMO_PAGINAS_USUARIO", 7);
define("NUMERO_PAGINAS_EXIBE_PERFIL_BASICO", 5);
define("PREFIXO_CHAT_USUARIO_ONLINE_5", md5("PCU_8"));
define("PREFIXO_CHAT_NOVAS_MENSAGENS", md5("PCU_9"));
define("TEMPO_TIMER_ATUALIZACOES_GERAIS", 20000);
define("NUMERO_LIMITE_ULTIMAS_PUBLICACOES_USUARIO", 4);
define("NUMERO_DATA_MAXIMA_ANO", date("Y") - 100);
define("NUMERO_DATA_MAXIMA_DIA", 31);
define("NUMERO_DATA_MAXIMA_MES", 12);
define("NUMERO_ANIVERSARIANTES_PERFIL", 4);
define("NUMERO_MUSICAS_PERFIL_BASICO", 10);
define("TAMANHO_PLAYER_VIDEO", 415);
define("TAMANHO_PLAYER_AUDIO", 415);
define("TAMANHO_GRANDE_IMAGEM_MENSAGEM_CHAT", 700);
define("TAMANHO_MINIATURA_IMAGEM_MENSAGEM_CHAT", 250);
define("NUMERO_VIDEOS_CAMPO_PERFIL", 10);
define("TAMANHO_PLAYER_VIDEO_PERFIL", 130);
define("DESLOGAR_TODOS_USUARIOS", false);
define("TEMPO_TIMER_ATUALIZACOES_CHAT", 2000);
define("TAMANHO_URL_AMIGAVEL", 55);
define("TEMPO_TIMER_INFO_LINK", 2000);
define("NUMERO_IMAGENS_CAMPO_CONTEUDO_URL", 30);
define("TIMER_ATUALIZADOR_RESOLUCAO", 5000);
define("TAMANHO_MINIMO_RESOLUCAO_MOBILE", 800);
define("TEMPO_TIMER_COMUM", 1000);
define("NUMERO_SEGUNDOS_DESLOGAR_AUTOMATICO", 140);
define("NUMERO_REENVIAR_ATIVACAO_DIA", 3);
define("NUMERO_REENVIAR_RECUPERA_SENHA_DIA", 3);
define("NUMERO_ALTERAR_EMAIL_DIA", 3);
define("TAMANHO_IMAGEM_ALBUM_THUMBNAIL", 250);
define("ATIVADOR_HABILITADO", true);
define("HABILITAR_GZIP", true);
define("SIMULA_MODO_MOBILE", false);
define("PREFIXO_JANELA_PRINCIPAL_CHAT", md5("PCU_10"));
define("PREFIXO_CHAT_USUARIO_ONLINE_6", md5("PCU_11"));
define("NUMERO_RECOMENDACOES_INICIO", 20);
define("NUMERO_RSS_INICIO", 5);
define("TIMER_ATUALIZADOR_NOTICIA", 60000);
define("NUMERO_MINUTOS_RSS_ATUALIZAR_INICIO_GLOBAL", 120);
define("TAMANHO_PLAYER_VIDEO_MOBILE", 300);
define("TAMANHO_PLAYER_AUDIO_MOBILE", 300);
define("NUMERO_IMAGENS_CAMPO_ALBUM_PERFIL_MOBILE", 5);
define("NUMERO_CARACTERES_OCULTAR_TEXTO_POST", 728);
define("TAMANHO_IMAGEM_MINIATURA_UPLOAD_CHAT", 180);
define("TAMANHO_IMAGEM_PERFIL_MOBILE", 80);
define("NUMERO_RECOMENDACOES_ERRADICAR_USUARIOS", 10);
define("TIMER_ATUALIZADOR_ONLINE_MENSAGEIRO", 10000);
define("ALTURA_PLAYER_YOUTUBE", 375);
define("TAMANHO_GRANDE_IMAGEM_FUNDO", 1024);
define("TAMANHO_MINIATURA_IMAGEM_FUNDO", 300);
define("TAMANHO_IMAGEM_PERFIL_MEDIO", 100);
define("NUMERO_RELACIONAMENTO_FILHOS", 5);
define("NUMERO_RELACIONAMENTO_NETOS", 6);
define("SEPARADOR_PASTA", "/");
define("NUMERO_RELACIONAMENTO_IRMAO", 7);
define("NUMERO_RELACIONAMENTO_IRMA", 8);
define("NUMERO_RELACIONAMENTO_PRIMO", 9);
define("NUMERO_RELACIONAMENTO_PRIMA", 10);
define("NUMERO_RELACIONAMENTO_AVO_H", 1);
define("NUMERO_RELACIONAMENTO_AVO_M", 2);
define("NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA", 15);
define("NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA_PARAR", -465);
define("TAMANHO_IMAGEM_CAPA_NORMAL_PAGINA", 582);
define("TRUNCA_PALAVRAO", "&*#@!%=*");

// configuracoes de modulos
define("HABILITAR_MODULO_CHAT", true);
define("HABILITAR_MODO_NOTIFICA", true);

// modos de pagina
define("MODO_RECORTAR_IMAGEM_PAGINA", 1);
define("MODO_CONFIG_PAGINA_1", 2);
define("MODO_IMAGENS_PAGINA", 3);
define("MODO_CARREGA_USUARIOS_PAGINA", 4);

// configuracoes gerais
define("PERMITIR_PESQUISAS_DESLOGADO", true);

// tabelas de banco de dados
$tabela_banco[0] = "tb_cadastro";
$tabela_banco[1] = "tb_perfil";
$tabela_banco[2] = "tb_imagem_perfil";
$tabela_banco[3] = "tb_imagem_capa_perfil";
$tabela_banco[4] = "tb_imagem_album";
$tabela_banco[5] = "tb_publicacoes";
$tabela_banco[6] = "tb_amizades";
$tabela_banco[7] = "tb_comentarios";
$tabela_banco[8] = "tb_feeds";
$tabela_banco[9] = "tb_curtir";
$tabela_banco[10] = "tb_bloqueio";
$tabela_banco[11] = "tb_visitas";
$tabela_banco[12] = "tb_privacidade";
$tabela_banco[13] = "tb_depoimentos";
$tabela_banco[14] = "tb_marcar";
$tabela_banco[15] = "tb_mensagens";
$tabela_banco[16] = "tb_emoticons";
$tabela_banco[17] = "tb_conexao";
$tabela_banco[18] = "tb_paginas";
$tabela_banco[19] = "tb_perfil_pagina";
$tabela_banco[20] = "tb_imagem_perfil_pagina";
$tabela_banco[21] = "tb_imagem_capa_perfil_pagina";
$tabela_banco[22] = "tb_usuarios_pagina";
$tabela_banco[23] = "tb_configuracoes_pagina";
$tabela_banco[24] = "tb_notifica";
$tabela_banco[25] = "tb_aniversario";
$tabela_banco[26] = "tb_musicas";
$tabela_banco[27] = "tb_videos";
$tabela_banco[28] = "tb_url_amigaveis";
$tabela_banco[29] = "tb_conteudo_url";
$tabela_banco[30] = "tb_ativacao_usuario";
$tabela_banco[31] = "tb_recupera_senha_usuario";
$tabela_banco[32] = "tb_numero_alterou_email";
$tabela_banco[33] = "tb_frase_efeito";
$tabela_banco[34] = "tb_idioma";
$tabela_banco[35] = "tb_noticias";
$tabela_banco[36] = "";
$tabela_banco[37] = "tb_recomendar_amigos";
$tabela_banco[38] = "tb_plano_fundo";
$tabela_banco[39] = "tb_relacionamentos";
$tabela_banco[40] = "tb_visualizados";

// url de link de acao
$url_link_acao[0] = "<a href='$pagina_inicial?$variavel_campo[2]=1' title='$idioma_sistema[15]'>$idioma_sistema[15]</a>";
$url_link_acao[1] = "<a href='$pagina_inicial?$variavel_campo[2]=2' title='$idioma_sistema[603]'>$idioma_sistema[603]</a>";
$url_link_acao[2] = null;
$url_link_acao[3] = "<a href='$pagina_inicial?$variavel_campo[2]=22' title='$idioma_sistema[93]'>$idioma_sistema[93]</a>";
$url_link_acao[4] = "<a href='$pagina_inicial' title='$idioma_sistema[94]'>$idioma_sistema[94]</a>";
$url_link_acao[5] = "<a href='$pagina_inicial?$variavel_campo[2]=25' title='$idioma_sistema[103]'>$idioma_sistema[103]</a>";
$url_link_acao[6] = "<a href='$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=1' title='$idioma_sistema[105]'>$idioma_sistema[105]</a>";
$url_link_acao[7] = "<a href='$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=2' title='$idioma_sistema[106]'>$idioma_sistema[106]</a>";
$url_link_acao[8] = "<a href='$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=3' title='$idioma_sistema[107]'>$idioma_sistema[107]</a>";
$url_link_acao[9] = "<a href='$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=4' title='$idioma_sistema[108]'>$idioma_sistema[108]</a>";
$url_link_acao[10] = "<a href='$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=5&$variavel_campo[14]=1' title='$idioma_sistema[109]'>$idioma_sistema[109]</a>";
$url_link_acao[11] = "<a href='$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=6' title='$idioma_sistema[110]'>$idioma_sistema[110]</a>";
$url_link_acao[12] = "<a href='$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=7' title='$idioma_sistema[153]'>$idioma_sistema[153]</a>";
$url_link_acao[13] = "<a href='$pagina_inicial?$variavel_campo[2]=42' title='$idioma_sistema[220]'>$idioma_sistema[220]</a>";
$url_link_acao[14] = "$pagina_inicial?$variavel_campo[2]=62";
$url_link_acao[15] = "$pagina_inicial?$variavel_campo[2]=63";
$url_link_acao[16] = "$pagina_inicial?$variavel_campo[2]=42";
$url_link_acao[17] = "$pagina_inicial?$variavel_campo[2]=65";
$url_link_acao[18] = "$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=5&$variavel_campo[14]=2";
$url_link_acao[19] = "$pagina_inicial?$variavel_campo[2]=68";
$url_link_acao[20] = "<a href='$pagina_inicial?$variavel_campo[2]=9' title='$idioma_sistema[339]'>$idioma_sistema[339]</a>";
$url_link_acao[21] = "<a href='$pagina_inicial?$variavel_campo[2]=78' title='$idioma_sistema[368]'>$idioma_sistema[368]</a>";
$url_link_acao[22] = "<a href='$pagina_inicial?$variavel_campo[2]=82' title='$idioma_sistema[375]'>$idioma_sistema[375]</a>";
$url_link_acao[23] = "<a href='$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=8' title='$idioma_sistema[389]'>$idioma_sistema[389]</a>";
$url_link_acao[24] = "<a href='$pagina_inicial?$variavel_campo[2]=98' title='$idioma_sistema[229]'>$idioma_sistema[229]</a>";
$url_link_acao[25] = "$pagina_inicial?$variavel_campo[2]=99";
$url_link_acao[26] = "<a href='$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=9' title='$idioma_sistema[452]'>$idioma_sistema[452]</a>";
$url_link_acao[27] = "<a href='http://taimber.com/?permalink=119' target='_blank' title='$idioma_sistema[309]'>$idioma_sistema[309]</a>";
$url_link_acao[28] = "<a href='http://taimber.com/pg/taimber/' target='_blank' title='$idioma_sistema[310]'>$idioma_sistema[310]</a>";
$url_link_acao[29] = "<a href='http://taimber.com/?permalink=183' target='_blank' title='$idioma_sistema[313]'>$idioma_sistema[313]</a>";
$url_link_acao[30] = "$pagina_inicial?$variavel_campo[2]=42";
$url_link_acao[31] = "<a href='$pagina_inicial?$variavel_campo[2]=112' title='$idioma_sistema[585]'>$idioma_sistema[585]</a>";

// titulos de links de paginas
$titulo_link_pagina[0] = $idioma_sistema[397];
$titulo_link_pagina[1] = $idioma_sistema[398];
$titulo_link_pagina[2] = $idioma_sistema[269];
$titulo_link_pagina[3] = $idioma_sistema[250];
$titulo_link_pagina[4] = $idioma_sistema[272];

// colunas das tabelas
include_once("colunas_tabelas.php");

// campos de tabelas
include_once("campos_tabelas.php");

// codigos especiais
$codigos_especiais[0] = "[cec-1]";
$codigos_especiais[1] = "[cec-2]";
$codigos_especiais[2] = "<div class='classe_separa_elemento_1 classe_span_1'>";
$codigos_especiais[3] = "</div>";
$codigos_especiais[4] = "[cec-3]";
$codigos_especiais[5] = "[cec-4]";
$codigos_especiais[6] = "<span>";
$codigos_especiais[7] = "</span>";
$codigos_especiais[8] = "[cec-5]";
$codigos_especiais[9] = "<div class='classe_separa_elemento_2 classe_span_1'>";
$codigos_especiais[10] = "/";
$codigos_especiais[11] = "#";
$codigos_especiais[12] = ",";
$codigos_especiais[13] = "-";
$codigos_especiais[14] = "<br> "; // deixe com este espaço

// copyright
$copyright[0] = $idioma_sistema[298];

// adiciona url de feeds
include_once("urls_feeds.php");

?>