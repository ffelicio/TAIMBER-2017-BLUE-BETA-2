<?php

// retorna se o elemento do array ja esiste ou nao
function retorne_elemento_array_existe($array_pesquisa, $valor_pesquisa){

// valida tamanho de array
if($array_pesquisa == null or $valor_pesquisa == null or is_array($array_pesquisa) == false or count($array_pesquisa) == 0){

    // retorno falso
    return false;

};

// varrendo array e comparando valores
foreach($array_pesquisa as $valor_array){

    // comparando valor
    if($valor_array == $valor_pesquisa){

		// retorno verdadeiro
		return true;

    };

};

// retorna falso nesse nivel
return false;

};

?>