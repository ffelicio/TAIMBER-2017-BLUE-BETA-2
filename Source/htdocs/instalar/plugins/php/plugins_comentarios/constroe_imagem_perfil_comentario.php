<?php

// constroe a imagem de perfil de comentario
function constroe_imagem_perfil_comentario($uid){

// dados de imagem
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);

// separa os dados
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];

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

// nome do usuario
$nome_usuario = retorne_nome_usuario(true, $uid);

// url de perfil de usuario
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);

// info links
$info_link[0] = constroe_campo_info_link(0, $uid);
	
// evento de info link
$evento_info_link = $info_link[0][0];
$conteudo_info_link = $info_link[0][1];

// html
$html = "

<div class='classe_div_imagem_perfil_miniatura_div_comentario' $evento_info_link>
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</a>
</div>

$conteudo_info_link
";

// retorno
return $html;

};

?>