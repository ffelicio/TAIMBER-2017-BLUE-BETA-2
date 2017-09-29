<?php

// constroe o perfil basico basico deslogado
function constroe_perfil_basico_deslogado(){

// globals
global $tabela_banco;
global $idioma_sistema;

// id de usuario
$uid = retorne_idusuario_request();

// valida uid
if($uid == null or retorne_idusuario_existe($uid) == false){
	
	// retorno nulo
	return null;
	
};

// nome de usuario
$nome_usuario = retorne_nome_usuario(true, $uid);

// tabela
$tabela = $tabela_banco[2];

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// dados da imagem do perfil
$dados = $dados_query["dados"][0];

// separa dados
$url_host_grande = $dados[URL_HOST_GRANDE];

// valida url de imagem de usuario
if($url_host_grande == null){
	
	// url de imagem de usuario
	$url_host_grande = retorne_imagem_sexo_usuario(false, null, $uid);
	
	// campos
	$campo[0] = "
	<div class='imagem_perfil_usuario_deslogado'>
	$url_host_grande
	</div>
	";

}else{
	
	// campos
	$campo[0] = "
	<div class='imagem_perfil_usuario_deslogado'>
	<img src='$url_host_grande' title='$nome_usuario'>
	</div>
	";

};

// campos
$campo[1] = "
<div class='nome_usuario_perfil_deslogado'>
$nome_usuario
</div>
";

// textos
$texto[0] = "
$idioma_sistema[414]$nome_usuario$idioma_sistema[163]
";

// adiciona mensagem de informação
$texto[0] = mensagem_informa($texto[0]);

// campos
$campo[2] = "
<div class='classe_informa_visitante_perfil_deslogado'>
$texto[0]
</div>
";

// html
$html = "
<div class='classe_perfil_usuario_deslogado classe_cor_8'>
$campo[0]
$campo[1]
$campo[2]
</div>
";

// retorno
return $html;

};

?>