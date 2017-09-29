<?php

// retorna a pasta do usuario
function retorne_pasta_usuario($idusuario, $tipo_pasta, $modo){

// globals
global $pasta_root_sistema;
global $pasta_host_sistema;

// modo true retorna root
// modo false retorna servidor

// pasta de usuario
$pasta_usuario_root = $pasta_root_sistema["arquivos_usuarios"].codifica_md5($idusuario)."/";
$pasta_usuario_servidor = $pasta_host_sistema["arquivos_usuarios"].codifica_md5($idusuario)."/";

// id da pagina se houver
$pagina = retorne_idpagina_request();

// valida o tipo de pasta
switch($tipo_pasta){

    case 1:
    $sub_pasta = "imagem_perfil";
    break;

    case 2:
    $sub_pasta = "album_imagens";
    break;

    case 3:
    $sub_pasta = "album_musicas";
    break;

    case 4:
    $sub_pasta = "imagens_chat";
    break;

    case 5:
    $sub_pasta = "wallpaper_usuario";
    break;

    case 6:
    $sub_pasta = "album_videos";
    break;

    case 7:
    $sub_pasta = "imagens_paginas";
    break;

	case 8:
	$sub_pasta = "imagem_capa_usuario";
	break;
	
	case 9:
	$sub_pasta = "imagens_publicacoes";
	break;
	
	case 10:
	$sub_pasta = "imagem_capa_pagina_usuario";
	break;
	
    default:
    return $pasta_usuario_root;

};

// valida se e uma pagina
if($pagina == null){
	
    // adiciona subpasta
    $pasta_usuario_root .= $sub_pasta."/";
    $pasta_usuario_servidor .= $sub_pasta."/";

}else{
	
    // adiciona subpasta
    $pasta_usuario_root .= $sub_pasta."/".$pagina."/";
    $pasta_usuario_servidor .= $sub_pasta."/".$pagina."/";	
	
};

// cria pasta e subpastas
criar_pasta($pasta_usuario_root);

// retorno
if($modo == true){

    // root
    return $pasta_usuario_root;

}else{

    // servidor
    return $pasta_usuario_servidor;

};

};

?>