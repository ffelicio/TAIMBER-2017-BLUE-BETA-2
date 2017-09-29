<?php

// constroe a imagem de perfil em miniatura de publicacao
function constroe_imagem_perfil_miniatura_publicacao($modo, $uid){

// modo true com nome
// modo false somente a imagem

// globals
global $variavel_campo;

// dados da imagem
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);

// separa os dados
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];

// nome de usuario
$nome_usuario = retorne_nome_usuario(true, $uid);

// url de perfil de usuario
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);

// nome com o link de id de usuario
$nome_link_usuario = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";

// valida url de host de imagem em miniatura
if($url_host_miniatura == null){
	
	// dados do perfil
	$dados_perfil = retorne_dados_perfil_usuario($uid);

	// valida o sexo do usuario
	if(retorne_sexo_usuario($dados_perfil) == true){
	
		// separa os dados
		$url_host_miniatura = retorne_imagem_sistema(7, false, true);
	
	}else{
	
		// separa os dados
		$url_host_miniatura = retorne_imagem_sistema(8, false, true);

	};
	
	// define o sexo do usuario
	if($dados_perfil[SEXO] == null){
		
		// separa os dados
		$url_host_miniatura = retorne_imagem_sistema(40, false, true);
		
	};
	
};

// valida modo
if($modo == true){
	
	// classe
	$classe[0] = "classe_div_imagem_perfil_miniatura";

	// campos
	$campo[0] = "
	
	<div class='classe_div_imagem_perfil_miniatura_div_nome_publicacao'>
	$nome_link_usuario
	</div>
	
	";
	
}else{
	
	// classe
	$classe[0] = "classe_div_imagem_perfil_miniatura_basico";

};

// html
$html = "

<div class='classe_div_imagem_perfil_miniatura_div_img'>
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</a>
</div>

$campo[0]
	
";

// html
$html = "
<div class='$classe[0]' $evento[0]>
$html
</div>
";

// retorno
return $html;

};

?>