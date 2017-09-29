<?php

// upload de imagem de album
function upload_imagem_album($numero_pasta){

// globals
global $tabela_banco;
global $idioma_sistema;

// valida modo pagina
if(retorne_modo_pagina() == true){
	
	// id de pagina
	$pagina = retorne_idpagina_request();
	
	// valida usuario logado dono da pagina
	if(retorne_usuario_logado_dono_pagina($pagina) == false){
		
		// limpa id de pagina
		$pagina = null;
		
	};

};

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// array com fotos
$fotos = $_FILES['fotos'];

// extencao da imagem de upload
$extensao_imagem = converte_minusculo(pathinfo($foto["name"], PATHINFO_EXTENSION));

// numero de imagens
$numero_imagens = retorne_numero_array_post_imagens();

// contador
$contador = 0;

// data atual
$data = data_atual();

// modo chat
$modo_chat = 0;

// chave da publicacao
switch($numero_pasta){
	
	case 4: // chat de usuario
	$modo_chat = 1;
	$chave = codifica_md5(PREFIXO_CHAT_IMAGEM_ALBUM_CHAVE.retorne_contador_iteracao());
	$uidamigo = retorne_idusuario_request();
	break;

	case 9: // imagens de postagem de usuario
    $chave = retorna_chave_request();
    break;
	
	default: // imagens padrao de album
	$chave = null;
	
};

// uploading de imagens
for($contador == $contador; $contador <= $numero_imagens; $contador++){

	// nome imagem
	$nome_imagem = $fotos['tmp_name'][$contador];
	$nome_imagem_real = $fotos['name'][$contador]; 

	// upload da imagem e recebe dados
	if($nome_imagem != null){

		// foto
		$foto["tmp_name"] = $nome_imagem;
		$foto["name"] = $nome_imagem_real;
		
		// valida modo chat
		if($modo_chat != 1){

			// pastas de upload
			$pasta_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);
			$pasta_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);
			
			// dados apos upload de imagem
			$dados_imagem = upload_imagem_unica_album($foto, $pasta_root, TAMANHO_IMAGEM_ALBUM_NORMAL, TAMANHO_IMAGEM_ALBUM_MINIATURA, $pasta_host, true, null);
			
			// separando dados
			$url_host_grande[0] = $dados_imagem[URL_HOST_GRANDE];
			$url_host_miniatura[0] = $dados_imagem[URL_HOST_MINIATURA];
			$url_root_grande[0] = $dados_imagem[URL_ROOT_GRANDE];
			$url_root_miniatura[0] = $dados_imagem[URL_ROOT_MINIATURA];
			$url_root_thumbnail[0] = $dados_imagem[URL_ROOT_THUMBNAIL];
			$url_host_thumbnail[0] = $dados_imagem[URL_HOST_THUMBNAIL];
			
			// cadastra em banco de dados
			$query[0] = "insert into $tabela_banco[4] values(null, '$idusuario', '$chave', '$modo_chat', '$pagina', '$uidamigo', '$url_host_grande[0]', '$url_host_miniatura[0]', '$url_root_grande[0]', '$url_root_miniatura[0]', '$url_host_thumbnail[0]', '$url_root_thumbnail[0]', '', '$data');";
			
			// valida host de imagem
			if($url_host_grande[0] != null){
				
				// executa query
				plugin_executa_query($query[0]);

			};
			
		}else{

			// não permite dizer que é de uma página
			$pagina = null;
			
			// pastas de upload
			$pasta_root = retorne_pasta_usuario($uidamigo, $numero_pasta, true);
			$pasta_host = retorne_pasta_usuario($uidamigo, $numero_pasta, false);
			
			// dados apos upload de imagem
			$dados_imagem = upload_imagem_unica_album($foto, $pasta_root, TAMANHO_GRANDE_IMAGEM_MENSAGEM_CHAT, TAMANHO_IMAGEM_MINIATURA_UPLOAD_CHAT, $pasta_host, true, null);
		
			// separando dados
			$url_host_grande[0] = $dados_imagem[URL_HOST_GRANDE];
			$url_host_miniatura[0] = $dados_imagem[URL_HOST_MINIATURA];
			$url_host_thumbnail[0] = $dados_imagem[URL_HOST_THUMBNAIL];
			
			// separando dados
			$url_root_grande[0] = $dados_imagem[URL_ROOT_GRANDE];
			$url_root_miniatura[0] = $dados_imagem[URL_ROOT_MINIATURA];
			$url_root_thumbnail[0] = $dados_imagem[URL_ROOT_THUMBNAIL];
			
			// valida host de imagem
			if($url_host_grande[0] != null){
				
				// pastas de usuario logado
				$pasta_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);
				$pasta_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);

				// novos nomes de arquivos de usuario logado
				$nome_arquivo[0] = basename($url_root_grande[0]);
				$nome_arquivo[1] = basename($url_root_miniatura[0]);
				$nome_arquivo[2] = basename($url_root_thumbnail[0]);
				
				// copiando arquivos para usuario logado
				copy($url_root_grande[0], $pasta_root.$nome_arquivo[0]);
				copy($url_root_miniatura[0], $pasta_root.$nome_arquivo[1]);
				copy($url_root_thumbnail[0], $pasta_root.$nome_arquivo[2]);

				// separando dados
				$url_host_grande[1] = $pasta_host.$nome_arquivo[0];
				$url_host_miniatura[1] = $pasta_host.$nome_arquivo[1];
				$url_host_thumbnail[1] = $pasta_host.$nome_arquivo[2];
				$url_root_grande[1] = $pasta_root.$nome_arquivo[0];
				$url_root_miniatura[1] = $pasta_root.$nome_arquivo[1];
				$url_root_thumbnail[1] = $pasta_root.$nome_arquivo[2];
				
				// cadastra em banco de dados
				$query[0] = "insert into $tabela_banco[4] values(null, '$uidamigo', '$chave', '$modo_chat', '$pagina', '$idusuario', '$url_host_grande[0]', '$url_host_miniatura[0]', '$url_root_grande[0]', '$url_root_miniatura[0]', '$url_host_thumbnail[0]', '$url_root_thumbnail[0]', '', '$data');";
				$query[1] = "insert into $tabela_banco[4] values(null, '$idusuario', '$chave', '$modo_chat', '$pagina', '$uidamigo', '$url_host_grande[1]', '$url_host_miniatura[1]', '$url_root_grande[1]', '$url_root_miniatura[1]', '$url_host_thumbnail[1]', '$url_root_thumbnail[1]', '', '$data');";
			
				// executa query
				plugin_executa_query($query[0]);
				plugin_executa_query($query[1]);

				// mensagem a ser enviada
				$mensagem[0] = "
				$url_host_grande[0]
				";
				
				// mensagem a ser enviada
				$mensagem[1] = "
				$url_host_grande[1]
				";		

				// envia uma nova mensagem
				enviar_mensagem_usuario($mensagem[0], false, $uidamigo, $chave);
				enviar_mensagem_usuario($mensagem[1], false, $idusuario, $chave);
				
			};
			
		};

	};

};

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

};

?>