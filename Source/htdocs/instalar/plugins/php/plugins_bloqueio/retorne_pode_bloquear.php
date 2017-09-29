<?php

// retorna se pode bloquear usuario
function retorne_pode_bloquear($idusuario){

// globals
global $tabela_banco;
global $administradores_sistema;

// dados compilados do usuario
$dados_compilados_usuario = retorne_dados_compilados_usuario($idusuario);

// separa dados por tabela
$dados_perfil = $dados_compilados_usuario[$tabela_banco[0]];

// procurando por email de administradores
foreach($administradores_sistema as $email_administrador){
	
	// valida email administrador
	if($email_administrador != null and $email_administrador == $dados_perfil[E_MAIL]){
		
		// retorno nao pode bloquear
		return false;
		
	};
	
};

// retorno pode bloquear
return true;

};

?>