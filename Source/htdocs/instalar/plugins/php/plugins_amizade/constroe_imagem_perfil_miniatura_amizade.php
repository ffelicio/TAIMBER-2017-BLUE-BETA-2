<?php

// constroe a imagem de perfil em miniatura de amizade
function constroe_imagem_perfil_miniatura_amizade($modo_medio, $modo_link, $modo, $uid){

// modo true nome completo
// modo false apenas primeiro nome
// modo link retorna o nome em forma de link
// modo medio exibe a imagem no tamanho medio ao inves de miniatura

// globals
global $variavel_campo;

// nome de usuario
$nome_usuario = retorne_nome_usuario($modo, $uid);

// dados da imagem
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);

// valida modo medio
if($modo_medio == true){
	
	// separa os dados
	$url_host_miniatura = $dados_imagem[URL_HOST_MEDIO];

	// classes
	$classe[0] = "classe_div_imagem_perfil_amigo_imagem_2";
	
}else{
	
	// separa os dados
	$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];

	// classes
	$classe[0] = "classe_div_imagem_perfil_amigo_imagem";
	
};

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

// valida modo link
if($modo_link == true){
	
	// nome link
	$nome_link = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";

}else{
	
	// nome link
	$nome_link = $nome_usuario;
	
};

// valida o modo
if($modo == true){
	
	// campos
	$campo[0] = "
	
	<div class='classe_div_imagem_perfil_amigo_nome_completo'>
	$nome_link
	</div>

	";
	
}else{
	
	// campos
	$campo[0] = "

	<div class='classe_div_imagem_perfil_amigo_nome'>
	$nome_link
	</div>

	";

};

// valida modo link
if($modo_link == true){
	
	// campos
	$campo[1] = "

	<a href='$url_perfil_usuario' title='$nome_usuario'>
	<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
	</a>	
	
	";
	
}else{
	
	// campos
	$campo[1] = "

	<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
	
	";	
	
};

// html
$html = "
<div class='classe_div_imagem_perfil_amigo'>

<div class='$classe[0]'>
$campo[1]
</div>

$campo[0]

</div>
";

// retorno
return $html;

};

?>