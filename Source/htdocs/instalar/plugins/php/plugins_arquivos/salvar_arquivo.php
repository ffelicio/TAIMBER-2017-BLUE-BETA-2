<?php

// funcao para salvar arquivo
function salvar_arquivo($endereco, $conteudo){

// endereço de arquivo
$arquivo = fopen($endereco, "w+");

// salvando aquivo
fwrite($arquivo, $conteudo);

// fechando arquivo
fclose($arquivo);

};

?>
