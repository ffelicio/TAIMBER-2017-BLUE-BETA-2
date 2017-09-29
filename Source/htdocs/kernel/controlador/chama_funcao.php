<?php

// chama uma função pelo nome
function chama_funcao($nome_funcao){

// globals
global $extensao_arquivo;
global $idioma;

// origem da função
$origem = PASTA_BIBLIOTECA_PHP."/$nome_funcao".$extensao_arquivo["php"];

// verifica se a função já existe na memória
if(function_exists($nome_funcao) == false){

	// valida se o arquivo existe
	if(file_exists($origem) == true){
		
		// carregando para memória
		include_once($origem);

	};
	
};

// valida se a função foi carregada na memória
if(function_exists($nome_funcao) == true){
	
	// array com parametros
	$array_parametros = array();
	
	// contador de iteração
	$contador = 0;
	
	// procurando e atualizando array de parametros
	foreach(func_get_args() as $parametro){
		
		// ignora o primeiro que é o proprio nome da função
		if($contador > 0){
			
			// atualiza o array de parametros
			$array_parametros[] = $parametro;
			
		};
		
		// atualiza o contador
		$contador++;
		
	};

	// retorna a função
	return $nome_funcao($array_parametros);
	
}else{
	
	// retorna o erro
	return "$idioma[0].>>>$nome_funcao<<<.$idioma[1]"."<br>";
	
};

};

?>