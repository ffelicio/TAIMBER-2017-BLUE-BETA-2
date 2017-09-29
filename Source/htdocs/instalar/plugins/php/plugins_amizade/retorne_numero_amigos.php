<?php

// retorna o numero de amigos
function retorne_numero_amigos($array_dados_amigos){

// valida array possui dados
if(count($array_dados_amigos) == 0){
	
	// retorna zero informando que nao ha amigos
    return 0;
	
};

// contador
$contador = 0;

// conta numero de amigos aceitos
foreach($array_dados_amigos as $dados){
	
	// valida amigo aceito
    if($dados[ACEITO] == 1){
		
		// atualiza contador
	    $contador++;
		
	};
	
};

// retorno
return $contador;

};

?>