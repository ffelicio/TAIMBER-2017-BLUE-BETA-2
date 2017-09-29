<?php

// constroe a lista de usuarios que serao iniciados com o chat
function constroe_lista_inicializar_chat(){

// valida pode construir o chat
if(retorne_pode_construir_chat() == false){
	
	// retorno nulo
	return null;
	
};

// lista com usuarios de chat
$lista_usuarios = atualiza_sessao_usuarios_abertos_chat(null, 3);

// valida lista e valida
if(is_array($lista_usuarios) == false){
	
	// retorno nulo
	return null;
	
};

// constroe lista de amigos de chat que serao inicializados
foreach($lista_usuarios as $uid){
	
	// valida uid
	if($uid != null){
		
		// html
		$html .= "
		\n
		constroe_janela_chat(\"$uid\", 0, null);
		\n
		";
		
	};
	
};

// retorno
return $html;

};

?>