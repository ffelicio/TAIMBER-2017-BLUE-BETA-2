<?php

// query para criar o banco de dados
$query = "create database if not exists ".NOME_BANCO_DADOS.";";

// cria o banco de dados
plugin_executa_query($query);

// cria as tabelas
include_once("tb_cadastro.php");
include_once("tb_perfil.php");
include_once("tb_imagem_perfil.php");
include_once("tb_imagem_capa_perfil.php");
include_once("tb_imagem_album.php");
include_once("tb_publicacoes.php");
include_once("tb_amizades.php");
include_once("tb_comentarios.php");
include_once("tb_feeds.php");
include_once("tb_curtir.php");
include_once("tb_bloqueio.php");
include_once("tb_visitas.php");
include_once("tb_privacidade.php");
include_once("tb_depoimentos.php");
include_once("tb_marcar.php");
include_once("tb_mensagens.php");
include_once("tb_emoticons.php");
include_once("tb_conexao.php");
include_once("tb_paginas.php");
include_once("tb_perfil_pagina.php");
include_once("tb_imagem_album_pagina.php");
include_once("tb_imagem_capa_perfil_pagina.php");
include_once("tb_usuarios_pagina.php");
include_once("tb_configuracoes_pagina.php");
include_once("tb_notifica.php");
include_once("tb_aniversario.php");
include_once("tb_musicas.php");
include_once("tb_videos.php");
include_once("tb_url_amigaveis.php");
include_once("tb_conteudo_url.php");
include_once("tb_ativacao_usuario.php");
include_once("tb_recupera_senha_usuario.php");
include_once("tb_numero_alterou_email.php");
include_once("tb_frase_efeito.php");
include_once("tb_idioma.php");
include_once("tb_noticias.php");
include_once("tb_recomendar_amigos.php");
include_once("tb_plano_fundo.php");
include_once("tb_relacionamentos.php");
include_once("tb_visualizados.php");

?>