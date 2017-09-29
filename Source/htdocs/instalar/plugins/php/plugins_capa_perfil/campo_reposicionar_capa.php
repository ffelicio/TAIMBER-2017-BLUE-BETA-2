<?php

// campo para reposicionar a capa do usuário
function campo_reposicionar_capa($idcampo_1){

// imagens de sistema
$imagem_sistema[1] = retorne_imagem_sistema(127, null, false);
$imagem_sistema[2] = retorne_imagem_sistema(128, null, false);

// eventos
$evento[1] = "onclick='reposicionar_capa(1, \"$idcampo_1\");'";
$evento[2] = "onclick='reposicionar_capa(2, \"$idcampo_1\");'";

// campos
$campo[1] = "
<div class='classe_campo_reposicionar_capa_opcao_1' $evento[1]>
	$imagem_sistema[1]
</div>
";

// campos
$campo[2] = "
<div class='classe_campo_reposicionar_capa_opcao_2' $evento[2]>
	$imagem_sistema[2]
</div>
";

// html
$html = "
<div class='classe_campo_reposicionar_capa'>
	$campo[1]
	$campo[2]
</div>
";

// retorno
return $html;

};

?>