<?php

// chama uma classe pelo nome
function chama_classe($nome_classe){

// globals
global $extensao_arquivo;
global $idioma;

// origem da classe
$origem = PASTA_BIBLIOTECA_PHP."/$nome_classe".$extensao_arquivo["php"];

// valida se o arquivo de classe existe
if(file_exists($origem) == true){
	
	// incluindo a classe
	include_once($origem);

};

// valida se a classe foi carregada na memória
if(class_exists($nome_classe) == true){
	
	// retorna a nova classe
	return new $nome_classe();

}else{
	
	// retorna falso
	return false;
	
};

};

?>