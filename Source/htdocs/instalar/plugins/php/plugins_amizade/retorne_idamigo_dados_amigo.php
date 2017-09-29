<?php

// retorne o id de amigos de dados de amigo
function retorne_idamigo_dados_amigo($modo, $dados, $uid){

// modo true retorna caso aceito
// modo false retorna caso nao aceito ainda

// valida amigo aceito
if($dados[ACEITO] == $modo){

	// define o id de usuario
	if($uid != $dados[UIDAMIGO]){
		
    	// valida id de usuario
		# >> nao permite que o proprio id seja adicionado a lista <<
		if($uid != $dados[UIDAMIGO]){
		
            // id de usuario
			$idusuario = $dados[UIDAMIGO];

		};
	
	}else{
	
		// id de usuario
		# >> caso estiver em outro perfil permite se adicionar também <<
		$idusuario = $dados[UID];
		
    };
	
}else{

    // retorno nulo
    return null;

};

// retorna o id de usuario
return $idusuario;

};

?>