<?php

// constroe o campo de album no perfil basico
function constroe_campo_album_perfil_basico(){

// globals
global $tabela_banco;

// id de usuario
$uid = retorne_idusuario_request();

// modo pagina
$modo_pagina = retorne_modo_pagina();

// id de pagina via requeste
$pagina = retorne_idpagina_request();

// valida modo de pagina
if($modo_pagina == true){
	
	// usuario dono da pagina
	$usuario_dono = retorne_usuario_dono_pagina($uid, $pagina);	
	
	// numero de imagens da pagina
	$numero_imagens = retorne_numero_imagens_album_pagina($pagina);

}else{
	
	// usuario dono do perfil
	$usuario_dono = retorne_usuario_dono_perfil($uid);

	// numero com todas as imagens
	$numero_imagens = retorne_numero_todas_imagens_usuario($uid);

};

// valida modo de pagina
if($modo_pagina == true and $usuario_dono == false and $numero_imagens == 0){
	
	// retorno nulo
	return null;	
	
};

// valida a privacidade
if((retorne_perfil_privado(null) == true or $numero_imagens == 0) and $usuario_dono == false){
	
	// retorno nulo
	return null;
	
};

// modo mobile
$modo_mobile = retorne_modo_mobile();

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// array com imagens
$array_imagens = $dados_compilados_usuario[$tabela_banco[4]];

// inverte o array
$array_imagens = inverte_array($array_imagens);

// contador de avanco
$contador = 0;

// valida modo mobile
if($modo_mobile == true){
	
	// contador final
	$contador_final = NUMERO_IMAGENS_CAMPO_ALBUM_PERFIL_MOBILE;

}else{
	
	// contador final
	$contador_final = NUMERO_IMAGENS_CAMPO_ALBUM_PERFIL;

};

// valida se o valor e array
if(is_array($array_imagens) == false){

    // retorno nulo
    return null;

};

// extraindo imagens
for($contador == $contador; $contador <= $contador_final; $contador++){

	// constroe a imagem de album por dados
	$html .= constroe_imagem_album_dados($array_imagens[$contador], 2, null);

};

// valida o modo mobile
if($modo_mobile == false){
	
	// campo visualizar imagens de album
	$campo_visualizar_imagens_album = constroe_visualizador_imagens_album();

};

// html
$html = "
<div class='classe_div_campo_album_perfil_basico'>

<div class='classe_div_campo_album_perfil_basico_imagens'>
$html
</div>

$campo_visualizar_imagens_album

</div>
";

// retorno
return $html;

};

?>