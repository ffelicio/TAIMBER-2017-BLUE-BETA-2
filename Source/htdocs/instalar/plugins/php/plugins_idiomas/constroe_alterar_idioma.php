<?php

// constroe o campo de alteração de idioma
function constroe_alterar_idioma(){

// classe
$classe[0] = "classe_opcao_idioma";
$classe[1] = "classe_campo_altera_idioma_conteudo";
$classe[2] = "classe_campo_altera_idioma";

// textos
$texto[0] = retorne_imagem_sistema(132, null, false);
$texto[1] = retorne_imagem_sistema(133, null, false);

// eventos
$eventos[0] = "alterar_idioma(0);";
$eventos[1] = "alterar_idioma(1);";

// eventos
$evento[0] = "onclick='$eventos[0]'";
$evento[1] = "onclick='$eventos[1]'";

// opcoes
$opcao[0] = "
<div class='$classe[0]' $evento[0]>
	<span class='span_link'>$texto[0]</span>
</div>
";

// opcoes
$opcao[1] = "
<div class='$classe[0]' $evento[1]>
	<span class='span_link'>$texto[1]</span>
</div>
";

// campos
$campo[0] = "
<div class='$classe[1]'>
	$opcao[0]
	$opcao[1]
</div>
";

// html
$html = "
<div class='$classe[2]'>
	$campo[0]
</div>
";

// retorno
return $html;

};

?>