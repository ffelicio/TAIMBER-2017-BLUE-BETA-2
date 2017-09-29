<?php

// constroe o visualizador de imagens de album
function constroe_visualizador_imagens_album(){

// globals
global $tabela_banco;
global $idioma_sistema;
global $variavel_campo;

// id de usuario
$uid = retorne_idusuario_request();

// modo pagina
$modo_pagina = retorne_modo_pagina();

// id de pagina via requeste
$pagina = retorne_idpagina_request();
	
// valida o modo pagina
if($modo_pagina == true){

	// numero de imagens da pagina
	$numero_imagens = retorne_numero_imagens_album_pagina($pagina);

	// usuario dono da pagina
	$usuario_dono = retorne_usuario_dono_pagina($uid, $pagina);

}else{
	
	// numero de imagens
	$numero_imagens = retorne_numero_todas_imagens_usuario($uid);

	// usuario dono do perfil
	$usuario_dono = retorne_usuario_dono_perfil($uid);

};

// valida o numero de imagens
if($numero_imagens == 0){
	
	// valida usuário dono
	if($usuario_dono == true){
		
		// imagem numero de imagens
		$numero_imagens = retorne_imagem_sistema(116, null, false);
		
	}else{
		
		// singular
		$numero_imagens = $numero_imagens.$idioma_sistema[21];
		
	};
	
}else{
	
	// plural ou singular
	if($numero_imagens > 1){
		
		// plural
		$numero_imagens = retorne_tamanho_resultado($numero_imagens).$idioma_sistema[22];
		
	}else{
		
		// singular
		$numero_imagens = $numero_imagens.$idioma_sistema[21];
		
	};

};

// url de index de inicio
$url_index_inicio = PAGINA_INDEX_INICIO;

// valida o modo pagina
if($modo_pagina == true){

	// urls
	$url[0] = "$url_index_inicio?$variavel_campo[25]=$pagina&$variavel_campo[2]=7";

}else{
	
	// urls
	$url[0] = "$url_index_inicio?$variavel_campo[5]=$uid&$variavel_campo[2]=7";

};

// links
$link[0] = "<a href='$url[0]'>$numero_imagens</a>";

// html
$html = "
<div class='classe_div_visualizador_album_abrir_visualizador' id='id_div_numero_imagens_visualizador_imagens_album_perfil'>
$link[0]
</div>
";

// retorno
return $html;

};

?>