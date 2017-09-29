<?php

// exclui pastas e subpastas
function excluir_pastas_subpastas($endereco_pasta_remover, $recriar){

// removendo pastas e subpastas
if(is_dir($endereco_pasta_remover)){

	// objetos pastas e arquivos
    $objects = scandir($endereco_pasta_remover);

	// listando pastas e arquivos encontrados
    foreach($objects as $object){

		// valida se é uma pasta
        if($object != "." && $object != ".."){

			if(filetype($endereco_pasta_remover."/".$object) == "dir") excluir_pastas_subpastas($endereco_pasta_remover."/".$object, false); else unlink($endereco_pasta_remover."/".$object);

		};

	};

	// reseta objetos
	reset($objects);

	// removendo pasta
	rmdir($endereco_pasta_remover);

};

// valida recriar pastas
if($recriar == true){
	
	// criando estrutura de pastas
	criar_pasta($endereco_pasta_remover);
	
};

};

?>
