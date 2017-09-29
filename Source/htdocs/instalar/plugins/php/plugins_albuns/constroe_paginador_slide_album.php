<?php

// constro o paginador slide de album
function constroe_paginador_slide_album($dados, $idcampo_1){

// separa os dados
$id = $dados["id"];
$uid = $dados[UID];

// funcoes
$funcao[0] = "paginar_slide_album(\"$id\", 0, \"$idcampo_1\", \"$uid\");";
$funcao[1] = "paginar_slide_album(\"$id\", 1, \"$idcampo_1\", \"$uid\");";

// eventos
$evento[0] = "onclick='$funcao[0]'";
$evento[1] = "onclick='$funcao[1]'";

// imagens de sistema
$imagem[0] = retorne_imagem_sistema(113, null, false);
$imagem[1] = retorne_imagem_sistema(114, null, false);

// html
$html = "
<div class='classe_paginador_slide_album_1' $evento[0]>
$imagem[0]
</div>

<div class='classe_paginador_slide_album_2' $evento[1]>
$imagem[1]
</div>
";

// retorno
return $html;

};

?>