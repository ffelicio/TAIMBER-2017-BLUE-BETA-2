<?php

// retorna o array de pastas
function retorne_array_pastas($endereco_pasta, $modo){

// modo true atualiza o retorno com o endereço completo
// modo false atualiza o retorno apenas com o nome da pasta

# este script não retorna subpastas!

// pasta a ser analisada
$pasta_analisar = scandir($endereco_pasta);

// array de retorno
$array_retorno = array();

// listando pastas
foreach($pasta_analisar as $pasta){
	
	// valida pasta
	if($pasta != null and $pasta != ".." and $pasta != "."){

		// completando endereço de pasta
		$endereco_completo = $endereco_pasta.$pasta;
		
		// valida se é uma pasta ou arquivo
		if(is_dir($endereco_completo) == true){
			
			// valida o modo
			if($modo == true){
				
				// atualizando o array de retorno
				$array_retorno[] = $endereco_completo;
			
			}else{
				
				// atualizando o array de retorno
				$array_retorno[] = $pasta;
				
			};
			
		};

	};

};

// retorno
return $array_retorno;
	
};

?>