<?php

// constroe a imagem de perfil em miniatura topo
function constroe_imagem_perfil_miniatura_topo($uid){

// globals
global $variavel_campo;

// nome de usuario
$nome_usuario = retorne_nome_usuario(false, $uid);

// dados da imagem
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

// url de perfil de usuario
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);

// html
$html = "
<div class='classe_div_imagem_perfil_topo'>

<div class='classe_div_imagem_perfil_imagem_topo'>
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</a>
</div>

<div class='classe_div_imagem_perfil_topo_nome'>
$nome_usuario
</div>

</div>
";

// retorno
return $html;

};

?>