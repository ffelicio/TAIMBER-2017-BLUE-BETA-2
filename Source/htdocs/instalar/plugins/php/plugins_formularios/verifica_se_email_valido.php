<?php

// função para validar e-mail
function verifica_se_email_valido($email){

// remove os espaços em branco no inicio e no fim
$email = converte_minusculo(trim($email));

// verifica se o email é valido
if(filter_var($email, FILTER_VALIDATE_EMAIL)){
	
	// obtem o dominio do email
    list($usuario, $dominio) = explode("@", $email);
   
	// verifica o dns no dominio
	if(checkdnsrr($dominio, "MX")){

		// retorno
		return true;

	}else{

		// retorno
		return false;
	
	}

}else{

	// retorno
    return false;
	
};

};

?>
