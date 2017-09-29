<?php

// carrega as noticias no modo aba
function carregar_noticias_aba(){

// noticias de banco de dados
$dados = retorne_noticias_banco_dados(true);

// conteudo
$conteudo = $dados[CONTEUDO];

// retorno
return $conteudo;

};

?>