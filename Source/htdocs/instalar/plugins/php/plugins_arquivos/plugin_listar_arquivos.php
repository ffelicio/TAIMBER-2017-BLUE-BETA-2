<?php

// este plugin retorna todos os arquivos de uma pasta
function plugin_listar_arquivos($endereco_pasta, $extensao, $auto_include){

// pasta de arquivos, e lista de arquivos
$pasta_diretorio = new RecursiveDirectoryIterator($endereco_pasta);
$lista_arquivos = new RecursiveIteratorIterator($pasta_diretorio);

// array com lista de arquivos
$arquivos_encontrados = array();

// listando arquivos
foreach($lista_arquivos as $informacao_arquivo){
	
	// valida informacao de arquivo
	if($informacao_arquivo != null){
	
	    // extensao de arquivo
        $extensao_arquivo = ".".pathinfo($informacao_arquivo, PATHINFO_EXTENSION);
    
	};
	
	// endereco do arquivo
    $endereco_arquivo = $informacao_arquivo->getPathname();
    $endereco_arquivo = str_ireplace("\\", "/", $endereco_arquivo);
	
	// valida extensao de arquivo
	if($extensao_arquivo == $extensao){
	    
		// adiciona endereco de arquivo ao array
		$arquivos_encontrados[] = $endereco_arquivo;
	
	};

	// valida auto incluir
	if($auto_include == true and $extensao_arquivo == $extensao){
	
	    // incluindo endereco de arquivo
	    include_once($endereco_arquivo);
	
	};
		
};

// retorno
return $arquivos_encontrados;

};

?>