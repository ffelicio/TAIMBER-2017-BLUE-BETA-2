<?php

// restaura a imagem de album de dados
// usado quando se pagina uma imagem via slide
function restaurar_imagem_album_dados(){

// globals
global $tabela_banco;

// id de imagem atual
$id = retorne_campo_formulario_request(4);

// id de campo
$idcampo[0] = retorne_campo_formulario_request(21);

// tabela
$tabela = $tabela_banco[4];

// query
$query = "select *from $tabela where id='$id';";

// dados de query
$dados = retorne_dados_query($query);

// html
$html = constroe_imagem_album_dados($dados, 5, $idcampo[0]);

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>