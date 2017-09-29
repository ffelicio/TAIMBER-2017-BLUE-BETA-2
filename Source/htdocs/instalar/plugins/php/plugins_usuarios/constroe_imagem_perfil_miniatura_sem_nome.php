<?php

// constroe a imagem de perfil em miniatura de usuário sem nome
function constroe_imagem_perfil_miniatura_sem_nome($uid, $modo_medio){

// nome de usuario
$nome_usuario = retorne_nome_usuario(true, $uid);

// dados da imagem
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);

// valida o modo medio
if($modo_medio == true){

	// separa os dados
	$url_host_miniatura = $dados_imagem[URL_HOST_MEDIO];
	
}else{
	
	// separa os dados
	$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];

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

// campos
$campo[1] = "
<div class='classe_div_imagem_perfil_amigo_imagem_2'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</div>
";

// html
$html = "
<div class='classe_div_imagem_perfil_amigo' id='$idcampo[0]'>
$campo[1]
</div>
";

// retorno
return $html;

};

?>