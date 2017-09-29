<?php

// recorta imagem de usuario
function recorta_imagem(){

// valida o modo
$modo = retorne_campo_formulario_request(6);

// valida o modo
switch($modo){
	
	case 0:
	
	// id de usuario logado
	$id = retorne_idusuario_logado();
	
	break;
	
	case 1:
	
	// id de pagina
	$id = retorne_idpagina_request();
	
	// valida usuario logado dono da pagina
	if(retorne_usuario_logado_dono_pagina($id) == false){
		
		// chama a pagina do usuario
		chama_pagina_usuario($id);
		
		// retorno
		return null;
		
	};
	
	break;
	
};

// dados da imagem
$dados_imagem = retorne_dados_imagem_usuario($modo, $id);

// dados de retorno
$url_root_grande = $dados_imagem['url_root_grande'];
$url_root_miniatura = $dados_imagem['url_root_miniatura'];
$url_root_normal = $dados_imagem['url_root_normal'];
$url_root_medio = $dados_imagem['url_root_medio'];
$url_root_mobile = $dados_imagem['url_root_mobile'];

// dados de dimensao de imagem grande original
$dados_dimensao[0] = retorne_dimensoes_imagem($url_root_normal);
$dados_dimensao[1] = retorne_dimensoes_imagem($url_root_grande);
$dados_dimensao[2] = retorne_dimensoes_imagem($url_root_medio);
$dados_dimensao[3] = retorne_dimensoes_imagem($url_root_mobile);

// original
$altura[0] = $dados_dimensao[0]["altura"];
$largura[0] = $dados_dimensao[0]["largura"];

// grande
$altura[1] = $dados_dimensao[1]["altura"];
$largura[1] = $dados_dimensao[1]["largura"];

// medio
$altura[2] = $dados_dimensao[2]["altura"];
$largura[2] = $dados_dimensao[2]["largura"];

// mobile
$altura[3] = $dados_dimensao[3]["altura"];
$largura[3] = $dados_dimensao[3]["largura"];

// imagem normal
$altura_mapa = $_POST['h']; // altura
$largura_mapa = $_POST['w']; // largura

// largura da nova imagem
$largura_nova = ($altura[0] * $altura_mapa) / $altura[1];
$altura_nova = ($largura[0] * $largura_mapa) / $largura[1];

// imagem miniatura
$targ_w[0] = $altura_nova;
$targ_h[0] = $largura_nova;

// remove imagem de perfil antiga
exclui_arquivo_unico($url_root_grande);
exclui_arquivo_unico($url_root_miniatura);
exclui_arquivo_unico($url_root_medio);
exclui_arquivo_unico($url_root_mobile);

// fazendo backup de imagens
copy($url_root_normal, $url_root_grande);
copy($url_root_normal, $url_root_miniatura);
copy($url_root_normal, $url_root_medio);
copy($url_root_normal, $url_root_mobile);

// calculando porcentagem
$porcentagem = ($altura[0] * 100) / $altura[1];

// aplica a porcentagem nas coordenadas
$_POST['x'] *= $porcentagem / 100;
$_POST['y'] *= $porcentagem / 100;
$_POST['w'] *= $porcentagem / 100;
$_POST['h'] *= $porcentagem / 100;

// criando nova imagem
$src[0] = $url_root_normal;
$img_r[0] = imagecreatefromjpeg($src[0]);
$dst_r[0] = ImageCreateTrueColor($targ_w[0], $targ_h[0]);
imagecopyresampled($dst_r[0], $img_r[0], 0, 0, $_POST['x'], $_POST['y'], $targ_w[0], $targ_h[0], $_POST['w'], $_POST['h']);

// grava a nova imagem
imagejpeg($dst_r[0], $url_root_grande);
imagejpeg($dst_r[0], $url_root_miniatura);
imagejpeg($dst_r[0], $url_root_normal);
imagejpeg($dst_r[0], $url_root_medio);
imagejpeg($dst_r[0], $url_root_mobile);

// redimensionando imagens
resize_imagem(TAMANHO_IMAGEM_PERFIL_NORMAL, $url_root_grande, $url_root_grande);
resize_imagem(TAMANHO_IMAGEM_PERFIL_MINIATURA, $url_root_miniatura, $url_root_miniatura);
resize_imagem(TAMANHO_IMAGEM_PERFIL_MEDIO, $url_root_medio, $url_root_medio);
resize_imagem(TAMANHO_IMAGEM_PERFIL_MOBILE, $url_root_mobile, $url_root_mobile);

// valida o modo
switch($modo){
	
	case 0:
	chama_pagina_inicial();
	break;
	
	case 1:
	chama_pagina_usuario($id);
	break;
	
};

};

?>
