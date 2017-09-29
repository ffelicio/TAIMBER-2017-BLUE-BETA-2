<?php

// constroe a imagem de perfil em tamanho medio
function constroe_imagem_perfil_medio($uid){

// globals
global $variavel_campo;

// dados da imagem
$dados_imagem = retorne_dados_imagem_usuario(0, $uid);

// separa os dados
$url_host_medio = $dados_imagem[URL_HOST_MEDIO];

// nome de usuario
$nome_usuario = retorne_nome_usuario(true, $uid);

// url de perfil de usuario
$url_perfil_usuario = retorne_url_amigavel_usuario($uid, 0, null);

// nome com o link de id de usuario
$nome_link_usuario = "<a href='$url_perfil_usuario' title='$nome_usuario'>$nome_usuario</a>";

// dados do perfil
$dados_perfil = retorne_dados_perfil_usuario($uid);

// valida url de host de imagem em miniatura
if($url_host_medio == null){

	// valida o sexo do usuario
	if(retorne_sexo_usuario($dados_perfil) == true){
	
		// separa os dados
		$url_host_medio = retorne_imagem_sistema(11, false, true);
	
	}else{
	
		// separa os dados
		$url_host_medio = retorne_imagem_sistema(24, false, true);

	};
	
	// define o sexo do usuario
	if($dados_perfil[SEXO] == null){
		
		// separa os dados
		$url_host_medio = retorne_imagem_sistema(99, false, true);
		
	};
	
};

// link de imagem de usuario
$imagem_link_usuario = "
<a href='$url_perfil_usuario' title='$nome_usuario'>
<img src='$url_host_medio' title='$nome_usuario' alt='$nome_usuario'>
</a>
";

// separando dados
$cidade = $dados_perfil[CIDADE];
$estado = $dados_perfil[ESTADO];
$pais = $dados_perfil[PAIS];
$trabalha = $dados_perfil[TRABALHA];
$estuda = $dados_perfil[ESTUDA];
$site = $dados_perfil[SITE];
$idiomas = $dados_perfil[IDIOMAS];

// valida campos
if($cidade != null and $estado != null and $pais != null){
	
	// campo informação
	$campo_info[0] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$cidade - $estado - $pais
	</span>
	";

}

// valida campos
if($trabalha != null){
	
	// campo informação
	$campo_info[1] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$trabalha
	</span>
	";
	
};

// valida campos
if($estuda != null){
	
	// campo informação
	$campo_info[1] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$estuda
	</span>
	";
	
};

// valida campos
if($site != null){
	
	// campo informação
	$campo_info[1] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$site
	</span>
	";
	
};

// valida campos
if($idiomas != null){
	
	// campo informação
	$campo_info[1] = "
	<span class='span_separa_informacao_perfil_medio classe_cor_7'>
	$idiomas
	</span>
	";
	
};

// campo adicionar amizade
$campo_info[2] = campo_adicionar_pessoa(false, false, $uid);

// campo adicionar amizade
$campo_info[2] = "
<div class='classe_campo_add_amizade_perfil_medio'>
$campo_info[2]
</div>
";

// campos
$campo[0] = "
<div class='classe_informacoes_perfil_medio_usuario'>

$campo_info[0]
$campo_info[1]
$campo_info[2]

</div>
";

// html
$html = "
	
<div class='classe_imagem_perfil_medio'>
$imagem_link_usuario
</div>	

<div class='classe_nome_usuario_perfil_medio classe_cor_5'>
$nome_link_usuario
</div>

$campo[0]

";

// html
$html = "
<div class='classe_perfil_medio_usuario'>
$html
</div>
";

// retorno
return $html;

};

?>