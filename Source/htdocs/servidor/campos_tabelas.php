<?php

// padrao de campos
define("IDCAMPO_1", "id int not null auto_increment primary key, ");

// define os campos das tabelas
#tabela cadastro
define("CAMPO_TABELA_CADASTRO_CHAVE", "uid int not null auto_increment primary key, ");
define("CAMPO_TABELA_CADASTRO_CORPO", "E-mail,Senha,Data");
define("CAMPO_TABELA_CADASTRO_CAMPOS", $idioma_sistema[9]);

#tabela perfil
define("CAMPO_TABELA_PERFIL_CHAVE", "uid int, ");
define("CAMPO_TABELA_PERFIL_CORPO", "Nome,Sobrenome,Sexo,Relacionamento,Nasceu,Cidade,Estado,Idiomas,Pais,Telefone,Celular,Skype,Facebook,Site,Atividades,Interesses,Musicas,Filmes,Livros,Programa de Tv,Jogos,Frases,Sobre mim,Estuda,Trabalha,Religiao,Genero,Opcao sexual,Apelido,Sonhos"); // sem acentos por que e da tabela
define("CAMPO_TABELA_PERFIL_CAMPOS", $idioma_sistema[10]);
define("CAMPO_TABELA_PERFIL_CAMPOS_2", $idioma_sistema[385].", ".$idioma_sistema[10]);
define("CAMPO_TABELA_PERFIL_CAMPOS_3", "pagina,".CAMPO_TABELA_PERFIL_CORPO);

# tabela imagem de perfil
define("CAMPO_TABELA_IMG_PERFIL_CHAVE", "uid int, ");
define("CAMPO_TABELA_IMG_PERFIL_CORPO", "Url host grande,Url host miniatura,Url root grande,Url root miniatura,Url host normal,Url root normal, Url host mobile, Url host medio, Url root medio, Url root mobile"); // sem acentos por que e da tabela

# tabela de capa de usuario
define("CAMPO_TABELA_CAPA_CHAVE", "uid int, ");
define("CAMPO_TABELA_CAPA_CORPO", "Url host grande,Url host miniatura,Url root grande,Url root miniatura,Url host normal,Url root normal, topo");

# tabela de imagens
define("CAMPO_TABELA_IMAGEM_ALBUM_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_IMAGEM_ALBUM_CORPO", "uid,Chave,Modo chat,Pagina,uidamigo,Url host grande,Url host miniatura,Url root grande,Url root miniatura,Url host thumbnail,Url root thumbnail,Descricao imagem,Data");

# tabela de publicacoes
define("CAMPO_TABELA_PUBLICACAO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_PUBLICACAO_CORPO", "uid,Pagina,Chave,Texto,Id compartilhado, Modo,Data");

# tabela de amizades
define("CAMPO_TABELA_AMIZADE_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_AMIZADE_CORPO", "uid,uidamigo,uidenviou,Aceito,nome,sobrenome,sexo,cidade,estado,estuda,trabalha,Data");

// tabela de comentarios
define("CAMPO_TABELA_COMENTARIO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_COMENTARIO_CORPO", "uid, uidamigo, Id post, Comentario, Tabela comentario, Data");

// tabela de feeds
define("CAMPO_TABELA_FEEDS_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_FEEDS_CORPO", "uid, uidamigo, id_post, data");

// tabela de curtidas
define("CAMPO_TABELA_CURTIR_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_CURTIR_CORPO", "uid, uidamigo, Id post, Tabela curtiu, Data");

// tabela de bloqueios
define("CAMPO_TABELA_BLOQUEIO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_BLOQUEIO_CORPO", "uid, uidamigo, uidbloqueou, data");

// tabela visitas
define("CAMPO_TABELA_VISITAS_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_VISITAS_CORPO", "uid, uidamigo, numero visitas, data");

// tabela privacidade
define("CAMPO_TABELA_PRIVACIDADE_CHAVE", "uid int, ");
define("CAMPO_TABELA_PRIVACIDADE_CORPO", "solicita email adicionar, perfil privado, bloqueia pornografia, bloqueia palavras chave, deslogar automatico, desabilitar comentarios, desabilitar curtidas, desabilitar depoimentos, desabilitar chat, desabilitar compartilhamentos, desabilitar noticias, desabilitar novidades");
define("CAMPO_TABELA_PRIVACIDADE_CAMPOS", $idioma_sistema[158]);

// tabela de depoimentos
define("CAMPO_TABELA_DEPOIMENTO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_DEPOIMENTO_CORPO", "uid, uidamigo, depoimento, aceito, data");

// tabela de marcacoes
define("CAMPO_TABELA_MARCAR_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_MARCAR_CORPO", "chave, tabela_referencia, uid, uidamigo, visualizado, idpost, data");

// tabela de mensagens
define("CAMPO_TABELA_MENSAGEM_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_MENSAGEM_CORPO", "uid, uidamigo, mensagem, uidenviou, visualizado, respondido, chave_imagem, data");

// tabela de emoticons
define("CAMPO_TABELA_EMOTICON_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_EMOTICON_CORPO", "url");

// tabela de conexao
define("CAMPO_TABELA_CONEXAO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_CONEXAO_CORPO", "uid, data conexao");

// tabela pagina
define("CAMPO_TABELA_PAGINA_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_PAGINA_CORPO", "uid, titulo, data");

// tabela de perfil de pagina
define("CAMPO_TABELA_PERFIL_PAGINA_CHAVE", "id int, ");
define("CAMPO_TABELA_PERFIL_PAGINA_CORPO", "uid, titulo da pagina, descricao da pagina, web site, telefone"); // sem acentos por que e da tabela
define("CAMPO_TABELA_PERFIL_PAGINA_CAMPOS", $idioma_sistema[239]); // pode acentos por que e do formulario

// tabela imagem de perfil de pagina
define("CAMPO_TABELA_IMG_PERFIL_PAGINA_CHAVE", "id int, ");
define("CAMPO_TABELA_IMG_PERFIL_PAGINA_CORPO", "Url host grande,Url host miniatura,Url root grande,Url root miniatura,Url host normal,Url root normal, Url host mobile");

// tabela de capa de pagina de usuario
define("CAMPO_TABELA_CAPA_PAGINA_CHAVE", "id int, ");
define("CAMPO_TABELA_CAPA_PAGINA_CORPO", "Url host grande,Url host miniatura,Url root grande,Url root miniatura,Url host normal,Url root normal, topo");

// tabela de usuarios de pagina
define("CAMPO_USUARIOS_PAGINA_CHAVE", IDCAMPO_1);
define("CAMPO_USUARIOS_PAGINA_CORPO", "pagina, titulo, uidamigo");

// tabela de configuracoes da pagina
define("CAMPO_TABELA_CONFIGURACOES_PAGINA_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_CONFIGURACOES_PAGINA_CORPO", "Pagina, Habilitar comentarios, Habilitar curtidas, Habilitar inscricoes, Somente amigos podem se inscrever");

// tabela de notificacoes
define("CAMPO_TABELA_NOTIFICA_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_NOTIFICA_CORPO", "idpost, tabela_notifica, tabela_acao, uid, uidamigo, visualizado, idcomentario, data");

// tabela de aniversarios
define("CAMPO_TABELA_ANIVERSARIO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_ANIVERSARIO_CORPO", "uid, uidamigo, idade, data");

// tabela de musicas
define("CAMPO_TABELA_MUSICAS_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_MUSICAS_CORPO", "uid, Titulo musica, Url root musica, Url host musica, chave, data");

// tabela de videos
define("CAMPO_TABELA_VIDEOS_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_VIDEOS_CORPO", "uid, Titulo video, Url root video, Url host video, chave, data");

// tabela de urls amigaveis
define("CAMPO_TABELA_URL_AMIGAVEL_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_URL_AMIGAVEL_CORPO", "uid, Nome amigavel, Modo, Pagina");

// tabela de conteudo de url
define("CAMPO_TABELA_CONTEUDO_URL_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_CONTEUDO_URL_CORPO", "chave, titulo, descricao, imagens, uid, url, publicado, data");

// tabela de ativacao de conta de usuario
define("CAMPO_TABELA_ATIVACAO_CONTA_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_ATIVACAO_CONTA_CORPO", "uid, chave, tentativas, data");

// tabela de recupera senha de usuario
define("CAMPO_TABELA_RECUPERA_SENHA_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_RECUPERA_SENHA_CORPO", "email, chave, tentativas, data");

// tabela de alteração de email
define("CAMPO_TABELA_ALTERA_EMAIL_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_ALTERA_EMAIL_CORPO", "uid, tentativas, data");

// tabela de frase de efeito
define("CAMPO_TABELA_FRASE_EFEITO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_FRASE_EFEITO_CORPO", "uid,conteudo,data");

// tabela de idiomas
define("CAMPO_TABELA_IDIOMA_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_IDIOMA_CORPO", "uid, modo");

// tabela de noticias
define("CAMPO_TABELA_NOTICIAS_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_NOTICIAS_CORPO", "uid, titulo, link, descricao, data_noticia, data");

// tabela de recomendacoes de amigos
define("CAMPO_TABELA_RECOMENDAR_AMIGO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_RECOMENDAR_AMIGO_CORPO", "uid, uidamigo, aceito, contador, data");

// tabela de plano de fundo
define("CAMPO_TABELA_PLANO_FUNDO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_PLANO_FUNDO_CORPO", "uid, Url host grande,Url host miniatura,Url root grande,Url root miniatura");

// tabela de relacionamentos
define("CAMPO_TABELA_RELACIONAMENTOS_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_RELACIONAMENTOS_CORPO", "uid, uidamigo, relacao, aceito, visualizado, uidenviou, data");

// tabela de visualizacoes de publicacoes
define("CAMPO_TABELA_VIZUALIZADO_CHAVE", IDCAMPO_1);
define("CAMPO_TABELA_VIZUALIZADO_CORPO", "uid, id_post, tabela_campo, data");

?>