<?php

// constroe o link para abrir a media
function constroe_link_abrir_media($dados){

// globals
global $variavel_campo;

// separa os dados
$id = $dados["id"];
$titulo_musica = $dados[TITULO_MUSICA];
$titulo_video = $dados[TITULO_VIDEO];
$uid = $dados[UID];

// valida id
if($id == null){
	

	// retorno nulo
	return null;
	
};

// valida modo
if($uid == retorne_idusuario_logado()){
	
	// classes
	$classe[0] = "classe_link_abrir_media";
	
}else{
	
	// classes
	$classe[0] = "classe_link_abrir_media_2";
	
};

// url de pagina inicial
$url_pagina_inicial = PAGINA_INICIAL;

// valida titulo de musica
if($titulo_musica != null){

	// urls
	$url[0] = "$url_pagina_inicial?$variavel_campo[2]=113&$variavel_campo[4]=$id";
	
	// links
	$link[0] = "
	<a href='$url[0]' title='$titulo_musica'>$titulo_musica</a>	
	";
	
}else{
	
	// urls
	$url[0] = "$url_pagina_inicial?$variavel_campo[2]=114&$variavel_campo[4]=$id";
	
	// links
	$link[0] = "
	<a href='$url[0]' title='$titulo_video'>$titulo_video</a>	
	";
	
};

// html
$html = "
<div class='$classe[0]'>
$link[0]
</div>
";

// retorno
return $html;
	
};

?>