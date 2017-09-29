<?php

// constroe o carregar imagens
function constroe_carregar_imagens(){

// globals
global $idioma_sistema;

// modo pagina
$modo_pagina = retorne_modo_pagina();

// id de usuario
$uid = retorne_idusuario_request();

// usuario dono do perfil
$usuario_dono = retorne_usuario_dono_perfil($uid);

// numero de imagens
$numero_imagens = retorne_numero_todas_imagens_usuario($uid);

// id de campo
$idcampo[0] = retorna_idcampo_conteudo_geral();

// funcoes
$funcao[0] = "carregar_visualizador_imagens_album(\"$idcampo[0]\")";

// eventos
$evento[0] = "onclick='$funcao[0]'";

// valida o modo pagina
if($modo_pagina == true){
	
	// titulo
	$titulo = $idioma_sistema[417].retorne_titulo_pagina_id(retorne_idpagina_request());
	
}else{
	
	// titulo
	$titulo = $idioma_sistema[417].retorne_nome_usuario(true, $uid);

};

// classes
$classe[0] = "classe_div_imagens_album";
$classe[1] = "classe_div_imagens_album_titulo classe_cor_5";
$classe[2] = "classe_div_imagens_album_conteudo";
$classe[3] = "classe_paginador_padrao classe_cor_29 span_link";
$classe[4] = "classe_campo_upload_imagem_album_usuario";
$classe[5] = "classe_progresso_div_imagens_album";

// valida usuario dono do perfil
if($usuario_dono == true and $modo_pagina == false){

    // campo de upload
    $campo_upload = constroe_formulario_barra_progresso(PAGINA_ACOES, "id_formulario_imagens_album", "fotos[]", 6, true, 1);

	// campo de upload
	$campo_upload = "
	<div class='$classe[4]'>
	$campo_upload
	</div>
	";

};

// progresso gif
$progresso[0] = campo_progresso_gif(retorna_idcampo_progresso_gif_geral());

// valida numero de imagens
if($numero_imagens == 0){

	// campos
	$campo[0] = "
	<div class='$classe[0]' id='$idcampo[0]'>
	<div class='$classe[1]'>$titulo</div>
	<div class='$classe[2]'>$campo_upload</div>
	</div>
	";
	
}else{

	// campos
	$campo[0] = "
	<div class='$classe[0]' id='$idcampo[0]'>
	<div class='$classe[1]'>$titulo</div>
	$campo_upload
	<div class='$classe[2]' id='$idcampo[0]'></div>
	</div>
	";	

	// campos
	$campo[1] = "
	<div class='$classe[3]' $evento[0]>
	$idioma_sistema[23]
	</div>
	";

};

// campo de progresso
$campo[2] = "
<div class='$classe[5]'>$progresso[0]</div>
";

// html
$html = "
$campo[0]
$campo[2]
$campo[1]
";

// valida modo album
if($modo_pagina == false){
	
	// valida numero de imagens de usuário
	if($numero_imagens > 0){
		
		// array com titulos
		$array_titulos[] = $idioma_sistema[167];
		$array_titulos[] = $idioma_sistema[599];
		
		// array conteudos
		$array_conteudos[] = $html;
		$array_conteudos[] = carrega_albuns_usuario();
		
		// array ids
		$array_ids[] = retorne_idcampo_md5();
		$array_ids[] = retorne_idcampo_md5();
		
		// retorno
		return constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);

	}else{
		
		// valida se o usuário é o dono
		if($usuario_dono == false){

			// html
			$html = retorne_nome_link_usuario(false, $uid).$idioma_sistema[605];
		
		};
		
	};
	
};

// html
$html = "
<div class='classe_conteudo_centro_padrao'>
$html
</div>
";

// retorno
return $html;

};

?>