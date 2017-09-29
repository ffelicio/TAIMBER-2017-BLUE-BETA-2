<?php

// salva a sessao do usuario
function salva_sessao_usuario($email, $senha, $idusuario){

// tempo de validade do cookie
$tempo_vida = time() + (COOKIES_DIAS * 24 * 3600);

// salva valores de sessao
$_SESSION[SESSAO_EMAIL] = $email;
$_SESSION[SESSAO_SENHA] = $senha;
$_SESSION[SESSAO_IDUSUARIO] = $idusuario;

// valida sessao logado ou deslogado
if($email != null and $senha != null){
	
	// logado
    $_SESSION[SESSAO_LOGADO] = true;

}else{
	
	// deslogado
	$_SESSION[SESSAO_LOGADO] = false;
	
};

// salva valores em cookies
setcookie(COOKIE_EMAIL, $email, $tempo_vida, "/");
setcookie(COOKIE_SENHA, $senha, $tempo_vida, "/");

};

?>