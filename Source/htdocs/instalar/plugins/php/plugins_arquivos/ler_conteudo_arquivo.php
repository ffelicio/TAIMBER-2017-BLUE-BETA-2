<?php

// lê o conteudo de arquivo
function ler_conteudo_arquivo($endereco_arquivo){

// valida endereço de arquivo
if($endereco_arquivo != null){
	
	// retorno
	return remove_comentarios_conteudo_arquivo(file_get_contents($endereco_arquivo));
	
}else{
	
	// retorno nulo
	return null;
	
};

};

?>