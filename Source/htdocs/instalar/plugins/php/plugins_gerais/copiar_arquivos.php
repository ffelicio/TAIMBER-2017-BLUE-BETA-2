<?php

// copia arquivos de pastas
function copiar_arquivos($origem, $destino){

// valida se é uma pasta
if(is_dir($origem)){
	
	// abre a pasta
    $dir_handle = opendir($origem);
    
	// lista os arquivos da pasta
    while($file = readdir($dir_handle)){

		// valida se é um diretorio
		if($file != "." && $file != ".."){
			
			// valida se é um arquivo
            if(is_dir($origem.SEPARADOR_PASTA.$file)){
				
				// valida se é uma pasta
                if(!is_dir($destino.SEPARADOR_PASTA.$file)){
					
					// criando uma pasta
                    mkdir($destino.SEPARADOR_PASTA.$file);

                };
				
				// copiando arquivos pela funcao
                copiar_arquivos($origem.SEPARADOR_PASTA.$file, $destino.SEPARADOR_PASTA.$file);
            
			}else{
				
				// copiando arquivos
                copy($origem.SEPARADOR_PASTA.$file, $destino.SEPARADOR_PASTA.$file);
            
			};
        };
        
	};
	
	// fechando pasta
    closedir($dir_handle);

}else{

	// copiando arquivos
    copy($origem, $destino);
	
};
	
};

?>