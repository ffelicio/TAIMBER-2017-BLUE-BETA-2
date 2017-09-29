<?php

// constroe a imagem de perfil em miniatura modo pesquisa
function constroe_imagem_perfil_miniatura_pesquisa($uid){

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

// link de imagem de usuario
$imagem_link_usuario = "
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</a>
";

// html
$html = "
	
<div class='classe_div_imagem_perfil_miniatura_div_img_pesquisa'>
$imagem_link_usuario
</div>	
	
<div class='classe_div_imagem_perfil_miniatura_div_nome_pesquisa classe_nome_pesquisa classe_cor_5'>
$nome_link_usuario
</div>

";

// html
$html = "
<div class='classe_div_imagem_perfil_miniatura_pesquisa'>
$html
</div>
";

// retorno
return $html;

};

?>