<?php

// retorna o numero de depoimentos
function retorne_numero_depoimentos($idusuario, $modo){

# >> modo true todos <<
# >> modo false aceitos <<

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[13];

// valida modo
if($modo == true){
	
    // querys
    $query[0] = "select *from $tabela where uidamigo='$idusuario';";
    $query[1] = "select *from $tabela where uid='$idusuario';";

}else{
	
    // querys
    $query[0] = "select *from $tabela where uidamigo='$idusuario' and aceito='1';";
    $query[1] = "select *from $tabela where uid='$idusuario' and aceito='1';";
	
};

// dados de query
$dados_query[0] = plugin_executa_query($query[0]);
$dados_query[1] = plugin_executa_query($query[1]);

// atualiza os dados de retorno
$dados_retorno[0] = $dados_query[0]["linhas"];
$dados_retorno[1] = $dados_query[1]["linhas"];

// retorno
return $dados_retorno;

};

?>