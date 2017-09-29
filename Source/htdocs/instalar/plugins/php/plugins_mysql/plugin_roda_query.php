<?php

// plugin roda query
function plugin_roda_query($query){

// valida query
if($query == null){
	
	// retorno nulo
	return null;
	
};

// conecta-se ao banco de dados
plugin_conexao(true);

// contador
$contador = 0;

// array de retorno
$array_retorno = array();

// array de dados
$array_dados = array();

// executa o comando
$comando = mysqli_query($_SESSION[CONEXAO_MYSQLI], $query);

// atualiza o array de retorno
#>> Nota: deixe neste ponto, nao colocar no final que da erro <<
$array_retorno["comando"] = $comando;

// numero de linhas
$numero_linhas = @mysqli_num_rows($comando);

// lista todos os dados
for($contador == $contador; $contador <= $numero_linhas; $contador++){

    // obtendo dados de comando
    $dados = @mysqli_fetch_array($comando, MYSQLI_ASSOC);

    // atualiza array de dados
    $array_dados[] = $dados;
	
};

// alimenta o array de retorno
$array_retorno["linhas"] = $numero_linhas;
$array_retorno["dados"] = $array_dados;

// retorno
return $array_retorno;

};

?>