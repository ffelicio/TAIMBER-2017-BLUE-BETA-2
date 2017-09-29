<?php

// retorna se o perfil do usuario existe
function retorna_perfil_usuario_existe($modo, $idusuario){

// globals
global $tabela_banco;

// separa dados por tabela
if($modo == false){
	
	// dados compilados do usuario
    $dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

	// dados do pefil
    $dados_perfil = $dados_compilados_usuario[$tabela_banco[0]];

}else{
	
	// dados do perfil
	$dados_compilados_usuario = retorne_dados_compilados_usuario($idusuario);

	// dados do pefil
    $dados_perfil = $dados_compilados_usuario[$tabela_banco[0]];
	
};

// retorno
return $dados_perfil[UID] != null;

};

?>