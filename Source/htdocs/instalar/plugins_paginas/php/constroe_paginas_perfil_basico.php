<?php

// constroe as paginas do perfil basico
function constroe_paginas_perfil_basico(){

// globals
global $idioma_sistema;
global $variavel_campo;

// id de usuario via requeste
$uid = retorne_idusuario_request();

// numero de paginas
$numero_paginas = retorne_numero_paginas_usuario(retorne_idusuario_request());
$numero_paginas_inscritas = retorne_numero_paginas_inscritas_usuario(retorne_idusuario_request());

// classes
$classe[0] = "classe_paginas_perfil_basico_titulo classe_cor_29";

// valida o numero de paginas
if($numero_paginas > 0){
	
	// valida singular ou plural
	if($numero_paginas > 1){
		
		// plural
		$plural[0] = $idioma_sistema[236];
		
	}else{
		
		// plural
		$plural[0] = $idioma_sistema[246];	
		
	};
	
	// adiciona tamanho
	$numero_paginas = retorne_tamanho_resultado($numero_paginas);

	// titulo de link
	$titulo_link = $numero_paginas.$plural[0];
	
	// url
	$url = PAGINA_INICIAL."?$variavel_campo[5]=$uid&$variavel_campo[2]=108&$variavel_campo[6]=0";
	
	// link
	$link = "<a href='$url' title='$titulo_link'>$titulo_link</a>";

	// campos
    $campos[0] = "
    <div class='$classe[0]'>
    $link
    </div>
    ";

};

// valida o numero de paginas inscritas
if($numero_paginas_inscritas > 0){
	
	// valida singular ou plural
	if($numero_paginas_inscritas > 1){
		
		// plural
		$plural[1] = $idioma_sistema[266];
		
	}else{
		
		// plural
		$plural[1] = $idioma_sistema[265];	
		
	};
	
	// adiciona tamanho
	$numero_paginas_inscritas = retorne_tamanho_resultado($numero_paginas_inscritas);
	
	// titulo de link
	$titulo_link = $numero_paginas_inscritas.$plural[1];
	
	// url
	$url = PAGINA_INICIAL."?$variavel_campo[5]=$uid&$variavel_campo[2]=108&$variavel_campo[6]=1";
	
	// link
	$link = "<a href='$url' title='$titulo_link'>$titulo_link</a>";

	// campos
    $campos[4] = "
    <div class='$classe[0]'>
    $link
    </div>
    ";

};

// campos
$campos[1] = constroe_campo_visualizar_paginas(true);
$campos[2] = constroe_campo_construir_paginas();
$campos[3] = constroe_campo_visualizar_paginas(false);

// html
$html = "
<div class='classe_paginas_perfil_basico'>
$campos[0]
$campos[1]
$campos[4]
$campos[3]
$campos[2]
</div>
";

// retorno
return $html;

};

?>