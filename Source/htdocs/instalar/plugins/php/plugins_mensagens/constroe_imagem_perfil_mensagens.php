<?php

// constroe a imagem de perfil do chat
function constroe_imagem_perfil_mensagens($uid){

// dados da imagem
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);

// separa os dados
$url_host_miniatura = $dados_imagem[URL_HOST_MINIATURA];

// nome de usuario
$nome_usuario = retorne_nome_usuario(true, $uid);

// valida url de host de imagem em miniatura
if($url_host_miniatura == null){
	
	// dados do perfil
	$dados_perfil = retorne_dados_compilados_usuario($uid);

	// separa os dados do perfil
	$dados_perfil = $dados_perfil[$tabela_banco[1]];

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

// html
$html = "
<div class='classe_div_imagem_perfil_miniatura'>

<div class='classe_div_imagem_perfil_miniatura_div_img'>
<img src='$url_host_miniatura' title='$nome_usuario' alt='$nome_usuario'>
</div>

<div class='classe_div_imagem_perfil_miniatura_div_nome classe_cor_5'>
$nome_usuario
</div>

</div>
";

// retorno
return $html;

};

?>