<?php

// constroe a data de um conteudo
function constroe_data_conteudo($data){

// converte a data para o modo amigavel
$data = converte_data_amigavel(true, $data);

// html
$html = "
<div class='classe_campo_data_conteudo classe_cor_15'>
<span class='classe_campo_data_conteudo_span'>$data</span>
</div>
";

// retorno
return $html;

};

?>