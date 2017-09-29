<?php

// retorna o link amigavel de perfil de usuario
function retorne_link_perfil_amigavel_idusuario($modo_espaco, $modo, $uid, $conteudo){

// o modo espaco é o espaço entre o nome e o texto da frente
// por exemplo salomão é um programador!

// valida idusuario informado
if($uid == null){
	
	// retorno
	return HOST_SERVIDOR;
	
};

// url de usuario
$url = retorne_url_amigavel_usuario($uid, 0, null);

// nome de usuario
$nome = retorne_nome_usuario(true, $uid);

// valida usuario logado
if(retorne_usuario_logado() == true and $modo == true){
	
	// info links
	$info_link = constroe_campo_info_link(0, $uid);

	// evento de info link
	$evento_info_link = $info_link[0];

	// conteudo de info link
	$conteudo_info_link = $info_link[1];

};

// valida conteudo
if($conteudo == null){
	
	// setando conteudo
	$conteudo = $nome;
	
};

// valida modo espaco
if($modo_espaco == true){
	
	// classes
	$classe[0] = "classe_link_perfil_amigavel";
	
}else{
	
	// classes
	$classe[0] = "classe_link_perfil_amigavel_2";
	
};

// html
$html = "
<span class='$classe[0]' $evento_info_link>
	<a href='$url' title='$nome'>$conteudo</a>
</span>

$conteudo_info_link
";

// retorno
return $html;

};

?>