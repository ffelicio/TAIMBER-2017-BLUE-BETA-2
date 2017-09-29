<?php

// constroe paginador padrao
function constroe_paginador_padrao($idcampo_1, $funcao){

# a funcao nao pode ter ; terminando!

// globals
global $idioma_sistema;

// id de campos
$idcampo[0] = retorne_idcampo_md5();

// campo de progresso gif
$progresso_gif = campo_progresso_gif($idcampo_1);

// eventos
$evento[0] = "onclick='exibe_elemento_oculto(\"$idcampo_1\", 0), $funcao'";

// html
$html = "
<div class='classe_paginador_padrao_progresso'>
$progresso_gif
</div>

<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</div>
";

// retorno
return $html;

};

?>