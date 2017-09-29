<?php

// upload de imagem
function upload_imagem($fotos, $pasta_upload_root, $tamanho_normal, $tamanho_miniatura, $upload_thumbnail, $upload_original, $pasta_upload, $tamanho_thumbnail, $tamanho_mobile, $tamanho_medio){

// valida fotos
if($fotos == null){
	
	// array com fotos
	$fotos = $_FILES["foto"];

};

// endereço temporario da imagem de upload
$endereco_imagem_temporaria = $fotos["tmp_name"];

// nome real da imagem de upload
$nome_real_imagem = $fotos["name"];

// extencao da imagem de upload
$extensao_imagem = retorne_extensao_imagem_mime($endereco_imagem_temporaria);

// valida se é uma imagem válida
if($extensao_imagem == null){
	
	// retorno falso
	return false;
	
};

// novo nome da imagem depois de ser enviada
$novo_nome_imagem[0] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[1] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[2] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[3] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[4] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);
$novo_nome_imagem[5] = converte_minusculo(codifica_md5($nome_real_imagem.retorne_contador_iteracao()).$extensao_imagem);

// endereco final de imagem root
$endereco_root_final_arquivo[0] = $pasta_upload_root.$novo_nome_imagem[0];
$endereco_root_final_arquivo[1] = $pasta_upload_root.$novo_nome_imagem[1];
$endereco_root_final_arquivo[2] = $pasta_upload_root.$novo_nome_imagem[2];
$endereco_root_final_arquivo[3] = $pasta_upload_root.$novo_nome_imagem[3];
$endereco_root_final_arquivo[4] = $pasta_upload_root.$novo_nome_imagem[4];
$endereco_root_final_arquivo[5] = $pasta_upload_root.$novo_nome_imagem[5];

// endereco final de imagem host
$endereco_host_final_arquivo[0] = $pasta_upload.$novo_nome_imagem[0];
$endereco_host_final_arquivo[1] = $pasta_upload.$novo_nome_imagem[1];
$endereco_host_final_arquivo[2] = $pasta_upload.$novo_nome_imagem[2];
$endereco_host_final_arquivo[3] = $pasta_upload.$novo_nome_imagem[3];
$endereco_host_final_arquivo[4] = $pasta_upload.$novo_nome_imagem[4];
$endereco_host_final_arquivo[5] = $pasta_upload.$novo_nome_imagem[5];

// movendo upload para servidor
move_uploaded_file($endereco_imagem_temporaria, $endereco_root_final_arquivo[0]);

// obtem largura e altura de imagem
list($largura_padrao, $altura_padrao) = getimagesize($endereco_root_final_arquivo[0]);

// funcao para rotacionar imagem
rotacionar_imagem($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[0], $largura_padrao);

// valida se as imagens foram enviadas com sucesso
if(file_exists($endereco_root_final_arquivo[0]) == false){

	// array de retorno
	$retorno["host_normal"] = retorne_imagem_sistema(60, null, true);
	$retorno["host_miniatura"] = retorne_imagem_sistema(40, null, true);
	$retorno[URL_HOST_NORMAL] = retorne_imagem_sistema(39, null, true);
	$retorno[URL_HOST_THUMBNAIL] = retorne_imagem_sistema(60, null, true);
	$retorno[URL_HOST_MOBILE] = retorne_imagem_sistema(40, null, true);
	$retorno[URL_HOST_MEDIO] = retorne_imagem_sistema(99, null, true);

	// array de retorno
	$retorno["root_normal"] = null;
	$retorno["root_miniatura"] = null;
	$retorno[URL_ROOT_NORMAL] = null;
	$retorno[URL_ROOT_THUMBNAIL] = null;
	$retorno[URL_ROOT_MOBILE] = null;
	$retorno[URL_ROOT_MEDIO] = null;
	
	// retorno
	return $retorno;

};

// dimensoes da imagem
$image_info = getimagesize($endereco_root_final_arquivo[0]);

// largura da imagem
$largura_imagem = $image_info[0];

// altura da imagem
$altura_imagem = $image_info[1];

// faz nova copia para redimensionar
copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[1]);
copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[4]);

// valida copia imagem do tamanho original
if($upload_original == true){

	// faz nova copia para redimensionar
	copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[2]);

};

// faz nova copia para redimensionar
copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[3]);

// faz nova copia para redimensionar
copy($endereco_root_final_arquivo[0], $endereco_root_final_arquivo[5]);

// valida redimensionar tamanho normaç
if($tamanho_normal != null){
	
	// valida largura
	if($largura_imagem > $tamanho_normal){
		
		// redimensionando imagens
		resize_imagem($tamanho_normal, $endereco_root_final_arquivo[0], $endereco_root_final_arquivo[0]);

	};
	
}else{
	
	// remove copia
	unlink($endereco_root_final_arquivo[0]);
	
};

// valida redimensionar miniatura
if($tamanho_miniatura != null){

	// redimensiona para miniatura
	resize_imagem($tamanho_miniatura, $endereco_root_final_arquivo[1], $endereco_root_final_arquivo[1]);

}else{
	
	// remove copia
	unlink($endereco_root_final_arquivo[1]);
	
};

// valida largura
if($largura_imagem > TAMANHO_IMAGEM_ALBUM_NORMAL and $upload_original == true){

	// redimensiona para tamanho padrao de album
	resize_imagem(TAMANHO_IMAGEM_ALBUM_NORMAL, $endereco_root_final_arquivo[2], $endereco_root_final_arquivo[2]);
	
};

// valida tamanho de thumbnail
if($tamanho_thumbnail == null){
	
	// tamanho de thumbnail
	$tamanho_thumbnail = TAMANHO_IMAGEM_ALBUM_THUMBNAIL;
	
};

// valida faz upload de miniatura
if($upload_thumbnail == true){

	// redimensiona miniatura
	resize_imagem($tamanho_thumbnail, $endereco_root_final_arquivo[3], $endereco_root_final_arquivo[3]);

}else{
	
	// remove copia
	unlink($endereco_root_final_arquivo[3]);
	
};

// valida tamanho mobile
if($tamanho_mobile != null){

	// redimensiona para miniatura
	resize_imagem($tamanho_mobile, $endereco_root_final_arquivo[4], $endereco_root_final_arquivo[4]);

}else{
	
	// remove copia
	unlink($endereco_root_final_arquivo[4]);
	
};

// valida tamanho medio
if($tamanho_medio != null){

	// redimensiona para miniatura
	resize_imagem($tamanho_medio, $endereco_root_final_arquivo[5], $endereco_root_final_arquivo[5]);

}else{
	
	// remove copia
	unlink($endereco_root_final_arquivo[5]);
	
};

// array de retorno
$retorno["host_normal"] = $endereco_host_final_arquivo[0];
$retorno["host_miniatura"] = $endereco_host_final_arquivo[1];
$retorno[URL_HOST_NORMAL] = $endereco_host_final_arquivo[2];
$retorno[URL_HOST_THUMBNAIL] = $endereco_host_final_arquivo[3];
$retorno[URL_HOST_MOBILE] = $endereco_host_final_arquivo[4];
$retorno[URL_HOST_MEDIO] = $endereco_host_final_arquivo[5];

// array de retorno
$retorno["root_normal"] = $endereco_root_final_arquivo[0];
$retorno["root_miniatura"] = $endereco_root_final_arquivo[1];
$retorno[URL_ROOT_NORMAL] = $endereco_root_final_arquivo[2];
$retorno[URL_ROOT_THUMBNAIL] = $endereco_root_final_arquivo[3];
$retorno[URL_ROOT_MOBILE] = $endereco_root_final_arquivo[4];
$retorno[URL_ROOT_MEDIO] = $endereco_root_final_arquivo[5];

// retorno
return $retorno;

};

?>