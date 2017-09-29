<?php

// retorna o numero compativel com a relacao
function retorne_numero_compativel_relacao($relacao){

// sexo de usuario logado
$sexo_usuario = retorne_sexo_usuario_logado();

// valida o tipo de relacao
switch($relacao){
	
	case 0:
	return $relacao;
	break;
	
	case 1:
	return 6;
	break;
	
	case 2:
	return 6;
	break;
	
	case 3:
	return 5;
	break;
	
	case 4:
	return 5;
	break;
	
	case 5:
	
	// valida o sexo do usuario
	if($sexo_usuario == true){
		
		// pai
		return 4;
		
	}else{
		
		// mae
		return 3;
	};
	
	break;
	
	case 6:
	
	// valida o sexo do usuario
	if($sexo_usuario == true){
		
		// avô
		return 2;
		
	}else{
		
		// avó
		return 1;
	};
	
	break;

	case 7:
	
	// valida o sexo do usuario
	if($sexo_usuario == true){
		
		// irmão
		return 7;
		
	}else{
		
		// irmã
		return 8;
		
	};
	
	break;

	case 8:
	
	// valida o sexo do usuario
	if($sexo_usuario == true){
		
		// irmão
		return 7;
		
	}else{
		
		// irmã
		return 8;
		
	};
	
	break;	
	
	case 9:
	
	// valida o sexo do usuario
	if($sexo_usuario == true){
		
		// primo
		return 9;
		
	}else{
		
		// prima
		return 10;
		
	};
	
	break;
	
	case 10:
	
	// valida o sexo do usuario
	if($sexo_usuario == true){
		
		// primo
		return 9;
		
	}else{
		
		// prima
		return 10;
		
	};
	
	break;
	
};

};

?>