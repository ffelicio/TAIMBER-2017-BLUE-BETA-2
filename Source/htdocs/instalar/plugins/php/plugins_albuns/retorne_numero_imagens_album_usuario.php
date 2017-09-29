<?php

// retorna o numero de imagens de album de usuario
function retorne_numero_imagens_album_usuario($uid, $pagina){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[4];

// query
$query = "select *from $tabela where uid='$uid' and modo_chat='0' and pagina='$pagina';";

// dados de query
$dados_query = plugin_executa_query($query);

// retorno
return $dados_query["linhas"];

};

?>